<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class InboxsController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * [index inbox首页]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function index($id)
    {
        $user = $this->user->byId($id);

        return view('inboxs.index', compact('user'));
    }

    public function show($id, $dialog)
    {
        $user = $this->user->byId($id);

        $user->dialog = $dialog;
        
        return view('inboxs.show', compact('user'));
    }
}
