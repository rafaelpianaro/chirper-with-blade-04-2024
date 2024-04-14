<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        // $users = User::where('is_admin', 0)->get();
        // dd($users);
        return view('users.index', [
            'users' => User::where('is_admin', 0)->get()
        ]);
    }
}
