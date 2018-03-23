<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.homes.index');
    }

    public function userIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.users.index');
    }

    public function articleIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.articles.index');
    }

    public function calligraphyIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.calligraphies.index');
    }

    public function questionIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.questions.index');
    }

    public function commentIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.comments.index');
    }

    public function messageIndex()
    {
        $this->authorize('viewAdmin', user());

        return view('admins.messages.index');
    }

    public function logIndex()
    {
        $this->authorize('viewAdminLog', user());

        return view('admins.logs.index');
    }

    public function answerIndex()
    {
        $this->authorize('viewAdminLog', user());

        return view('admins.answers.index');
    }

    public function mottoIndex()
    {
        $this->authorize('viewAdminLog', user());

        return view('admins.mottoes.index');
    }

    public function suggestionIndex()
    {
        $this->authorize('viewAdminLog', user());

        return view('admins.suggestions.index');
    }

    public function settingIndex()
    {
        $this->authorize('viewAdminLog', user());

        return view('admins.homes.setting');
    }
}
