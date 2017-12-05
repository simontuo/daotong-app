<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesController extends Controller
{
    public function index()
    {
        return view('admins.homes.index');
    }

    public function articleIndex()
    {
        return view('admins.articles.index');
    }

    public function calligraphyIndex()
    {
        return view('admins.calligraphys.index');
    }

    public function commentIndex()
    {
        return view('admins.comments.index');
    }
}
