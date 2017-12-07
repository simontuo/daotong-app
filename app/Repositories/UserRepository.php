<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $quickQueryType = [

    ];

    public function byId($id)
    {
        return User::findOrFail($id);
    }

    public function byConfirmationToken($confirmationToken)
    {
        return User::where('confirmation_token', $confirmationToken)->first();
    }

    public function index($pageSize)
    {
        return User::paginate($pageSize);
    }

    public function search($query, $quickQuery = null, $pageSize)
    {
        $quickQueryType = is_null($quickQuery) ? 'created_at' : array_get($this->quickQueryType, $quickQuery, 'created_at');

        return User::where('name', 'like', '%'.$query.'%')
            ->orWhere('phone', 'like', '%'.$query.'%')
            ->orderBy($quickQueryType, 'DESC')
            ->paginate($pageSize);
    }
}
