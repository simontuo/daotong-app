<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CalligraphyRepository;
use App\Http\Requests\StoreCalligraphyRequest;

class CalligraphysController extends Controller
{
    protected $calligraphy;

    public function __construct(CalligraphyRepository $calligraphy)
    {
        $this->calligraphy = $calligraphy;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calligraphys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calligraphys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalligraphyRequest $request)
    {
        $data = [
            'user_id' => user()->id,
            'title' => $request->get('title'),
            'images' => $request->get('images'),
            'bio' => $request->get('bio'),
        ];

        $calligraphy = $this->calligraphy->create($data);

        alert()->success('新增文章 '.$calligraphy->title.' 成功！')->autoclose(2000);

        return redirect()->route('calligraphys.show', ['calligraphy' => $calligraphy->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calligraphy = $this->calligraphy->byId($id);

        $calligraphy->increment('reads_count');

        return view('calligraphys.show', compact('calligraphy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * [calligraphyList 获取书法列表]
     * @return [type] [description]
     */
    public function calligraphyList()
    {
        $calligraphys = $this->calligraphy->index();

        return response()->json(['calligraphys' => $calligraphys]);
    }

    /**
     * [rankingList 获取书法排行列]
     * @return [type] [description]
     */
    public function rankingList()
    {
        $rankingList = $this->calligraphy->getRankingList();

        return response()->json(['rankingList' => $rankingList]);
    }
}
