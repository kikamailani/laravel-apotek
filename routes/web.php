<?php

use Illuminate\Support\Facades\Route;
//use untuk import file
//use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedicineController;
use App\Models\Medicine;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view(view:'landing-page');
});

route::prefix('/medicine')->name('medicine.')->group(function() {
    Route::get('/create',[MedicineController::class, 'create'])->name('create');
    Route::post('/store',[MedicineController::class, 'store'])->name('store');
    Route::get('/', [MedicineController::class, 'index'])->name('home');
    Route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
    Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
    Route::get('/data/stock', [MedicineController::class, 'stock'])->name('stock');
    Route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
    Route::get('/data/stock', [MedicineController::class, 'stockUpdate'])->name('stock.update');
});
//struktur routing laravel :
// route::httpMethod('/nama-path' , [NamaController::class, 'namaFunc'])->name ('/identitas_route');
// Http Method :
// 1. get -> mengambil data/menampilkan data
// 2. post -> menambahkan data baru ke db
// 3. path/cut -> mengubah data di db
// 4. delete -> menghapus data di db
// Route::get('/landing-page', [LandingPageController::class, 'index'])->name
// ('landing_page');
