<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PengunjungController extends Controller
{
    public function listPengunjung()
    {
        $pengunjung = Pengunjung::get();
        return view('page.pengunjung.pengunjung',compact('pengunjung'));
    }
    
    public function addPengunjung()
    {
        return view('page.pengunjung.tambah_pengunjung');
    }

    public function storePengunjung(Request $request)
    {
        $tanggal = date('Y-m-d');
        $pengunjung = new Pengunjung;
        $pengunjung->nama = $request-> nama;
        $pengunjung->instansi = $request->instansi;
        $pengunjung->alamat = $request->alamat;
        $pengunjung->jenis_kelamin = $request->jenis_kelamin;
        $pengunjung->tujuan = $request->tujuan;
        $pengunjung->tanggal = $tanggal;
        $pengunjung->save();
        return redirect()->route('pengunjung.create');
    }

    public function download(Request $request)
    {
        $tgl = date('d-m-Y');
        $awal = $request->dari_tanggal;
        $akhir = $request->sampai_tanggal;

        // Fetch data
        $pengunjung = Pengunjung::whereBetween('tanggal', [$awal, $akhir])
        ->select('nama', 'instansi', 'alamat', 'jenis_kelamin', 'tujuan', 'tanggal')
        ->get();

        // Create a temporary file
        $filename = 'data_pengunjung_' . $tgl . '.csv';
        $tempFile = Storage::disk('local')->path(Str::random(40) . '.csv');
        $handle = fopen($tempFile, 'w+');

        // Write CSV headers
        if ($pengunjung->isNotEmpty()) {
            fputcsv($handle, array_keys($pengunjung->first()->toArray()));
        }

        // Write CSV data
        $pengunjung->each(function($item) use ($handle) {
            $data = $item->toArray();
            // Format the 'tanggal' field
            $data['tanggal'] = Carbon::parse($data['tanggal'])->format('d-m-Y');
            fputcsv($handle, $data);
        });

        fclose($handle);

        return response()->streamDownload(function() use ($tempFile) {
            $handle = fopen($tempFile, 'rb');
            fpassthru($handle);
            fclose($handle);
            // Delete the file after streaming
            unlink($tempFile);
        }, $filename);
    }



}
