<?php
namespace App\Repositories;

use App\Models\Motto;

class MottoRepository
{
    protected $modelColumn = [
        'mottoes.id', 'mottoes.user_id', 'mottoes.bio', 'mottoes.created_at'
    ];

    public function index()
    {
        return Motto::get();
    }

    public function randomOne()
    {
        return Motto::inRandomOrder()->first();
    }

    public function search($query, $quickQuery = null, $pageSize, $prefixQueryState = false)
    {
        return Motto::join('users', function ($join){
                $join->on('users.id', '=', 'mottoes.user_id');
            })
            ->select($this->modelColumn)
            ->where('users.name', 'like', '%'.$query.'%')
            ->orWhere('mottoes.bio', 'like', '%'.$query.'%')
            ->with(['user'])
            ->orderBy('created_at', 'DESC')
            ->paginate($pageSize);
    }
}
