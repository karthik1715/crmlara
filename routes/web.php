<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TypeaheadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ImportExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', 'PolicyController@read');
Route::post('/create', 'PolicyController@create');
Route::post('/update/{id}','PolicyController@update')->where('id', '[0-9]+');    
Route::resource('/contacts', ContactController::class);//->middleware('auth:api');
Route::resources(  
    ['contact'=>'ContactController'] //,  
    // 'student'=>'StudentController']  
    );  
Route::get('/token', function () {
    return csrf_token(); 
}); */

Route::get('/clear', function() {
    // $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return 'All routes cache has just been removed';
});

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {

        Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
        Route::get('/autocomplete-search', [TypeaheadController::class,'autocompleteSearch']);
        Route::get('/catg-autocomplete-search', [TypeaheadController::class,'catgorySearch']);
        Route::get('/seg-autocomplete-search', [TypeaheadController::class,'segmentSearch']);

        Route::post('checkemail', [ContactController::class,'checkEmail']);
        Route::post('attributevalue', [CampaignController::class,'attributeValue']);
        Route::post('getmonthchart', [AuthController::class,'getMonthChart']);
        Route::post('getcampaignchart', [AuthController::class,'getCampaignChart']);

    #Contact Policy
    Route::prefix('contact')->group(function () {
        Route::get('/' , [ContactController::class,'showContacts'])->name('contact.list');
        Route::get('/create', [ContactController::class,'createContact'])->name('contact.create');
        Route::post('/create', [ContactController::class,'saveContact']);
        Route::get('/edit/{id}', [ContactController::class,'getContact'])->name('contact.edit');
        Route::put('/edit/{id}', [ContactController::class,'saveContact'])->name('contact.update');
        Route::get('/delete/{id}', [ContactController::class,'deleteContact'])->name('contact.delete');
    });
    #endContact

    #Organization Policy
    Route::prefix('organization')->group(function () {
        Route::get('/' , [OrganizationController::class,'showOrganizations'])->name('organization.list');
        Route::get('/create', [OrganizationController::class,'createOrganization'])->name('organization.create');
        Route::post('/create', [OrganizationController::class,'saveOrganization']);
        Route::get('/edit/{id}', [OrganizationController::class,'getOrganization'])->name('organization.edit');
        Route::put('/edit/{id}', [OrganizationController::class,'saveOrganization'])->name('organization.update');
        Route::get('/delete/{id}', [OrganizationController::class,'deleteOrganization'])->name('organization.delete');
        Route::get('/orgexport', [ImportExportController::class, 'orgExport'])->name('orgexport');
        Route::post('/orgimport', [ImportExportController::class, 'orgImport'])->name('orgimport');
    });
    #endOrganization

    #Organization Policy
    Route::prefix('segment')->group(function () {
        Route::get('/' , [SegmentController::class,'showSegments'])->name('segment.list');
        Route::get('/create', [SegmentController::class,'createSegment'])->name('segment.create');
        Route::get('/create/{campaign}', [SegmentController::class,'createSegment'])->name('campsegment.create');
        Route::post('/create', [SegmentController::class,'saveSegment']);
        Route::get('/edit/{id}', [SegmentController::class,'getSegment'])->name('segment.edit');
        Route::put('/edit/{id}', [SegmentController::class,'saveSegment'])->name('segment.update');
        Route::get('/delete/{id}', [SegmentController::class,'deleteSegment'])->name('segment.delete');
        Route::get('/copy/{id}', [SegmentController::class,'copySegment'])->name('segment.copy');
        Route::get('/contactexport', [ImportExportController::class, 'contactExport'])->name('contactexport');
        Route::post('/contactimport', [ImportExportController::class, 'contactImport'])->name('contactimport');
    });
    #endOrganization
    
    #Campaign
    Route::prefix('campaign')->group(function () {
        Route::get('/' , [CampaignController::class,'showCampaigns'])->name('campaign.list');
        Route::get('/create', [CampaignController::class,'createCampaign'])->name('campaign.create');
        Route::post('/create', [CampaignController::class,'saveCampaign'])->name('campaigncreate');
        Route::get('/edit/{id}', [CampaignController::class,'getCampaign'])->name('campaign.edit');
        Route::post('/edit/{id}', [CampaignController::class,'saveCampaign'])->name('campaign.update');
        Route::get('/copy/{id}', [CampaignController::class,'copyCampaign'])->name('campaign.copy');
        Route::get('/delete/{id}', [CampaignController::class,'deleteCampaign'])->name('campaign.delete');
        Route::get('/statistics/{id}', [CampaignController::class,'statisticsCampaign'])->name('campaign.statistics');
    });
    #endCampaign
    
    Route::post('/addcategory', [SettingsController::class,'saveCategory']);
    Route::post('/upload', [CampaignController::class,'uploadImage'])->name('upload');
    
    #Deal
    Route::get('/deal', [DealController::class,'index'])->name('deal.list');
    Route::get('/deal/create',function(){
        return view('admin.deal.form');
    });
    Route::get('/deals/pipeline',function(){
    return view('admin.deal.pipeline');
    });
    #endDeal

    #Marketing
    Route::get('marketing/forms',function(){
        return view('admin.marketing.forms.forms');
    });

    #endMarketing
    /* Route::get('/admin/campaigns/email-tracking-detail',function(){
        return view('admin.campaign.statistics');
    }); */

});