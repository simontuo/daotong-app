<?php
namespace App\Repositories;


use App\Models\Setting;

class SettingRepository
{

    public function createDefault()
    {
        $default = [
            'poster'     => 'https://file.iviewui.com/dist/76ecb6e76d2c438065f90cd7f8fa7371.png',
            'poster_bio' => 'A high quality UI Toolkit based on Vue.js'
        ];

        return Setting::create($default);
    }

    public function getSetting()
    {
        return Setting::count() < 1 ? $this->createDefault() : Setting::first();
    }

    public function getPoster()
    {
        return Setting::select(['poster', 'poster_bio'])->first();
    }
}
