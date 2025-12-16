<?php

namespace App\Http\Controllers;

use App\Imports\ImportUser;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    function index() {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }
    function import(Request $request){
        $request->validate([
            'excel_file' => 'required|mimes:csv,xlsx'
        ]);

        Excel::import(new ImportUser, $request->file('excel_file'));
        return back();
    }
}
