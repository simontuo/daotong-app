<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CalligraphyRepository;

class CalligraphysController extends Controller
{
    protected $calligraphy;

    public function __construct(CalligraphyRepository $calligraphy)
    {
        $this->calligraphy = $calligraphy;
    }

    public function index()
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.calligraphy');

        $calligraphys = $this->calligraphy->index($pageSize);

        return response()->json(['calligraphys' => $calligraphys]);
    }

    public function rankingList()
    {
        $rankingList = $this->calligraphy->getRankingList();

        return response()->json(['rankingList' => $rankingList]);
    }

    public function search(Request $request)
    {
        $calligraphys = $this->calligraphy->search($request->get('query'), $request->get('quickQuery'));

        $calligraphys->addCreatedTime();

        return response()->json(['calligraphys' => $calligraphys]);
    }
}
