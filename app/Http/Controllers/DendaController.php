<?php

namespace App\Http\Controllers;

use App\Models\NominalDenda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $denda = NominalDenda::get();
        return view('page.denda.denda',compact('denda'));
    }

    public function update(Request $request,$id)
    {
        $denda = NominalDenda::find($id);
        $denda->nominal = $request->denda;
        $denda->save();
        return redirect()->route('denda.index')->with('alert',[
            'type' => 'success',
            'message' => 'Denda Diperbarui !'
          ]);;
    }
}
