<?php

namespace App\Http\Controllers;
use App\Models\Rak;
use App\Models\Kategori;
use App\Models\Buku;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::get();
        return view('page.buku.buku',compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::get();
        $rak = Rak::get();
        return view('page.buku.tambah_buku',compact('kategori','rak'));
    }


    public function info($id)
    {
        $buku = Buku::find($id);
        return view('page.buku.info_buku',compact('buku'));
    }

    public function store(Request $request)
    {
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->isbn = $request->isbn;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->kategori_id = $request->kategori;
        $buku->rak_id = $request->rak;
        $buku->tahun = $request->tahun;
        $buku->isi = $request->isi;
        $buku->jumlah = $request->jumlah;
        $buku->no_induk = $request->induk;
        $buku->rf_id = $request->rf_id;
        $buku->tanggal_masuk = $request->tanggal_masuk;
        $buku->no_barcode = $request->barcode;
        $buku->peroleh = $request->peroleh;
        if($request->sampul)
        {
          $buku->sampul = $request->file('sampul')->hashName();
          $path = $request->file('sampul')->store('sampul', 'public');
        }
        $buku->save();
        return redirect()->route('buku.index')->with('alert',[
            'type' => 'success',
            'message' => 'Buku Disimpan !'
          ]);
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategori = Kategori::get();
        $rak = Rak::get();
        return view('page.buku.edit_buku',compact('buku','kategori','rak'));
    }

    public function update(Request $request,$id)
    {
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->isbn = $request->isbn;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->kategori_id = $request->kategori;
        $buku->rak_id = $request->rak;
        $buku->tahun = $request->tahun;
        $buku->isi = $request->isi;
        $buku->jumlah = $request->jumlah;
        $buku->no_induk = $request->induk;
        $buku->rf_id = $request->rf_id;
        $buku->tanggal_masuk = $request->tanggal_masuk;
        $buku->no_barcode = $request->barcode;
        $buku->peroleh = $request->peroleh;
        if($request->sampul)
        {
          $filepath = public_path('storage/sampul/' . $buku->sampul);
          if (file_exists($filepath)){
            unlink($filepath);
          }
          $buku->sampul = $request->file('sampul')->hashName();
          $request->file('sampul')->store('sampul', 'public');
        }
        $buku->save();
        return redirect()->route('buku.index')->with('alert',[
            'type' => 'success',
            'message' => 'Buku diperbarui !'
          ]);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        if($buku->sampul != null){
            $filepath = public_path('storage/sampul/' . $buku->sampul);
            if (file_exists($filepath)){
                unlink($filepath);
            }
        }
        $buku->delete();
        return redirect()->route('buku.index')->with('alert',[
            'type' => 'success',
            'message' => 'Buku Terhapus !'
          ]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file'); // Ambil file CSV dari request
        // Buka file CSV
        if (($handle = fopen($file, 'r')) !== false) {
            // Skip the first line
            fgetcsv($handle, 1000, ',');
            
            // Baca baris demi baris
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $buku = new Buku();
                $buku->judul = $data[1];
                $buku->isbn = $data[2];
                $buku->penulis = $data[3];
                $buku->penerbit = $data[4];
                $buku->kategori_id = $data[5];
                $buku->rak_id = $data[6];                   
                $buku->tahun = $data[7];
                $buku->isi = $data[8];                    
                $buku->jumlah = $data[9];
                $buku->no_induk = $data[10];
                $buku->rf_id = $data[11];
                $buku->no_barcode = $data[12];
                $buku->tanggal_masuk = $data[13];
                $buku->peroleh = $data[14];
                $buku->save();
            }
            fclose($handle);
        }
        return redirect()->route('buku.index')->with('alert',[
            'type' => 'success',
            'message' => 'Data Buku Tersimpan !'
          ]);
    }
}
