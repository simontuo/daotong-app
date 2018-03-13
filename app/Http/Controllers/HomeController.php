<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Repositories\ApiRepository;

class HomeController extends Controller
{
    protected $home;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeRepository $home)
    {
        $this->home = $home;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $page = $request->get('page', 1);

        $pageSize = $request->get('pageSize', config('page.union'));

        $items = $this->home->search($request->get('query'), $request->get('quickQuery'), $pageSize, $page, true);

        return response()->json(['items' => $items]);
    }
}
