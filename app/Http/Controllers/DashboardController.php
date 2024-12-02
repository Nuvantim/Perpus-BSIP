<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Pengunjung;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $pinjam = Pinjam::where('status',0)->count();
        $buku = Buku::count();
        $pengembalian = Pinjam::where('status',1)->count();
        $pengunjung = Pengunjung::count();

        return view('page.dashboard',compact('pinjam','buku','pengembalian','pengembalian','pengunjung'));
    }
}
