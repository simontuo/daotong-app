<?php
namespace App\Repositories;

use App\Models\Motto;

class MottoRepository
{
    public function index()
    {
        return Motto::get();
    }

    public function randomOne()
    {
        return Motto::inRandomOrder()->first();
    }
}
