<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MottoRepository;

class MottoesController extends Controller
{
    public function __construct(MottoRepository $motto)
    {
        $this->motto = $motto;
    }

    public function index()
    {
        $mottoes = $this->motto->index();

        return response()->json(['mottoes' => $mottoes]);
    }

    public function randomOne()
    {
        $motto = $this->motto->randomOne();

        return response()->json(['motto' => $motto]);
    }

    public function adminSearch(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        $pageSize = request('pageSize') ? request('pageSize') : config('page.mottoe');

        $mottoes = $this->motto->search($request->get('query'), $request->get('quickQuery'), $pageSize);

        $mottoes->addCreatedTime();

        $mottoes->CombinationField();

        return response()->json(['mottoes' => $mottoes]);
    }
}
