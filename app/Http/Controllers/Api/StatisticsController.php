<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\StatisticRepository;

class StatisticsController extends Controller
{
    protected $statistic;

    public function __construct(StatisticRepository $statistic)
    {
        $this->statistic = $statistic;
    }

    public function resourceTotal()
    {
        $total = $this->statistic->getResourceTotal();

        return response()->json(['total' => $total]);
    }
}
