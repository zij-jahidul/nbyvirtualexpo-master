<?php

namespace App\Http\Controllers\API\Backend\Auth;

use Auth;
use Helper;
use App\Models\User;
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

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role == 'Admin'){

        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
    // if($request->search != 'undefined'){
        $data =$search == 'false'?User::whereIn('role', ['Admin', 'Company', 'Secretary','QueryAssistant'])->orderBy('id', 'desc')->paginate($dataSorting):User::whereIn('role', ['Admin', 'Company', 'Secretary','QueryAssistant'])->where(function($query) use($search){
        $query->orWhere('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $roles = Role::all();
        

        return  UserResource::collection($data)->additional([
                'roles' => $roles
            ]); 

        }
             
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
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['photo'] = $fileName;

        DB::beginTransaction();
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        

        // $company_id = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
    // return   $stall_id = $request->stall_id;
       

        StallUser::create([
            'user_id'    => $user->id
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
        return new UserResource($data);
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

        $input = $request->all();
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

        // $company_id = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        // $stall_id = $request->stall_id;

         $check = StallUser::where('user_id', $id)->exists();

         if($check){
            StallUser::where('user_id', $id)->update([
                'user_id'    => $user->id
            ]);   
         } else {
            StallUser::create([
                'user_id'    => $id
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
        $check = CompanyUser::where('user_id',$id)->exists();
        if($check){

            return response()->json([
                'status'  => 'danger',
                'message' => 'Company exists, you can not deleted user',
                'icon'    => 'times'
            ]); 

        } else {

           $user = User::find($id)->delete();
            if($user){
                return response()->json([
                    'status'  => 'danger',
                    'message' => 'User has been deleted!',
                    'icon'    => 'times',
                ]);   
            }  
        }
       
    }

}
