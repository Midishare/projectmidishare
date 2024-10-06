<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BelajarmandiriController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\KnowledgewhController;
use App\Http\Controllers\KnowledgeogmController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideowhController;
use App\Http\Controllers\VideoogmController;
use App\Http\Controllers\LinkmodController;
use App\Http\Controllers\LinkogmController;
use App\Http\Controllers\LinkwhController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LivestreamController;
use App\Http\Controllers\MdpController;
use App\Http\Controllers\DpController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\Admin\MdpController as AdminMdpController;
use App\Http\Controllers\Admin\DpController as AdminDpController;
use App\Http\Controllers\Admin\IpController as AdminIpController;
use App\Http\Controllers\Admin\VideoMdpController;
use App\Http\Controllers\Admin\VideoDpController;
use App\Http\Controllers\Admin\VideoIpController;
use App\Http\Controllers\CrudloginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserloginController;


Route::get('/', [DashboardController::class, 'index'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('signin');



Route::get('/materiadmin', function () {
    return view('materiadmin');
});

Route::get('/materiadminmodwh', function () {
    return view('materiadminmodwh');
});

Route::get('/materiadminmodogm', function () {
    return view('materiadminmodogm');
});


Route::middleware('auth', 'role:admin')->group(function () {
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
    // Route::delete('/addresses/deleteAll', [AddressController::class, 'destroy'])->name('addresses.deleteAll');
    // Route::delete('/addresses/deleteAll', [AddressController::class, 'destroy'])->name('addresses.deleteAll');

    Route::get('users/import', [UserController::class, 'showImportForm'])->name('users.import.form');
    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{address}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{address}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{address}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/selected-users', [UserController::class, 'deleteCheckedUser'])->name('user.deleteSelected');

    // Route untuk Admin MDP
    Route::prefix('admin/mdp')->group(function () {
        Route::get('/', [AdminMdpController::class, 'index'])->name('admin.mdp.index');
        Route::get('/materi', [AdminMdpController::class, 'materidokumen'])->name('admin.mdp.materi');
        Route::post('/materi/create', [AdminMdpController::class, 'storeDokumen'])->name('admin.mdp.materi.store'); // Add this line
        Route::get('/mdp/materi/create', [AdminMdpController::class, 'create'])->name('admin.mdp.materi.create');
        Route::get('/video', [AdminMdpController::class, 'video'])->name('admin.mdp.video');
        Route::get('/mdp/materi/{id}/edit', [AdminMdpController::class, 'edit'])->name('admin.mdp.materi.edit');
        Route::put('/mdp/materi/{id}', [AdminMdpController::class, 'update'])->name('admin.mdp.materi.update');
        Route::get('/mdp/materi/{id}', [AdminMdpController::class, 'destroy'])->name('admin.mdp.materi.destroy');
        Route::post('/mdp/materi/bulk-delete', [AdminMdpController::class, 'bulkDelete'])->name('admin.mdp.materi.bulkDelete');
        Route::resource('mdp', MdpController::class);
        // Ensure this route exists and points to the correct controller method
        Route::get('/video', [VideoMdpController::class, 'index'])->name('admin.video');
        Route::get('/video/create', [VideoMdpController::class, 'create'])->name('admin.video.create');
        Route::post('/video', [VideoMdpController::class, 'store'])->name('admin.video.store');
        Route::get('/video/{id}/edit', [VideoMdpController::class, 'edit'])->name('admin.video.edit');
        Route::put('/video/{id}', [VideoMdpController::class, 'update'])->name('admin.video.update');
        Route::get('/video/{id}', [VideoMdpController::class, 'destroy'])->name('admin.video.destroy');
        Route::post('/admin/video/bulk-delete', [VideoController::class, 'bulkDelete'])->name('admin.video.bulk_delete');
    });

    // Route untuk Admin DP
    Route::prefix('admin/dp')->group(function () {
        Route::get('/', [AdminDpController::class, 'index'])->name('admin.dp.index');
        Route::get('/materi', [AdminDpController::class, 'materidokumen'])->name('admin.dp.materi');
        Route::post('/materi/create', [AdminDpController::class, 'storeDokumen'])->name('admin.dp.materi.store');
        Route::get('/materi/create', [AdminDpController::class, 'create'])->name('admin.dp.materi.create');
        Route::get('/video', [AdminDpController::class, 'video'])->name('admin.dp.video');
        Route::get('/materi/{id}/edit', [AdminDpController::class, 'edit'])->name('admin.dp.materi.edit');
        Route::put('/materi/{id}', [AdminDpController::class, 'update'])->name('admin.dp.materi.update');
        Route::get('/materi/{id}', [AdminDpController::class, 'destroy'])->name('admin.dp.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminDpController::class, 'bulkDelete'])->name('admin.dp.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoDpController::class, 'index'])->name('admin.video');
        Route::get('/video/create', [VideoDpController::class, 'create'])->name('admin.video.create');
        Route::post('/video', [VideoDpController::class, 'store'])->name('admin.video.store');
        Route::get('/video/{id}/edit', [VideoDpController::class, 'edit'])->name('admin.video.edit');
        Route::put('/video/{id}', [VideoDpController::class, 'update'])->name('admin.video.update');
        Route::get('/video/{id}', [VideoDpController::class, 'destroy'])->name('admin.video.destroy');
        Route::post('/video/bulk-delete', [VideoDpController::class, 'bulkDelete'])->name('admin.video.bulk_delete');
    });


    // Route untuk Admin IP
    Route::prefix('admin/ip')->group(function () {
        Route::get('/', [AdminIpController::class, 'index'])->name('admin.ip.index');
        Route::get('/materi', [AdminIpController::class, 'materiDokumen'])->name('admin.ip.materi');
        Route::post('/materi/create', [AdminIpController::class, 'store'])->name('admin.ip.materi.store');
        Route::get('/materi/create', [AdminIpController::class, 'create'])->name('admin.ip.materi.create');
        Route::get('/materi/{id}/edit', [AdminIpController::class, 'edit'])->name('admin.ip.materi.edit');
        Route::put('/materi/{id}', [AdminIpController::class, 'update'])->name('admin.ip.materi.update');
        Route::get('/materi/{id}', [AdminIpController::class, 'destroy'])->name('admin.ip.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminIpController::class, 'bulkDelete'])->name('admin.ip.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoIpController::class, 'index'])->name('admin.video');
        Route::get('/video/create', [VideoIpController::class, 'create'])->name('admin.video.create');
        Route::post('/video', [VideoIpController::class, 'store'])->name('admin.video.store');
        Route::get('/video/{id}/edit', [VideoIpController::class, 'edit'])->name('admin.video.edit');
        Route::put('/video/{id}', [VideoIpController::class, 'update'])->name('admin.video.update');
        Route::get('/video/{id}', [VideoIpController::class, 'destroy'])->name('admin.video.destroy');
        Route::post('/video/bulk-delete', [VideoIpController::class, 'bulkDelete'])->name('admin.video.bulk_delete');
    });
});

// Route untuk MDP
Route::get('/mdp', [MdpController::class, 'index'])->name('mdp.index');
Route::get('/mdp/materi', [MdpController::class, 'materiDokumen'])->name('mdp.materi');
Route::get('/mdp/video', [MdpController::class, 'video'])->name('mdp.video');



// Route untuk DP
Route::get('/dp', [DpController::class, 'index'])->name('dp.index');
Route::get('/dp/materi', [DpController::class, 'materiDokumen'])->name('dp.materi');
Route::get('/dp/video', [DpController::class, 'video'])->name('dp.video');

// Route untuk IP
Route::get('/ip', [IpController::class, 'index'])->name('ip.index');
Route::get('/ip/materi', [IpController::class, 'materiDokumen'])->name('ip.materi');
Route::get('/ip/video', [IpController::class, 'video'])->name('ip.video');




Route::get('/addhome', [DashboardController::class, 'addhome'])->name('dashboard.addhome');
Route::post('/addhome_process', [DashboardController::class, 'addhome_process'])->name('dashboard.addhome_process');
Route::get('/showhome', [DashboardController::class, 'show_by_adminhomeshow'])->name('dashboard.show_by_adminhomeshow');
Route::get('/edithome/{id}', [DashboardController::class, 'edithome'])->name('dashboard.edithome');
Route::post('/edithome_process', [DashboardController::class, 'edithome_process'])->name('dashboard.edithome_process');
Route::get('/deletehome/{id}', [DashboardController::class, 'deletehome'])->name('dashboard.deletehome');
// Route::post('/deleteSelectedHome', [DashboardController::class, 'deleteSelectedHome'])->name('dashboard.deleteSelectedHome');
Route::post('/deleteSelectedHome', [DashboardController::class, 'deleteSelectedHome'])->name('dashboard.deleteSelectedHome');
Route::get('/deletehome/{id}', [DashboardController::class, 'deletehome'])->name('dashboard.deletehome');


Route::get('/add', [BeritaController::class, 'add'])->name('berita.add');
Route::post('/add_process', [BeritaController::class, 'add_process'])->name('berita.add_process');
Route::get('/beritamidi', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/detail/{id}', [BeritaController::class, 'detail'])->name('berita.detail');
Route::get('/adminshow', [BeritaController::class, 'show_by_admin'])->name('berita.show_by_admin');
Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
Route::post('/edit_process', [BeritaController::class, 'edit_process'])->name('berita.edit_process');
Route::get('/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
Route::delete('/bulk_delete', [BeritaController::class, 'bulkDelete'])->name('berita.bulk_delete');
Route::get('/kmadmin', [BeritaController::class, 'kmadmin'])->name('kmadmin');
Route::get('/repositoryall', [BeritaController::class, 'repositoryall'])->name('repositoryall');

// Route for user 
// routes/web.php




Route::get('/addmandiri', [BelajarmandiriController::class, 'addmandiri'])->name('belajarmandiri.addmandiri');
Route::post('/addmandiri_process', [BelajarmandiriController::class, 'addmandiri_process'])->name('belajarmandiri.addmandiri_process');
Route::get('/belajarmandiri', [BelajarmandiriController::class, 'showmandiri'])->name('belajarmandiri.show');
Route::get('/detailmandiri/{id}', [BelajarmandiriController::class, 'detailmandiri'])->name('belajarmandiri.detailmandiri');
Route::get('/adminmandirishow', [BelajarmandiriController::class, 'show_by_adminmandirishow'])->name('belajarmandiri.show_by_adminmandirishow');
Route::get('/editmandiri/{id}', [BelajarmandiriController::class, 'editmandiri'])->name('belajarmandiri.editmandiri');
Route::post('/editmandiri_process', [BelajarmandiriController::class, 'editmandiri_process'])->name('belajarmandiri.editmandiri_process');
Route::get('/deletemandiri/{id}', [BelajarmandiriController::class, 'deletemandiri'])->name('belajarmandiri.deletemandiri');
Route::post('/deleteSelected', [BelajarmandiriController::class, 'deleteSelected'])->name('belajarmandiri.deleteSelected');


Route::get('/addkm', [KnowledgeController::class, 'addkm'])->name('knowledge.addmandiri');
Route::post('/addkm_process', [KnowledgeController::class, 'addkm_process'])->name('knowledge.addkm_process');
Route::get('/repositorykm', [KnowledgeController::class, 'showkm'])->name('knowledge.showkm');
Route::get('/detailkm/{id}', [KnowledgeController::class, 'detailkm'])->name('knowledge.detailkm');
// Route::get('/showkm', [KnowledgeController::class, 'show_by_adminkmshow'])->name('knowledge.show_by_adminkmshow');
Route::get('/editkm/{id}', [KnowledgeController::class, 'editkm'])->name('knowledge.editkm');
Route::post('/editkm_process', [KnowledgeController::class, 'editkm_process'])->name('knowledge.editkm_process');
Route::get('/deletekm/{id}', [KnowledgeController::class, 'deletekm'])->name('knowledge.deletekm');
Route::delete('/knowledge/bulk_delete', [KnowledgeController::class, 'bulkDelete'])->name('knowledge.bulk_delete');


// Route::get('/show_by_admin', [KnowledgewhController::class, 'show_by_adminkmwhshow'])->name('knowledgewh.show_by_admin');
Route::get('/addkmwh', [KnowledgewhController::class, 'addkmwh'])->name('knowledgewh.addkmwh');
Route::post('/addkmwh_process', [KnowledgewhController::class, 'addkmwh_process'])->name('knowledgewh.addkmwh_process');
Route::get('/repositorykmwh', [KnowledgewhController::class, 'showkmwh'])->name('knowledgewh.showkmwh');
Route::get('/detailkmwh/{id}', [KnowledgewhController::class, 'detailkmwh'])->name('knowledgewh.detailkmwh');
Route::get('/showkmwh', [KnowledgewhController::class, 'show_by_adminkmwhshow'])->name('knowledgewh.show_by_adminkmwhshow');
Route::get('/editkmwh/{id}', [KnowledgewhController::class, 'editkmwh'])->name('knowledgewh.editkmwh');
Route::post('/editkmwh_process', [KnowledgewhController::class, 'editkmwh_process'])->name('knowledgewh.editkmwh_process');
Route::get('/deletekmwh/{id}', [KnowledgewhController::class, 'deletekmwh'])->name('knowledgewh.deletekm');
Route::delete('/bulkDelete', [KnowledgewhController::class, 'bulkDelete'])->name('deletekmwh.bulkDelete');


// Route::get('/show_by_adminogm', [KnowledgeogmController::class, 'show_by_adminkmogmshow'])->name('knowledgeogm.show_by_adminogm');
Route::get('/addkmogm', [KnowledgeogmController::class, 'addkmogm'])->name('knowledgeogm.addkmogm');
Route::post('/addkmogm_process', [KnowledgeogmController::class, 'addkmogm_process'])->name('knowledgeogm.addkmogm_process');
Route::get('/repositorykmogm', [KnowledgeogmController::class, 'showkmogm'])->name('knowledgeogm.showkmogm');
Route::get('/detailkmogm/{id}', [KnowledgeogmController::class, 'detailkmogm'])->name('knowledgeogm.detailkmogm');
Route::get('/showkmogm', [KnowledgeogmController::class, 'show_by_adminkmogmshow'])->name('knowledgeogm.show_by_adminkmogmshow');
Route::get('/editkmogm/{id}', [KnowledgeogmController::class, 'editkmogm'])->name('knowledgeogm.editkmogm');
Route::post('/editkmogm_process', [KnowledgeogmController::class, 'editkmogm_process'])->name('knowledgeogm.editkmogm_process');
Route::get('/deletekmogm/{id}', [KnowledgeogmController::class, 'deletekmogm'])->name('knowledgeogm.deletekmogm');
Route::delete('/delete-selected-kmogm', [KnowledgeogmController::class, 'deleteSelected'])->name('knowledgeogm.deleteSelected');


Route::get('/addvidmod', [VideoController::class, 'addvidmod'])->name('video.addvidmod');
Route::post('/addvidmod_process', [VideoController::class, 'addvidmod_process'])->name('video.addvidmod_process');
Route::get('/modkm', [VideoController::class, 'showvideomod'])->name('video.showvideomod');
Route::get('/detailvidmod/{id}', [VideoController::class, 'detailvidmod'])->name('video.detailkm');
Route::get('/showvideomod', [VideoController::class, 'show_by_adminvidshow'])->name('video.show_by_adminvidshow');
Route::get('/editvidmod/{id}', [VideoController::class, 'editvidmod'])->name('video.editvidmod');
Route::post('/editvid_process', [VideoController::class, 'editvid_process'])->name('video.editvid_process');
Route::get('/deletevidmod/{id}', [VideoController::class, 'deletevidmod'])->name('video.deletevidmod');
Route::delete('/video/bulk_delete', [VideoController::class, 'bulkDelete'])->name('video.bulk_delete');

Route::get('/addvidmodwh', [VideowhController::class, 'addvidmodwh'])->name('videowh.addvidmodwh');
Route::post('/addvidmodwh_process', [VideowhController::class, 'addvidmodwh_process'])->name('videowh.addvidmodwh_process');
Route::get('/modwh', [VideowhController::class, 'showvideomodwh'])->name('videowh.showvideomodwh');
Route::get('/detailvidwh/{id}', [VideowhController::class, 'detailvidwh'])->name('videowh.detailvidwh');
Route::get('/showvideomodwh', [VideowhController::class, 'show_by_adminvidwhshow'])->name('videowh.show_by_adminvidwhshow');
Route::get('/editvidwh/{id}', [VideowhController::class, 'editvidwh'])->name('videowh.editvidwh');
Route::post('/editvidwh_process', [VideowhController::class, 'editvidwh_process'])->name('videowh.editvidwh_process');
Route::get('/deletevidmodwh/{id}', [VideowhController::class, 'deletevidmodwh'])->name('videowh.deletevidmodwh');
Route::delete('videowh/bulk_delete', [VideowhController::class, 'bulkDelete'])->name('videowh.bulk_delete');
Route::post('/delete_multiplewh', [VideowhController::class, 'deleteMultiplewh'])->name('videowh.delete_multiplewh');

Route::get('/addvidmodogm', [VideoogmController::class, 'addvidmodogm'])->name('videoogm.addvidmodogm');
Route::post('/addvidmodogm_process', [VideoogmController::class, 'addvidmodogm_process'])->name('videoogm.addvidmodogm_process');
Route::get('/modogm', [VideoogmController::class, 'showvideomodogm'])->name('videoogm.showvideomodogm');
Route::get('/detailvidogm/{id}', [VideoogmController::class, 'detailvidogm'])->name('videoogm.detailvidogm');
Route::get('/showvideomodogm', [VideoogmController::class, 'show_by_adminvidogmshow'])->name('videoogm.show_by_adminvidogmshow');
Route::get('/editvidogm/{id}', [VideoogmController::class, 'editvidogm'])->name('videoogm.editvidogm');
Route::post('/editvidogm_process', [VideoogmController::class, 'editvidogm_process'])->name('videoogm.editvidogm_process');
Route::get('/deletevidmodogm/{id}', [VideoogmController::class, 'deletevidmodogm'])->name('videoogm.deletevidmodogm');
Route::post('/delete_multiple', [VideoogmController::class, 'deleteMultiple'])->name('videoogm.delete_multiple');




Route::get('/addlinkmod', [LinkmodController::class, 'addlinkmod'])->name('linkmod.addlinkmod');
Route::post('/addlinkmod_process', [LinkmodController::class, 'addlinkmod_process'])->name('linkmod.addlinkmod_process');
Route::get('/modlink', [LinkmodController::class, 'showlinkmod'])->name('linkmod.showlinkmod');
Route::get('/detaillinkmod/{id}', [LinkmodController::class, 'detaillinkmod'])->name('linkmod.detaillinkmod');
Route::get('/showlinkmod', [LinkmodController::class, 'show_by_adminlinkshow'])->name('linkmod.show_by_adminlinkshow');
Route::get('/editlinkmod/{id}', [LinkmodController::class, 'editlinkmod'])->name('linkmod.editlinkmod');
Route::post('/editlink_process', [LinkmodController::class, 'editlink_process'])->name('linkmod.editlink_process');
Route::get('/deletelinkmod/{id}', [LinkmodController::class, 'deletelinkmod'])->name('linkmod.deletelinkmod');
Route::delete('/linkmod/bulk_delete', [LinkmodController::class, 'bulkDelete'])->name('linkmod.bulk_delete');


Route::get('/addlinkogm', [LinkogmController::class, 'addlinkogm'])->name('linkogm.addlinkogm');
Route::post('/addlinkogm_process', [LinkogmController::class, 'addlinkogm_process'])->name('linkogm.addlinkogm_process');
Route::get('/ogmlink', [LinkogmController::class, 'showlinkogm'])->name('linkogm.showlinkogm');
Route::get('/detaillinkogm/{id}', [LinkogmController::class, 'detaillinkogm'])->name('linkogm.detaillinkogm');
Route::get('/showlinkogm', [LinkogmController::class, 'show_by_adminlinkogmshow'])->name('linkogm.show_by_adminlinkogmshow');
Route::get('/editlinkogm/{id}', [LinkogmController::class, 'editlinkogm'])->name('linkogm.editlinkogm');
Route::post('/editlinkogm_process', [LinkogmController::class, 'editlinkogm_process'])->name('linkogm.editlinkogm_process');
Route::get('/deletelinkogm/{id}', [LinkogmController::class, 'deletelinkogm'])->name('linkogm.deletelinkogm');
Route::delete('/deleteSelected', [LinkogmController::class, 'deleteSelected'])->name('linkogm.deleteSelected');

Route::get('/addlinkwh', [LinkwhController::class, 'addlinkwh'])->name('linkwh.addlinkwh');
Route::post('/addlinkwh_process', [LinkwhController::class, 'addlinkwh_process'])->name('linkwh.addlinkwh_process');
Route::get('/whlink', [LinkwhController::class, 'showlinkwh'])->name('linkwh.showlinkwh');
Route::get('/detaillinkwh/{id}', [LinkwhController::class, 'detaillinkwh'])->name('linkwh.detaillinkwh');
Route::get('/showlinkwh', [LinkwhController::class, 'show_by_adminlinkwhshow'])->name('linkwh.show_by_adminlinkwhshow');
Route::get('/editlinkwh/{id}', [LinkwhController::class, 'editlinkwh'])->name('linkwh.editlinkwh');
Route::post('/editlinkwh_process', [LinkwhController::class, 'editlinkwh_process'])->name('linkwh.editlinkwh_process');
Route::get('/deletelinkwh/{id}', [LinkwhController::class, 'deletelinkwh'])->name('linkwh.deletelinkwh');
Route::delete('/deleteSelectedwh', [LinkwhController::class, 'deleteSelectedwh'])->name('linkwh.deleteSelectedwh');


// For users
Route::get('/events', [EventController::class, 'showAll'])->name('events.show');
Route::get('/events/{id}', [EventController::class, 'detail'])->name('events.detail');


// For managing events
Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
Route::get('/admin/events', [EventController::class, 'index'])->name('events.admin');
Route::post('/admin/events/store', [EventController::class, 'store'])->name('events.store');
Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/admin/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/admin/events/bulk_delete', [EventController::class, 'bulkDelete'])->name('events.bulk_delete');
Route::get('/admin/events/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');

//Livestream
Route::get('/livestream', [LivestreamController::class, 'index'])->name('livestream')->middleware('auth');
Route::get('/admin/livestream', [LivestreamController::class, 'adminView'])->name('admin.livestream')->middleware('auth');
Route::post('/admin/livestream', [LivestreamController::class, 'updateLivestream'])->name('livestream.store')->middleware('auth');
Route::post('/admin/livestream/update', [LivestreamController::class, 'updateLivestream'])->name('admin.updateLivestream');
Route::put('/livestream/update', [LivestreamController::class, 'updateLivestream'])->name('livestream.update');
Route::delete('/livestream/delete', [LivestreamController::class, 'deleteLivestream'])->name('livestream.delete');











Route::get('/materi', function () {
    return view('materi');
});

Route::get('/materiwh', function () {
    return view('materiwh');
});

Route::get('/materiogm', function () {
    return view('materiogm');
});

Route::get('/materilinkmod', function () {
    return view('materilinkmod');
});

Route::get('/materilinkogm', function () {
    return view('materilinkogm');
});

Route::get('/materilinkwh', function () {
    return view('materilinkwh');
});

Route::get('/repositorylinkmod', function () {
    return view('repositorylinkmod');
});

Route::get('/repositorylinkogm', function () {
    return view('repositorylinkogm');
});

Route::get('/repositorylinkwh', function () {
    return view('repositorylinkwh');
});
