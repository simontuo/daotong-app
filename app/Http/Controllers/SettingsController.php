<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;

class SettingsController extends Controller
{
    protected $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function uploadPoster(Request $request)
    {
        $poster = $this->setting->getSetting();

        $poster->poster     = $request->poster;
        
        $poster->poster_bio = $request->poster_bio;

        $poster->save();

        alert()->success('更新海报成功')->autoclose(2000);

        return redirect()->route('admin.settings.index');
    }

    public function poster()
    {
        return $this->setting->getPoster();
    }
}
