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

        $calligraphys->CombinationField();

        return response()->json(['calligraphys' => $calligraphys]);
    }

    public function rankingList()
    {
        $rankingList = $this->calligraphy->getRankingList();

        return response()->json(['rankingList' => $rankingList]);
    }

    public function search(Request $request)
    {
        $pageSize = request('pageSize') ? request('pageSize') : config('page.calligraphy');

        $calligraphys = $this->calligraphy->search($request->get('query'), $request->get('quickQuery'), $pageSize, true);

        $calligraphys->addCreatedTime();

        $calligraphys->CombinationField();

        return response()->json(['calligraphys' => $calligraphys]);
    }

    public function adminSearch(Request $request)
    {
        $this->authorize('viewAdmin', user('api'));

        $pageSize = request('pageSize') ? request('pageSize') : config('page.calligraphy');

        $calligraphys = $this->calligraphy->search($request->get('query'), $request->get('quickQuery'), $pageSize);

        $calligraphys->addCreatedTime();

        $calligraphys->CombinationField();

        return response()->json(['calligraphys' => $calligraphys]);
    }

    public function closeComment($id)
    {
        $this->authorize('closeComment', user('api'));

        $calligraphy = $this->calligraphy->byId($id);

        $state = $calligraphy->closeComment() ? 'F' : 'T';

        $calligraphy->close_comment = $state;

        $calligraphy->save();

        $action = $calligraphy->closeComment() ? '关闭了书法评论:'.$calligraphy->title : '取消关闭书法的评论:'.$calligraphy->title;

        $calligraphy->actionLog(user('api'), $action);

        return response()->json(['state' => $state]);
    }

    public function isHidden($id)
    {
        $this->authorize('isHidden', user('api'));

        $calligraphy = $this->calligraphy->byId($id);

        $state = $calligraphy->isHidden() ? 'F' : 'T';

        $calligraphy->is_hidden = $state;

        $calligraphy->save();

        $action = $calligraphy->isHidden() ? '屏蔽了书法:'.$calligraphy->title : '取消了屏蔽书法:'.$calligraphy->title;

        $calligraphy->actionLog(user('api'), $action);

        return response()->json(['state' => $state]);
    }

    public function getUserCalligraphys($id)
    {
        $calligraphys = $this->calligraphy->getCalligraphysByUser($id);

        $calligraphys->addCreatedTime();

        $calligraphys->CombinationField();

        return response()->json(['calligraphys' => $calligraphys]);
    }
}
