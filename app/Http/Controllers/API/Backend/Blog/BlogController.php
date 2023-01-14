<?php

namespace App\Http\Controllers\API\Backend\Blog;

use App\Http\Controllers\Controller;

use Helper;
use App\Models\User;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\Backend\Blog\BlogResource;
use App\Models\Blog\Blog;
use App\Models\Company\Company;
use App\Models\Company\CompanyUser;
use App\Models\EventCategory\EventCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?15:$request->sorting;
        $data =$search == 'false'?Blog::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):Blog::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('title', 'LIKE', "%{$search}%")
            ->orWhere('tropic', 'LIKE', "%{$search}%")
            ->orWhere('live_broadcust', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $companies = Company::all();
        // select('id', 'event_sub_category_name')->get()
        $event_categories = EventCategory::all();
        // select('id', 'event_sub_category_name')->get()
        $users = User::all();
        // select('id', 'event_sub_category_name')->get()
        
        return BlogResource        :: collection($data)->additional([
                'companies'        => $companies,
                'event_categories' => $event_categories,
                'users'            => $users
        ]);

        
    }

    /**
     * Store a newly created resource in storage.
     *

     * @param BlogRequest $request
     * @return BlogResource
     */
    public function store(Request $request)
    {
         
        $fileName = Helper::imgProcess($request,'feature_image','', '', 'images/blog', 'store', Blog::class);  
        
        $data = $request->all();

        $data['feature_image'] = $fileName;
        $data['slug'] = Str::slug($request->title);
        Blog::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Blog has been created!',
            'icon'    => 'times',
        ]); 
    }


    /**
     * Display the specified resource.
     *

     * @param int $id
     * @return BlogResource
     */
    public function show(int $id): BlogResource
    {
       $blog = Blog::findOrFail($id);
       return new BlogResource($blog);
    }

    /**
     * Update the specified resource in storage.
     *

     * @param BlogRequest $request
     * @param int $id
     * @return BlogResource
     */
    public function update(Request $request, int $id)
    {
        $fileName = Helper::imgProcess($request,'feature_image',$request->name, $id, 'images/blog', 'update', Blog::class);  

        $data = $request->all();
        $data['feature_image']     = $fileName; 
        $data = Blog::find($id)->update($data); 

        return response()->json([
            'status'  => 'success',
            'message' => 'Blog has been updated!',
            'icon'    => 'times',
        ]);  
    }


    /**
     * Remove the specified resource from storage.     
     * @param int $id
     * @return BlogResource
     */
    public function destroy($id)
    {
        $delete = Blog::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Blog has been deleted!',
                'icon'    => 'times',
            ]);   
        }
    }
}
