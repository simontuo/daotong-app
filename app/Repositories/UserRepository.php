<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * [byId 根据id获取用户]
     * @method byId
     * @param  [type]   $id [description]
     * @return [type]       [description]
     * @auth   simontuo
     */
    public function byId($id)
    {
        return User::find($id);
    }

    /**
     * [byConfirmationToken 根据confirmation_token查找用户]
     * @method byConfirmationToken
     * @param  [type]              $confirmationToken [description]
     * @return [type]                                 [description]
     * @auth   simontuo
     */
    public function byConfirmationToken($confirmationToken)
    {
        return User::where('confirmation_token', $confirmationToken)->first();
    }
}
