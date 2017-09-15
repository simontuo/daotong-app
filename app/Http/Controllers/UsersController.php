<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Storage;
use App\Http\Requests\ChangePasswordRequest;
use Hash;

class UsersController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->byId($id);

        if (user()->isMyself($user)) {
            return view('users.edit', compact('user'));
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->byId($id);

        if (user()->isMyself($user)) {
            $user->update($user->merge($request->all()));

            alert()->success('编辑用户信息成功')->autoclose(2000);

            return back();
        }

        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * [updateAvatar 头像上传（七牛）]
     * @method updateAvatar
     * @param  Request      $request [description]
     * @param  [type]       $id      [description]
     * @return [type]                [description]
     * @auth   simontuo
     */
    public function updateAvatar(Request $request, $id)
    {
        $user = $this->user->byId($id);

        if (user()->isMyself($user) && $request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = '/avatars/'.md5(time().$user->name).'.'.$file->getClientOriginalExtension();

            Storage::disk('qiniu')->writeStream($fileName, fopen($file->getRealPath(), 'r'));

            $user->avatar = 'http://'.config('filesystems.disks.qiniu.domain').'/'.$fileName;
            $user->save();

            return response()->json(['url' => $user->avatar]);
        }

        abort(404);
    }

    /**
     * [editPassword 修改面密码页]
     * @method editPassword
     * @param  [type]       $id [description]
     * @return [type]           [description]
     * @auth   simontuo
     */
    public function editPassword($id)
    {
        $user = $this->user->byId($id);

        if (user()->isMyself($user)) {
            return view('users.password');
        }

        abort(404);
    }

    /**
     * [updatePassword 更新密码]
     * @method updatePassword
     * @param  ChangePasswordRequest $request [description]
     * @param  [type]                $id      [description]
     * @return [type]                         [description]
     * @auth   simontuo
     */
    public function updatePassword(ChangePasswordRequest $request, $id)
    {
        $user = $this->user->byId($id);

        if (user()->isMyself($user) && Hash::check($request->get('old_password'), $user->password)) {
            $user->password = bcrypt($request->get('password'));
            $user->save();

            alert()->success('修改密码成功！')->persistent('ok');

            return back();
        }

        alert()->error('修改密码失败！')->persistent('ok');

        return back();
    }
}
