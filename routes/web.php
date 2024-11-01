<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BelajarmandiriController;
use App\Http\Controllers\KnowledgeogmController;
use App\Http\Controllers\VideoogmController;
use App\Http\Controllers\LinkogmController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LivestreamController;
use App\Http\Controllers\DpController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\IktController;
use App\Http\Controllers\MvpController;
use App\Http\Controllers\InoController;
use App\Http\Controllers\FinlitController;
use App\Http\Controllers\WebinController;
use App\Http\Controllers\BukupintarwhController;
use App\Http\Controllers\PapanilmutokoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ModchecklistController as ModchecklistController;
use App\Http\Controllers\Admin\GapknowledgechecklistController as GapknowledgechecklistController;
use App\Http\Controllers\Admin\DpController as AdminDpController;
use App\Http\Controllers\Admin\IpController as AdminIpController;
use App\Http\Controllers\Admin\IktController as AdminIktController;
use App\Http\Controllers\Admin\MvpController as AdminMvpController;
use App\Http\Controllers\Admin\InoController as AdminInoController;
use App\Http\Controllers\Admin\FinlitController as AdminFinlitController;
use App\Http\Controllers\Admin\WebinController as AdminWebinarController;
use App\Http\Controllers\Admin\VideoDpController;
use App\Http\Controllers\Admin\VideoIpController;
use App\Http\Controllers\Admin\VideoIktController;
use App\Http\Controllers\Admin\VideoMvpController;
use App\Http\Controllers\Admin\VideoInoController;
use App\Http\Controllers\Admin\VideoFinlitController;
use App\Http\Controllers\Admin\VideoWebinController;
use App\Http\Controllers\RepositoryallController;

Route::get('/', [DashboardController::class, 'index'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('signin');

Route::get('/helpcenter', [BeritaController::class, 'helpcenter'])->name('helpcenter');



Route::middleware('auth', 'role:admin|auditor')->group(function () {

    Route::get('users/import', [UserController::class, 'showImportForm'])->name('users.import.form');
    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    // Route::put('/users/{address}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/selected-users', [UserController::class, 'deleteCheckedUser'])->name('user.deleteSelected');

    Route::prefix('admin')->group(function () {
        Route::get('/checklist', [ModchecklistController::class, 'index'])->name('admin.checklist.index');
        Route::post('/checklist/{user}', [ModchecklistController::class, 'update'])->name('admin.checklist.update');
    });
    Route::prefix('admin')->group(function () {
        Route::get('/gapknow', [GapknowledgechecklistController::class, 'index'])->name('admin.gapknow.index');
        Route::post('/gapknow/{user}', [GapknowledgechecklistController::class, 'update'])->name('admin.gapknow.update');
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
        Route::get('/video', [VideoDpController::class, 'index'])->name('admin.dp.video');
        Route::get('/video/create', [VideoDpController::class, 'create'])->name('admin.dp.video.create');
        Route::post('/video', [VideoDpController::class, 'store'])->name('admin.dp.video.store');
        Route::get('/video/{id}/edit', [VideoDpController::class, 'edit'])->name('admin.dp.video.edit');
        Route::put('/video/{id}', [VideoDpController::class, 'update'])->name('admin.dp.video.update');
        Route::get('/video/{id}', [VideoDpController::class, 'destroy'])->name('admin.dp.video.destroy');
        Route::post('/video/bulk-delete', [VideoDpController::class, 'bulkDelete'])->name('admin.dp.video.bulk_delete');
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
        Route::get('/video', [VideoIpController::class, 'index'])->name('admin.ip.video');
        Route::get('/video/create', [VideoIpController::class, 'create'])->name('admin.ip.video.create');
        Route::post('/video', [VideoIpController::class, 'store'])->name('admin.ip.video.store');
        Route::get('/video/{id}/edit', [VideoIpController::class, 'edit'])->name('admin.ip.video.edit');
        Route::put('/video/{id}', [VideoIpController::class, 'update'])->name('admin.ip.video.update');
        Route::get('/video/{id}', [VideoIpController::class, 'destroy'])->name('admin.ip.video.destroy');
        Route::post('/video/bulk-delete', [VideoIpController::class, 'bulkDelete'])->name('admin.ip.video.bulk_delete');
    });

    Route::prefix('admin/ikt')->group(function () {
        Route::get('/', [AdminIktController::class, 'index'])->name('admin.ikt.index');
        Route::get('/materi', [AdminIktController::class, 'materiDokumen'])->name('admin.ikt.materi');
        Route::post('/materi/create', [AdminIktController::class, 'store'])->name('admin.ikt.materi.store');
        Route::get('/materi/create', [AdminIktController::class, 'create'])->name('admin.ikt.materi.create');
        Route::get('/materi/{id}/edit', [AdminIktController::class, 'edit'])->name('admin.ikt.materi.edit');
        Route::put('/materi/{id}', [AdminIktController::class, 'update'])->name('admin.ikt.materi.update');
        Route::get('/materi/{id}', [AdminIktController::class, 'destroy'])->name('admin.ikt.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminIktController::class, 'bulkDelete'])->name('admin.ikt.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoIktController::class, 'index'])->name('admin.ikt.video');
        Route::get('/video/create', [VideoIktController::class, 'create'])->name('admin.ikt.video.create');
        Route::post('/video', [VideoIktController::class, 'store'])->name('admin.ikt.video.store');
        Route::get('/video/{id}/edit', [VideoIktController::class, 'edit'])->name('admin.ikt.video.edit');
        Route::put('/video/{id}', [VideoIktController::class, 'update'])->name('admin.ikt.video.update');
        Route::get('/video/{id}', [VideoIktController::class, 'destroy'])->name('admin.ikt.video.destroy');
        Route::post('/video/bulk-delete', [VideoIktController::class, 'bulkDelete'])->name('admin.ikt.video.bulkDelete');
    });

    Route::prefix('admin/mvp')->group(function () {
        Route::get('/', [AdminMvpController::class, 'index'])->name('admin.mvp.index');
        Route::get('/materi', [AdminMvpController::class, 'materiDokumen'])->name('admin.mvp.materi');
        Route::post('/materi/create', [AdminMvpController::class, 'store'])->name('admin.mvp.materi.store');
        Route::get('/materi/create', [AdminMvpController::class, 'create'])->name('admin.mvp.materi.create');
        Route::get('/materi/{id}/edit', [AdminMvpController::class, 'edit'])->name('admin.mvp.materi.edit');
        Route::put('/materi/{id}', [AdminMvpController::class, 'update'])->name('admin.mvp.materi.update');
        Route::get('/materi/{id}', [AdminMvpController::class, 'destroy'])->name('admin.mvp.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminMvpController::class, 'bulkDelete'])->name('admin.mvp.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoMvpController::class, 'index'])->name('admin.mvp.video');
        Route::get('/video/create', [VideoMvpController::class, 'create'])->name('admin.mvp.video.create');
        Route::post('/video', [VideoMvpController::class, 'store'])->name('admin.mvp.video.store');
        Route::get('/video/{id}/edit', [VideoMvpController::class, 'edit'])->name('admin.mvp.video.edit');
        Route::put('/video/{id}', [VideoMvpController::class, 'update'])->name('admin.mvp.video.update');
        Route::get('/video/{id}', [VideoMvpController::class, 'destroy'])->name('admin.mvp.video.destroy');
        Route::post('/video/bulk-delete', [VideoMvpController::class, 'bulkDelete'])->name('admin.mvp.video.bulkDelete');
    });

    Route::prefix('admin/ino')->group(function () {
        Route::get('/', [AdminInoController::class, 'index'])->name('admin.ino.index');
        Route::get('/materi', [AdminInoController::class, 'materiDokumen'])->name('admin.ino.materi');
        Route::post('/materi/create', [AdminInoController::class, 'store'])->name('admin.ino.materi.store');
        Route::get('/materi/create', [AdminInoController::class, 'create'])->name('admin.ino.materi.create');
        Route::get('/materi/{id}/edit', [AdminInoController::class, 'edit'])->name('admin.ino.materi.edit');
        Route::put('/materi/{id}', [AdminInoController::class, 'update'])->name('admin.ino.materi.update');
        Route::get('/materi/{id}', [AdminInoController::class, 'destroy'])->name('admin.ino.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminInoController::class, 'bulkDelete'])->name('admin.ino.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoInoController::class, 'index'])->name('admin.ino.video');
        Route::get('/video/create', [VideoInoController::class, 'create'])->name('admin.ino.video.create');
        Route::post('/video', [VideoInoController::class, 'store'])->name('admin.ino.video.store');
        Route::get('/video/{id}/edit', [VideoInoController::class, 'edit'])->name('admin.ino.video.edit');
        Route::put('/video/{id}', [VideoInoController::class, 'update'])->name('admin.ino.video.update');
        Route::get('/video/{id}', [VideoInoController::class, 'destroy'])->name('admin.ino.video.destroy');
        Route::post('/video/bulk-delete', [VideoInoController::class, 'bulkDelete'])->name('admin.ino.video.bulkDelete');
    });

    Route::prefix('admin/finlit')->group(function () {
        Route::get('/', [AdminFinlitController::class, 'index'])->name('admin.finlit.index');
        Route::get('/materi', [AdminFinlitController::class, 'materiDokumen'])->name('admin.finlit.materi');
        Route::post('/materi/create', [AdminFinlitController::class, 'store'])->name('admin.finlit.materi.store');
        Route::get('/materi/create', [AdminFinlitController::class, 'create'])->name('admin.finlit.materi.create');
        Route::get('/materi/{id}/edit', [AdminFinlitController::class, 'edit'])->name('admin.finlit.materi.edit');
        Route::put('/materi/{id}', [AdminFinlitController::class, 'update'])->name('admin.finlit.materi.update');
        Route::get('/materi/{id}', [AdminFinlitController::class, 'destroy'])->name('admin.finlit.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminFinlitController::class, 'bulkDelete'])->name('admin.finlit.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoFinlitController::class, 'index'])->name('admin.finlit.video');
        Route::get('/video/create', [VideoFinlitController::class, 'create'])->name('admin.finlit.video.create');
        Route::post('/video', [VideoFinlitController::class, 'store'])->name('admin.finlit.video.store');
        Route::get('/video/{id}/edit', [VideoFinlitController::class, 'edit'])->name('admin.finlit.video.edit');
        Route::put('/video/{id}', [VideoFinlitController::class, 'update'])->name('admin.finlit.video.update');
        Route::get('/video/{id}', [VideoFinlitController::class, 'destroy'])->name('admin.finlit.video.destroy');
        Route::post('/video/bulk-delete', [VideoFinlitController::class, 'bulkDelete'])->name('admin.finlit.video.bulkDelete');
    });

    Route::prefix('admin/webinar')->group(function () {
        Route::get('/', [AdminWebinarController::class, 'index'])->name('admin.webinar.index');
        Route::get('/materi', [AdminWebinarController::class, 'materiDokumen'])->name('admin.webinar.materi');
        Route::post('/materi/create', [AdminWebinarController::class, 'store'])->name('admin.webinar.materi.store');
        Route::get('/materi/create', [AdminWebinarController::class, 'create'])->name('admin.webinar.materi.create');
        Route::get('/materi/{id}/edit', [AdminWebinarController::class, 'edit'])->name('admin.webinar.materi.edit');
        Route::put('/materi/{id}', [AdminWebinarController::class, 'update'])->name('admin.webinar.materi.update');
        Route::get('/materi/{id}', [AdminWebinarController::class, 'destroy'])->name('admin.webinar.materi.destroy');
        Route::post('/materi/bulk-delete', [AdminWebinarController::class, 'bulkDelete'])->name('admin.webinar.materi.bulkDelete');

        // Video routes
        Route::get('/video', [VideoWebinController::class, 'index'])->name('admin.webinar.video');
        Route::get('/video/create', [VideoWebinController::class, 'create'])->name('admin.webinar.video.create');
        Route::post('/video', [VideoWebinController::class, 'store'])->name('admin.webinar.video.store');
        Route::get('/video/{id}/edit', [VideoWebinController::class, 'edit'])->name('admin.webinar.video.edit');
        Route::put('/video/{id}', [VideoWebinController::class, 'update'])->name('admin.webinar.video.update');
        Route::get('/video/{id}', [VideoWebinController::class, 'destroy'])->name('admin.webinar.video.destroy');
        Route::post('/video/bulk-delete', [VideoWebinController::class, 'bulkDelete'])->name('admin.webinar.video.bulkDelete');
    });

    // news
    Route::get('/add', [BeritaController::class, 'add'])->name('berita.add');
    Route::post('/add_process', [BeritaController::class, 'add_process'])->name('berita.add_process');
    Route::get('/adminshow', [BeritaController::class, 'show_by_admin'])->name('berita.show_by_admin');
    Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::post('/edit_process', [BeritaController::class, 'edit_process'])->name('berita.edit_process');
    Route::get('/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
    Route::delete('/bulk_delete', [BeritaController::class, 'bulkDelete'])->name('berita.bulk_delete');



    // For managing events events
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
    Route::get('/admin/events', [EventController::class, 'index'])->name('events.admin');
    Route::post('/admin/events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/admin/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/admin/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/admin/events/bulk_delete', [EventController::class, 'bulkDelete'])->name('events.bulk_delete');
    Route::get('/admin/events/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // livestream
    Route::get('/admin/livestream', [LivestreamController::class, 'adminView'])->name('admin.livestream')->middleware('auth');
    Route::post('/admin/livestream', [LivestreamController::class, 'updateLivestream'])->name('livestream.store')->middleware('auth');
    Route::post('/admin/livestream/update', [LivestreamController::class, 'updateLivestream'])->name('admin.updateLivestream');
    Route::put('/livestream/update', [LivestreamController::class, 'updateLivestream'])->name('livestream.update');
    Route::delete('/livestream/delete', [LivestreamController::class, 'deleteLivestream'])->name('livestream.delete');

    // belajar mandiri
    Route::get('/addmandiri', [BelajarmandiriController::class, 'addmandiri'])->name('belajarmandiri.addmandiri');
    Route::post('/addmandiri_process', [BelajarmandiriController::class, 'addmandiri_process'])->name('belajarmandiri.addmandiri_process');
    Route::get('/adminmandirishow', [BelajarmandiriController::class, 'show_by_adminmandirishow'])->name('belajarmandiri.show_by_adminmandirishow');
    Route::get('/editmandiri/{id}', [BelajarmandiriController::class, 'editmandiri'])->name('belajarmandiri.editmandiri');
    Route::post('/editmandiri_process', [BelajarmandiriController::class, 'editmandiri_process'])->name('belajarmandiri.editmandiri_process');
    Route::get('/deletemandiri/{id}', [BelajarmandiriController::class, 'deletemandiri'])->name('belajarmandiri.deletemandiri');
    Route::delete('/bulk_deleted', [BelajarmandiriController::class, 'bulkDeleteMandiri'])->name('belajarmandiri.berita_bulk_delete');


    // SME
    Route::get('/materiadminmodogm', function () {
        return view('materiadminmodogm');
    });
    Route::get('/materilinkogm', function () {
        return view('materilinkogm');
    });
    Route::get('/addvidmodogm', [VideoogmController::class, 'addvidmodogm'])->name('videoogm.addvidmodogm');
    Route::post('/addvidmodogm_process', [VideoogmController::class, 'addvidmodogm_process'])->name('videoogm.addvidmodogm_process');
    Route::get('/detailvidogm/{id}', [VideoogmController::class, 'detailvidogm'])->name('videoogm.detailvidogm');
    Route::get('/showvideomodogm', [VideoogmController::class, 'show_by_adminvidogmshow'])->name('videoogm.show_by_adminvidogmshow');
    Route::get('/editvidogm/{id}', [VideoogmController::class, 'editvidogm'])->name('videoogm.editvidogm');
    Route::post('/editvidogm_process', [VideoogmController::class, 'editvidogm_process'])->name('videoogm.editvidogm_process');
    Route::get('/deletevidmodogm/{id}', [VideoogmController::class, 'deletevidmodogm'])->name('videoogm.deletevidmodogm');
    Route::post('/delete_multiple', [VideoogmController::class, 'deleteMultiple'])->name('videoogm.delete_multiple');
    Route::get('/showkmogm', [KnowledgeogmController::class, 'show_by_adminkmogmshow'])->name('knowledgeogm.show_by_adminkmogmshow');
    Route::get('/editkmogm/{id}', [KnowledgeogmController::class, 'editkmogm'])->name('knowledgeogm.editkmogm');
    Route::post('/editkmogm_process', [KnowledgeogmController::class, 'editkmogm_process'])->name('knowledgeogm.editkmogm_process');
    Route::get('/deletekmogm/{id}', [KnowledgeogmController::class, 'deletekmogm'])->name('knowledgeogm.deletekmogm');
    Route::delete('/delete-selected-kmogm', [KnowledgeogmController::class, 'deleteSelected'])->name('knowledgeogm.deleteSelected');
    Route::get('/addkmogm', [KnowledgeogmController::class, 'addkmogm'])->name('knowledgeogm.addkmogm');
    Route::post('/addkmogm_process', [KnowledgeogmController::class, 'addkmogm_process'])->name('knowledgeogm.addkmogm_process');
    Route::get('/showlinkogm', [LinkogmController::class, 'show_by_adminlinkogmshow'])->name('linkogm.show_by_adminlinkogmshow');
    Route::get('/editlinkogm/{id}', [LinkogmController::class, 'editlinkogm'])->name('linkogm.editlinkogm');
    Route::post('/editlinkogm_process', [LinkogmController::class, 'editlinkogm_process'])->name('linkogm.editlinkogm_process');
    Route::get('/deletelinkogm/{id}', [LinkogmController::class, 'deletelinkogm'])->name('linkogm.deletelinkogm');
    Route::delete('/deleteSelected', [LinkogmController::class, 'deleteSelected'])->name('linkogm.deleteSelected');
    Route::get('/addlinkogm', [LinkogmController::class, 'addlinkogm'])->name('linkogm.addlinkogm');
    Route::post('/addlinkogm_process', [LinkogmController::class, 'addlinkogm_process'])->name('linkogm.addlinkogm_process');

    Route::get('/materiadmin', function () {
        return view('materiadmin');
    });


    Route::get('/generallearnadmin', function () {
        return view('generallearnadmin');
    });

    Route::get('/kmadmin', [BeritaController::class, 'kmadmin'])->name('kmadmin');
});


Route::middleware('auth', 'role:user')->group(function () {
    // Route untuk DP
    Route::get('/dp', [DpController::class, 'index'])->name('dp.index');
    Route::get('/dp/materi', [DpController::class, 'materiDokumen'])->name('dp.materi');
    Route::get('/dp/video', [DpController::class, 'video'])->name('dp.video');

    // Route untuk IP
    Route::get('/ip', [IpController::class, 'index'])->name('ip.index');
    Route::get('/ip/materi', [IpController::class, 'materiDokumen'])->name('ip.materi');
    Route::get('/ip/video', [IpController::class, 'video'])->name('ip.video');

    // Route untuk IKT
    Route::get('/ikt', [IktController::class, 'index'])->name('ikt.index');
    Route::get('/ikt/materi', [IktController::class, 'materiDokumen'])->name('ikt.materi');
    Route::get('/ikt/video', [IktController::class, 'video'])->name('ikt.video');

    // Route untuk MVP
    Route::get('/mvp', [MvpController::class, 'index'])->name('mvp.index');
    Route::get('/mvp/materi', [MvpController::class, 'materiDokumen'])->name('mvp.materi');
    Route::get('/mvp/video', [MvpController::class, 'video'])->name('mvp.video');

    // Route untuk Inofest
    Route::get('/ino', [InoController::class, 'index'])->name('ino.index');
    Route::get('/ino/materi', [InoController::class, 'materiDokumen'])->name('ino.materi');
    Route::get('/ino/video', [InoController::class, 'video'])->name('ino.video');

    // Route untuk Finlit
    Route::get('/finlit', [FinlitController::class, 'index'])->name('finlit.index');
    Route::get('/finlit/materi', [FinlitController::class, 'materiDokumen'])->name('finlit.materi');
    Route::get('/finlit/video', [FinlitController::class, 'video'])->name('finlit.video');

    // Route untuk Webinar
    Route::get('/webinar', [WebinController::class, 'index'])->name('webinar.index');
    Route::get('/webinar/materi', [WebinController::class, 'materiDokumen'])->name('webinar.materi');
    Route::get('/webinar/video', [WebinController::class, 'video'])->name('webinar.video');

    Route::get('/materi', [RepositoryallController::class, 'materi'])->name('materimod');
    Route::get('/materiogm', [RepositoryallController::class, 'materiogm'])->name('materiogm');
    Route::get('/generallearn', [RepositoryallController::class, 'generallearn'])->name('generallearn');

    // SME
    Route::get('/repositorylinkogm', function () {
        return view('repositorylinkogm');
    });



    Route::get('/detailkmogm/{id}', [KnowledgeogmController::class, 'detailkmogm'])->name('knowledgeogm.detailkmogm');
    Route::get('/repositorykmogm', [KnowledgeogmController::class, 'showkmogm'])->name('knowledgeogm.showkmogm');

    Route::get('/modogm', [VideoogmController::class, 'showvideomodogm'])->name('videoogm.showvideomodogm');

    Route::get('/repositoryall', [BeritaController::class, 'repositoryall'])->name('repositoryall');

    Route::get('/belajarmandiriall', [BeritaController::class, 'belajarmandiriall'])->name('belajarmandiriall');


    Route::get('/ogmlink', [LinkogmController::class, 'showlinkogm'])->name('linkogm.showlinkogm');

    // belajar mandiri
    Route::get('/belajarmandiri', [BelajarmandiriController::class, 'showmandiri'])->name('belajarmandiri.show');
    Route::get('/detailmandiri/{id}', [BelajarmandiriController::class, 'detailmandiri'])->name('belajarmandiri.detailmandiri');

    // buku pintar wh
    Route::get('/bukupintarwh', [BukupintarwhController::class, 'index'])->name('bukpin.index');

    // papan ilmu toko
    Route::get('/papanilmutoko', [PapanilmutokoController::class, 'index'])->name('papilmu.index');

    // papan ilmu toko
    Route::get('/ProfileController', [ProfileController::class, 'index'])->name('ProfileController');
});

//news
Route::get('/beritamidi', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/detail/{id}', [BeritaController::class, 'detail'])->name('berita.detail');

// livestream
Route::get('/livestream', [LivestreamController::class, 'index'])->name('livestream');

// For users
Route::get('/events', [EventController::class, 'showAll'])->name('events.show');
Route::get('/events/{id}', [EventController::class, 'detail'])->name('events.detail');
