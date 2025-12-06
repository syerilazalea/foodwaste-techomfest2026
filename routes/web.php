<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardAgendaController;
use App\Http\Controllers\Dashboard\DashboardArtikelController;
use App\Http\Controllers\Dashboard\DashboardChatController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardKampanyeController;
use App\Http\Controllers\Dashboard\DataDaurUlangController;
use App\Http\Controllers\Dashboard\DataMakananController;
use App\Http\Controllers\Dashboard\KatalogDaurUlangController;
use App\Http\Controllers\Dashboard\KatalogMakananController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Setting\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::prefix('/')->name('home.')->group(function () {

    Route::get('/home', [HomePageController::class, 'index'])->name('index');

    Route::get('/kampanye', [HomePageController::class, 'kampanye'])->name('kampanye');
    Route::get('/kampanye/load-more-artikel', [HomePageController::class, 'loadMoreArtikel'])->name('artikel.loadMore');
    Route::get('/kampanye/load-more-agenda', [HomePageController::class, 'loadMoreAgenda'])->name('agenda.loadMore');

    Route::get('/artikel/{slug}', [HomePageController::class, 'showArtikel'])->name('artikel.show');
    Route::get('/agenda/{slug}', [HomePageController::class, 'showAgenda'])->name('agenda.show');

    Route::get('/tentang-kami', [HomePageController::class, 'tentangKami'])->name('tentangKami');
});

// Group routes dengan prefix "auth"
Route::prefix('auth')->name('auth.')->group(function () {

    // Form Login
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    // Proses Login
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    // Form Register
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    // Proses Register
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    // Logout
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// Group routes dengan prefix "dashboard" menggunakan middleware AuthCheck
Route::prefix('dashboard')->name('dashboard.')->middleware(AuthCheck::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::post('/pengambilanMakanan/{id}/mulai', [DashboardController::class, 'mulaiPengambilanMakanan'])->name('pengambilanMakanan.mulai');
    Route::post('/pengambilanDaurUlang/{id}/mulai', [DashboardController::class, 'mulaiPengambilanDaurUlang'])->name('pengambilanDaurUlang.mulai');

    Route::post('/konfirmasiMakanan/{id}/mulai', [DashboardController::class, 'makananSudahDiambil'])->name('konfirmasiMakanan.mulai');

    Route::get('/topbar', [DashboardController::class, 'topbar'])->name('topbar');

    //Page pesan
    Route::get('/pesan', [DashboardChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/trigger', [DashboardChatController::class, 'triggerPage'])->name('chat.trigger');
    Route::get('/chat/contacts', [DashboardChatController::class, 'getContacts'])->name('chat.contacts');
    Route::get('/chat/messages/{id}', [DashboardChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [DashboardChatController::class, 'sendMessage'])->name('chat.send');

    //tabel data daur ulang
    Route::get('/data-daur-ulang', [DataDaurUlangController::class, 'index'])->name('dataDaurUlang.index');
    Route::post('/data-daur-ulang/store', [DataDaurUlangController::class, 'store'])->name('dataDaurUlang.store');
    Route::put('/dataDaurUlang/{dataDaurUlang}', [DataDaurUlangController::class, 'update'])->name('dataDaurUlang.update');
    Route::post('/data-daur-ulang/delete/{dataDaurUlang}', [DataDaurUlangController::class, 'destroy'])->name('dataDaurUlang.destroy');

    //tabel data makanan
    Route::get('/data-makanan', [DataMakananController::class, 'index'])->name('dataMakanan.index');
    Route::post('/data-makanan/store', [DataMakananController::class, 'store'])->name('dataMakanan.store');
    Route::put('/data-makanan/{dataMakanan}', [DataMakananController::class, 'update'])->name('dataMakanan.update');
    Route::post('/data-makanan/delete/{dataMakanan}', [DataMakananController::class, 'destroy'])->name('dataMakanan.destroy');

    //page dashboard kampanye
    Route::get('/kampanye', [DashboardKampanyeController::class, 'index'])->name('kampanye.index'); // untuk load tabel
    Route::put('/kampanye/artikel/{artikel:slug}', [DashboardKampanyeController::class, 'updateArtikel'])->name('kampanyeArtikel.update');
    Route::put('/kampanye/agenda/{slug}', [DashboardKampanyeController::class, 'updateAgenda'])->name('kampanyeAgenda.update');

    //tabel agenda
    Route::get('/tabel-agenda', [DashboardAgendaController::class, 'index'])->name('agenda.index'); // untuk load tabel
    Route::get('/agenda/search', [DashboardAgendaController::class, 'search'])->name('agenda.search');
    Route::post('/agenda/store', [DashboardAgendaController::class, 'store'])->name('agenda.store'); // create
    Route::put('/agenda/{id}', [DashboardAgendaController::class, 'update'])->name('agenda.update'); // edit
    Route::delete('/tabel-agenda/{slug}', [DashboardAgendaController::class, 'destroy'])->name('agenda.destroy');

    //tabel Artikel
    Route::get('/tabel-artikel', [DashboardArtikelController::class, 'index'])->name('artikel.index'); // untuk load tabel
    Route::get('/tabel-artikel/search', [DashboardArtikelController::class, 'search'])->name('artikel.search');
    Route::post('/tabel-artikel/store', [DashboardArtikelController::class, 'store'])->name('artikel.store'); // create
    Route::put('/artikel/{artikel:slug}', [DashboardArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/tabel-artikel/{slug}', [DashboardArtikelController::class, 'destroy'])->name('artikel.destroy');
});

// Group routes dengan prefix "dashboard" menggunakan middleware AuthCheck
Route::prefix('katalog')->name('katalog.')->group(function () {
    //katelog makanan
    Route::get('/makanan', [KatalogMakananController::class, 'index'])->name('katalogMakanan.index');
    Route::post('/makanan/{id}/ambil', [KatalogMakananController::class, 'ambil'])->name('katalogMakanan.ambil');

    //katalog DAUR ULANG
    Route::get('/daur-ulang', [KatalogDaurUlangController::class, 'index'])->name('katalogDaurUlang.index');
    Route::post('/daur-ulang/{id}/ambil', [KatalogDaurUlangController::class, 'ambil'])->name('katalaogDaurUlang.ambil');
});

// Group routes dengan prefix "settings" menggunakan middleware AuthCheck
Route::prefix('settings')->middleware(AuthCheck::class)->group(function () {
    Route::get('/', [SettingController::class, 'profile'])->name('settings.profile');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('settings.updateProfile');
    Route::post('/update-kontak', [SettingController::class, 'updateKontak'])->name('settings.updateKontak');
    Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('settings.updatePassword');
});

Route::middleware(['web', 'auth'])->group(function () {
    //
});


//offline sw

Route::get('/offline', function () {
    return view('offline');
})->name('offline');

Route::get('/serviceworker.js', function () {
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);

    return response()->view('serviceworker', [
        'manifest' => $manifest
    ])->header('Content-Type', 'application/javascript');
});
