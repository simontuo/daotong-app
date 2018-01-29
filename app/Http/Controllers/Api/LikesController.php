<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LikeRepository;

class LikesController extends Controller
{
    protected $like;

    protected $allowLike = [
        'Article', 'Calligraphy', 'Answer'
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

        $like = $type->likes()->where('user_id', user('api')->id)->first();

        if (count($like) < 1) {
            $data = [
                'user_id'       => user('api')->id,
                'type'          => 0,
                'likeable_id'   => $type->id,
                'likeable_type' => 'APP\Models\\'.$request->get('type'),
            ];

            $like = $this->like->create($data);

            user('api')->actionLog(user('api'), user('api')->name.'点赞了'.$like->likeable_type.'：'.$like->likeable->title);

            return response()->json(['status' => true, 'user' => user('api')]);
        }

        if ($like->type == 1) {

            $like->type = 0;
            $like->save();

            user('api')->actionLog(user('api'), user('api')->name.'点赞了'.$like->likeable_type.'：'.$like->likeable->title);

            return response()->json(['status' => true, 'user' => user('api')]);
        }

        return response()->json(['status' => false, 'message' => "已经点过攒了！"]);
    }

    public function dislikeStore(Request $request)
    {
        $type = $this->like->getTypeById($request->get('type'), $request->get('id'));

        if (!$type) {
            return response()->json(['status' => false]);
        }

        $like = $type->likes()->where('user_id', user('api')->id)->first();

        if (count($like) < 1) {
            $data = [
                'user_id'       => user('api')->id,
                'type'          => 1,
                'likeable_id'   => $type->id,
                'likeable_type' => 'APP\Models\\'.$request->get('type'),
            ];

            $like = $this->like->create($data);

            user('api')->actionLog(user('api'), user('api')->name.'不赞同了'.$like->likeable_type.'：'.$like->likeable->title);

            return response()->json(['status' => true, 'user' => user('api')]);
        }

        if ($like->type == 0) {

            $like->type = 1;
            $like->save();

            user('api')->actionLog(user('api'), user('api')->name.'不赞同了'.$like->likeable_type.'：'.$like->likeable->title);

            return response()->json(['status' => true, 'user' => user('api')]);
        }

        return response()->json(['status' => false, 'message' => "已经不赞同了！"]);
    }
}
