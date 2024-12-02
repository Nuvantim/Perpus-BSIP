<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $usr = User::get();
        return view('page.user.user',compact('usr'));
    }

    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->nama;
        $user->email = $request->email;
        if($request->password != null)
        {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user.index');
    }
}
