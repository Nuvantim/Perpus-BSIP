<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\NominalDenda;
use App\Models\Pinjam;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class SirkulasiController extends Controller
{
    public function pinjam()
    {
        $denda = NominalDenda::first();
        $pinjam = Pinjam::where('status',0)->get();
        $pinjaman = Pinjaman::get();
        return view('page.sirkulasi.peminjaman',compact('pinjam','pinjaman','denda'));
    }

    public function kembali()
    {
        $pinjam = Pinjam::where('status',1)->get();
        $pinjaman = Pinjaman::get();
        return view('page.sirkulasi.pengembalian',compact('pinjam','pinjaman'));
    }

    public function create()
    {
        $buku = Buku::where('jumlah','>',0)->get();
        return view('page.sirkulasi.tambah_pinjam',compact('buku'));
    }

    public function store(Request $request)
    {
        // return $request;
        if ($request->data_tabel == null || $request->lama < 1)
        {
            return back()->with('alert',[
                'type' => 'error',
                'message' => 'Tidak ada peminjaman tersimpan !'
              ]);
        }else 
        {
            //menambah pinjaman
            $pinjam = new Pinjam;
            $pinjam->nama = $request->nama;
            $pinjam->tgl_pinjam = $request->tanggal_pinjam;
            $tanggal_berikut = date('Y-m-d',strtotime('+'.$request->lama.' days',strtotime($request->tanggal_pinjam)));
            $pinjam->tgl_kembali = $tanggal_berikut;
            $pinjam->lama_pinjam = $request->lama;
            $pinjam->status = 0;
            $pinjam->save();
            $no_pinjam = $pinjam->id;

            $data_tabel = json_decode($request->input('data_tabel'), true);
            if (is_array($data_tabel)) {
                foreach ($data_tabel as $data) {
                    //selisihkan buku
                    $buku = Buku::where('id',$data)->first();
                    $selisih = $buku->jumlah - 1;
                    $buku->jumlah = $selisih;
                    $buku->save();
                    //menambah data pinjaman
                    $pinjaman = new Pinjaman;
                    $pinjaman->buku_id = $data;
                    $pinjaman->pinjam_id = $no_pinjam;
                    $pinjaman->save();
                }
            }
            return redirect()->route('sirkulasi.pinjam')->with('alert',[
                'type' => 'success',
                'message' => 'Data Peminjaman tersimpan !'
              ]);
        }
    }

    public function info($id)
    {
        $pinjam = Pinjam::find($id);
        $pinjaman = Pinjaman::where('pinjam_id',$id)->get();
        $denda = NominalDenda::first();
        return view('page.sirkulasi.info_pinjam',compact('pinjam','pinjaman','denda'));
    }

    public function return($id)
    {
        $pinjam = Pinjam::find($id);
        $pinjaman = Pinjaman::where('pinjam_id',$id)->get();
        $denda = NominalDenda::first();

        // mengetahui jumlah buku
        $jumlah = 0;
        foreach($pinjaman as $data_pinjam)
        {
          if($data_pinjam->pinjam_id == $pinjam->id)
          {
            //menambah jumlah buku
            $buku = Buku::find($data_pinjam->buku_id);
            $jumlah_buku = $buku->jumlah + 1;
            $buku->jumlah = $jumlah_buku;
            $buku->save();

            $jumlah++; 
          }
        }
        //menghitung nominal denda
        $tanggal = $pinjam->tgl_kembali;
        $todays = date('Y-m-d');
        $tanggal_1 = strtotime($tanggal);
        $tanggal_2 = strtotime($todays);
        $range = $tanggal_2-$tanggal_1;
        $acumulate = $range / 60 / 60 / 24;

        if($acumulate > 0)
        {
          $denda = $acumulate * $denda->nominal;
          $jumlah_denda =  $denda * $jumlah;
        }else {
          $jumlah_denda = 0;
        }

        // update data peminjaman
        $pinjam->tgl_balik = $todays;
        $pinjam->denda = $jumlah_denda;
        $pinjam->status = 1;
        $pinjam->save();
        return redirect()->route('sirkulasi.pinjam')->with('alert',[
            'type' => 'success',
            'message' => 'Data Pengembalian tersimpan !'
          ]);
    }

    public function detail($id)
    {
        $pinjam = Pinjam::find($id);
        $pinjaman = Pinjaman::where('pinjam_id',$id)->get();
        return view('page.sirkulasi.info_pengembalian',compact('pinjam','pinjaman'));

    }

    public function destroy($id)
    {
        $pinjaman = Pinjaman::where('pinjam_id',$id)->get();
        foreach($pinjaman as $pjn)
        {
            $pjn->delete();
        }
        $pinjam = Pinjam::find($id);
        $pinjam->delete();
        return redirect()->route('sirkulasi.kembali')->with('alert',[
            'type' => 'success',
            'message' => 'Data Pengembalian Dihapus !'
          ]);


    }
}
