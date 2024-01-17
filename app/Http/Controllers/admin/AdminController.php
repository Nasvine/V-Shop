<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Admin/Dashboard');
    }
}
