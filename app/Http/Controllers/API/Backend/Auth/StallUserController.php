<?php

namespace App\Http\Controllers\API\Backend\Auth;

use Auth;
use Helper;
use App\Models\User;
use App\Models\Stall\Stall;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Stall\StallUser;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Backend\User\UserRequest;
use App\Http\Resources\Backend\User\UserResource;
use App\Http\Resources\Backend\Stall\StallUserResource;

class StallUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{  
    
    $company_id = CompanyUser::where('user_id', Auth::user()->id)->pluck('company_id');

    $stallUserIds = StallUser::whereIn('company_id', $company_id)->get()->pluck('user_id')->toArray();

    array_push($stallUserIds, Auth::user()->id);
    
    $search = $request->search;
    $dataSorting = $request->sorting == 'false'?10:$request->sorting;
    // if($request->search != 'undefined'){
    $data =$search == 'false'?User::whereIn('id', $stallUserIds)->orderBy('id', 'desc')->paginate($dataSorting):User::whereIn('id', $stallUserIds)->where(function($query) use($search){
    $query->orWhere('name', 'LIKE', "%{$search}%")
    ->orWhere('email', 'LIKE', "%{$search}%");

    })->orderBy('id', 'desc')->paginate($dataSorting);

    $stall = Stall::where('company_id', $company_id)->get();
    $roles = Role::all();
            
    return  StallUserResource::collection($data)->additional([
            'stalls' => $stall
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // return $request->all();
        $validated = $request->validated();
        
        $fileName = Helper::imgProcess($request,'photo',$request->name, '', 'images/user', 'store', User::class); 
        
        $input = $request->except(['stall_id']);

        
        
        $input['password'] = Hash::make($input['password']);
        $input['photo'] = $fileName;
        
        DB::beginTransaction();

        $user = User::create($input);

        $user->assignRole($request->input('roles'));

        $company_id = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $stall_id = $request->stall_id;
       

        StallUser::create([
            'user_id'    => $user->id,  
            'company_id' => $company_id,
            'stall_id'   => $stall_id
        ]);

        DB::commit();

        return response()->json([
            'status'  => 'info',
            'message' => 'User has been created!',
            'icon'    => 'check',
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return new StallUserResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // $validated = $request->validated();

         $fileName = Helper::imgProcess($request,'photo',$request->name, $id, 'images/user', 'update', User::class); 

         $input = $request->except(['stall_id']);
         if(!empty($input['password'])){ 
             $input['password'] = Hash::make($input['password']);
         }else{
             $input = Arr::except($input,array('password'));    
         }
 
         $input['photo'] = $fileName;
         DB::beginTransaction();
         $user = User::find($id);
         $user->update($input);
         // DB::table('model_has_roles')->where('model_id',$id)->delete();
     
         // $user->assignRole($request->input('roles'));

         $company_id = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
         $stall_id = $request->stall_id;

         $check = StallUser::where('user_id', $id)->exists();

         if($check){
            StallUser::where('user_id', $id)->update([
                'user_id'    => $user->id,  
                'company_id' => $company_id,
                'stall_id'   => $stall_id
            ]);   
         } else {
            StallUser::create([
                'user_id'    => $id,  
                'company_id' => $company_id,
                'stall_id'   => $stall_id
            ]);
         }
         DB::commit();
         return response()->json([
             'status'  => 'info',
             'message' => 'User has been updated!',
             'icon'    => 'check',
         ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = User::find($id)->photo;
        $user = User::find($id)->delete();
        StallUser::where('user_id', $id)->delete();
        unlink('/images/user/'.$photo);
        if($user){
            return response()->json([
                'status'  => 'danger',
                'message' => 'User has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
