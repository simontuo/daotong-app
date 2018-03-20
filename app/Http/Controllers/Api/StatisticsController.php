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

    public function numberFormat(int $total)
    {
        return number_format($total);
    }

    public function resourceTotal()
    {
        $total = $this->numberFormat($this->statistic->getResourceTotal());

        return response()->json(['total' => $total]);
    }

    public function userTotal()
    {
        $total = $this->numberFormat($this->statistic->getUserTotal());

        return response()->json(['total' => $total]);
    }

    public function visitTotal()
    {
        $total = $this->numberFormat($this->statistic->getVisitTotal());

        return response()->json(['total' => $total]);
    }

    public function resourceDetail()
    {
        $detail = $this->statistic->getResourceDetail();

        return response()->json(['detail' => $detail]);
    }

    public function userDetail()
    {
        $detail = $this->statistic->getUserDetail();

        return response()->json(['detail' => $detail]);
    }

    public function visitDetail()
    {
        $detail = $this->statistic->getVisitDetail();

        return response()->json(['detail' => $detail]);
    }


}
