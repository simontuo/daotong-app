<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LikeRepository;

class LikesController extends Controller
{
    protected $like;

    protected $allowLike = [
        'Article', 'Calligraphy'
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
        if (in_array($type, $this->allowLike)) {
            $likes = $this->like->getTypeLikeById($type, $id);

            return response()->json(['status' => true, 'likes' => $likes]);
        }

        return response()->json(['status' => false]);
    }


    public function store(Request $request)
    {
        $type = $this->like->getTypeById($request->get('type'), $request->get('id'));

        if (!$type) {
            return response()->json(['status' => false]);
        }

        if ($type->likes()->where('user_id', user('api')->id)->count() < 1) {
            $data = [
                'user_id'       => user('api')->id,
                'likeable_id'   => $type->id,
                'likeable_type' => 'APP\Models\\'.$request->get('type'),
            ];

            $like = $this->like->create($data);

            user('api')->actionLog(user('api'), user('api')->name.'点赞了'.$like->likeable_type.'：'.$like->likeable->title);

            return response()->json(['status' => true, 'user' => user('api')]);
        }

        return response()->json(['status' => false, 'message' => "已经点过攒了！"]);
    }
}
