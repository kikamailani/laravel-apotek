<?php

// lokasi file
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //-r : resorces : membuat method / func untuk crud nya
    // mengambil banyak data/menampilkan halaman awal (crud : R all)
    public function index()
    {
        //proses pemanggilan file blade
        // memanggil file dalam folder : namafolder.file
        return view('landing-page');
        }
    // menampilkan halaman form tambah data
    public function create()
    {

    }
    // menambahkan data ke database/mengirim data dari form create
    public function store(Request $request)
    {
        //
    }
    // menampilkan hanya satu data (detail data)
    public function show(string $id)
    {
        //
    }
    // menambah halaman untuk edit data
    public function edit(string $id)
    {
        //
    }
    // mengubah data di database/memproses data dari from edit
    public function update(Request $request, string $id)
    {
        //
    }
    // menghapus data di data base
    public function destroy(string $id)
    {
        //
    }
}
