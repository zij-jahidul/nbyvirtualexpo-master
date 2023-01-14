<?php


use App\Http\Controllers\API\Backend\Company\CompanyController;
use App\Http\Controllers\API\Backend\Order\OrderController;
use App\Http\Controllers\API\Backend\Stall\StallLayoutController;
use App\Http\Controllers\API\Backend\StallResource\StallResourceController;
use App\Http\Controllers\API\Backend\Stall\DeliveryDistrictController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'API\Backend\Auth', 'middleware' => 'api'], function(){
    Route::post('/signin', 'AuthController@signIn');
    Route::post('/register', 'AuthController@register');
    Route::post('/signout', 'AuthController@signOut');
});


Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::group(['namespace'  => 'API\Backend'], function(){
        Route::get( 'get_stall_layout_images/{id}', [StallLayoutController::class, 'get_stall_layout_images']);
        Route::get( 'get_stall_layout_image/{id}', [StallLayoutController::class, 'get_stall_layout_image']);
        Route::post( 'get_stall_layout_images/', [StallLayoutController::class, 'get_stall_layout_images_store']);
        Route::get( 'get_company_details/{id}', [CompanyController::class, 'get_company_details']);
        Route::post( 'update-order-status/{id}', [OrderController::class, 'update_order_status']);
        Route::get( 'get-delivery-stall', [DeliveryDistrictController::class, 'get_delivery_stall']);


        Route::apiResources([
            'user'              => 'Auth\UserController',
            'stall-user'        => 'Auth\StallUserController',
            'role'              => 'Auth\RoleController',
            'company'           => 'Company\CompanyController',
            'company-user'      => 'Company\CompanyUserController',
            'event-category'    => 'EventCategory\EventCategoryController',
            'product-category'  => 'ProductCategory\ProductCategoryController',
            'event-subcategory' => 'EventCategory\EventSubCategoryController',
            'stall-layout'      => 'Stall\StallLayoutController',
            'stall'             => 'Stall\StallController',
            'blog'             => 'Blog\BlogController',
            'product'          => 'Product\ProductController',


            'event-sub-category'         => 'EventSubCategory\EventSubCategoryController',
            'back/order'                 => 'Order\OrderController',
            'order-detail'               => 'Order\OrderDetailsController',
            'product-attribute'          => 'Product\ProductAttributeController',
            'product-image'              => 'Product\ProductImageController',
            'product-visitor'            => 'Product\ProductVisitorController',
            'product-subCategory'        => 'ProductCategory\ProductSubCategoryController',
            'stall-visitor'              => 'Stall\StallVisitorController',
            'stall-ads'                  => 'Stall\StallAdsController',
            'vendor-site-visitor'        => 'VendorSiteVisitor\VendorSiteVisitorController',
            'visitor-point'              => 'Visitor\VisitorPointController',
            'visitor-point-distribution' => 'Visitor\VisitorPointDistributionController',
            'webinar'                    => 'Webinar\WebinarController',
            'webinar-user'               => 'Webinar\WebinarUserController',
            'ads'                        => 'Ads\AdsController',
            'stall-resource'             => 'StallResource\StallResourceController',
            'delivery-district'          => 'Stall\DeliveryDistrictController',
            'delivery-charge'          => 'Stall\ShippingCostController',
        ]);

        Route::get('get-sub-category', 'ProductCategory\ProductSubCategoryController@getSubCategory');

    });

    Route::group(['namespace'  => 'API\Frontend'], function(){

        Route::get('get_cart_items', 'Cart\CartController@get_cart_items');
        Route::get('get-order-number', 'Order\OrderController@get_order_number');
        Route::get('cart_clear', 'Cart\CartController@clearCart');
        Route::get('get-stall-resource', 'StallResource\StallResourceController@index');

        Route::apiResources([
            'stall-page' => 'Stall\StallController',
            'products' => 'Product\ProductController',
            'firebase' => 'Firebase\FirebaseController',
            'blog-page' => 'Blog\BlogController',
            'cart'              => 'Cart\CartController',
            'shipping-address'  => 'ShippingAddress\ShippingAddressController',
            'order'             => 'Order\OrderController',
            'frontend-user'     => 'User\UserController',
            'invoice'           => 'Invoice\InvoiceController',
            'district'           => 'District\DistrictController',


        ]);



        Route::get('single-blog', 'Blog\BlogController@singleBlog');


Route::group(['namespace' => 'API\Company', 'middlware' => 'auth:sanctum'], function(){

});

        Route::group(['namespace' => 'Firebase'], function(){

            Route::post('/make-call', 'FirebaseController@makeCall');
            Route::post('/receive-call', 'FirebaseController@receiveCall');
            Route::post('/join-call', 'FirebaseController@joinCall');
            Route::post('/cancel-incoming-call', 'FirebaseController@cancelIncomingCall');
            Route::post('/cancel-outgoing-call', 'FirebaseController@cancelOutgoingCall');

        });


    Route::apiResources([
        'stall-page' => 'Stall\StallController',
        'products' => 'Product\ProductController',
        'firebase' => 'Firebase\FirebaseController',
        'blog-page' => 'Blog\BlogController',
        'cart'              => 'Cart\CartController',
        'shipping-address'  => 'ShippingAddress\ShippingAddressController',
        'order'             => 'Order\OrderController',

    ]);

        Route::get('single-blog', 'Blog\BlogController@singleBlog');

        Route::group(['namespace' => 'Chat'], function(){

            Route::post('/send-message', 'ChatController@sendMessage');
            Route::post('/receive-message', 'ChatController@receiveMessage');

            Route::post('/cancel-incoming-message', 'ChatController@cancelIncomingMessage');
            Route::post('/cancel-outgoing-message', 'ChatController@cancelOutgoingMessage');

            Route::post('/edit-message', 'ChatController@EditMessage');
            Route::post('/delete-message', 'ChatController@deleteMessage');

            // HELP DESK CHAT MANAGEMENT
            Route::post('/helpdesk-send-message', 'ChatController@helpDeskSendMessage');
            Route::post('/help-desk-receive-message', 'ChatController@helpDeskReceiveMessage');

            Route::get('/get-pair-message', 'ChatController@getPairMessage');
            Route::get('/get-chat-user', 'ChatController@chatUser');
            Route::post('/delete-chat-message', 'ChatController@deleteChatMessage');
            Route::post('/delete-all-conversation', 'ChatController@deleteAllConversation');

            Route::get('/helpdesk-chat-user', 'ChatController@getHelpdeskChatUser');
            Route::post('/create-authority-chat-user', 'ChatController@createAuthorityChatUser');
            Route::post('/get-helpdesk-pair-message', 'ChatController@getHelpdeskPairMessage');

            Route::post('/delete-helpdesk-single-message', 'ChatController@deleteHelpdeskMessage');
            Route::post('/delete-helpdesk-all-message', 'ChatController@deleteAllHelpdeskConversation');
            Route::get('/load-chat-user', 'ChatController@loadUser');
            Route::get('/get-stall-user', 'ChatController@getStallUser');

            

        });


    });

});


Route::group(['namespace' => 'API\Frontend', 'middleware' => 'api'], function(){
    Route::apiResources([
        // 'ads' => 'Stall\StallAdsController',
        // 'cart'                       => 'Cart\CartController',
    ]);
});




Route::group(['namespace'  => 'API\Frontend\Auth'], function(){

    Route::post('client-signin', 'AuthController@signIn');
    Route::post('signup', 'AuthController@signUp');
    Route::post('otp-verify', 'AuthController@otpVerify');
    Route::post('resent-otp', 'AuthController@resentOtp');



});

Route::group(['namespace'  => 'API\Frontend\General', 'middleware' =>'api'], function(){

    Route::get('frontend-event-category', 'GeneralController@eventCategory');
    Route::get('frontend-event-sub-category-wise-stall', 'GeneralController@eventSubCategory');
    Route::get('frontend-event-sub-category', 'GeneralController@subCategory');
    Route::get('frontend-stall-details', 'GeneralController@getStall');
    Route::get('lobby-ads', 'GeneralController@getLobbyAds');
    Route::get('exhibition-ads', 'GeneralController@getExhibitionAds');
    Route::get('showads-stall', 'GeneralController@showAdsstall');
    Route::get('search-stalls', 'GeneralController@searchStalls');
    Route::get('header-ads', 'GeneralController@headerAds');
    Route::get('frontend-company-user', 'GeneralController@companyUser');
    Route::get('get-admin-user', 'GeneralController@getAdminUser');
    Route::post('update-user-profile', 'GeneralController@updateUserProfile');
    // Route::get('get-stall-user', 'GeneralController@getStallUser');
    Route::get('event-room-live', 'GeneralController@eventRoomLive');
    Route::get('webinar-live-session', 'GeneralController@webinarLiveSession');




});

Route::group(['namespace' => 'API\Company\Auth'], function(){

    Route::post('company-signin', 'AuthController@signIn');
    Route::post('company-signout', 'AuthController@signOut');

});

