<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LikeRepository;

class LikeController extends Controller
{
    protected $like;

    protected $allowType = [
        'Article',
    ];

    public function __construct(LikeRepository $like)
    {
        $this->like = $like;
    }

    /**
     * [index description]
     * @param  [type] $type [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function index($type, $id)
    {
        $likes = $this->like->getTypeLikeByid($type, $id);

        return response()->json(['likes' => $likes]);
    }
}
