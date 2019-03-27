<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ChapterRequest;
use App\Http\Controllers\Controller;
use App\Chapter;
use App\Story;
use Illuminate\Support\Facades\View;
use Auth;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::orderBy('updated_at', 'DESC')->paginate(20);
        return view('admin.chapter.list', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $chapter  = new Chapter();
        $story_id = $request->get('parentID');
        $chapterSubname = $chapter->theNextSubname($story_id );

        return view('admin.chapter.create', compact('chapterSubname', 'story_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterRequest $request)
    {
        $chapter = new Chapter;
        $chapter->name      = $request->txtName;
        $chapter->subname   = $request->txtSubname;
        $chapter->alias     = changeTitle($request->txtSubname);
        $chapter->content   = $request->txtContent;
        $chapter->story_id  = $request->story_id;
        $chapter->view      = 0;
        $chapter->save();

        return redirect()->route('dashboard.chapter.list', $chapter->story_id)->with(['flash_message'=> 'Thêm chương mới thành công !', 'flash_level'=> 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        $user_id = $chapter->story->user_id;
        if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
            return redirect()->route('dashboard.chapter.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);

        return view('admin.chapter.edit', compact('chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $chapter = Chapter::find($request->id);
        $chapter->name      = $request->txtName;
        $chapter->subname   = $request->txtSubname;
        $chapter->alias     = changeTitle($request->txtSubname);
        $chapter->content   = $request->txtContent;
        $chapter->save();

        return redirect()->route('dashboard.chapter.list', $chapter->story_id)->with(['flash_message'=> 'Sửa chương thành công !', 'flash_level'=> 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        $user_id = $chapter->story->user_id;
        if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
            return redirect()->route('dashboard.chapter.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);
        $story_id = $chapter->story_id;
        $chapter->delete();
        return redirect()->route('dashboard.chapter.list', $story_id)->with(['flash_message'=> 'Xóa chương thành công !', 'flash_level'=> 'success']);
    }

    /**
     * Show list chapter in story
     * @param Story $chapter
     * @return Chapter
     */

    public function listChapter(Story $id)
    {
        $chapters = $id->chapters()->paginate(20);
        $story    = $id;
        //return
        return view('admin.chapter.list', compact('story', 'chapters'));
    }

    /**
     * Show result chapter
     * @param $keyword
     * @return View
     */
    public static function dashboardSearch( $keyword)
    {
        $chapters = Chapter::where('name', 'like', '%'. $keyword .'%')->orderBy('updated_at', 'DESSC')->paginate(20);
        return view('admin.chapter.list', compact('chapters'));
    }
}
