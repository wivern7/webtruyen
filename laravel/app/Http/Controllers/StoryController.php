<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoryRequest;
use App\Story;
use App\Chapter;
use App\Category;
use App\Author;
use Auth;

class StoryController extends Controller
{
    public function index(Request $r)
    {
        if(Auth::user()->isAdmin())
        {
            if($r->has('user_id'))
                $data = Story::where('user_id', $r->get('user_id'))->orderBy('updated_at', 'DESC')->paginate(20);
            else
                $data = Story::orderBy('updated_at', 'DESC')->paginate(20);
        }
        else
            $data = Auth::user()->stories()->orderBy('updated_at', 'DESC')->paginate(20);
        return view('admin.story.index', compact('data'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        $authors = Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.story.create', compact('categories', 'authors'));
    }

    public function store(StoryRequest $request)
    {
        $story = new Story;
        $story->name      = $request->txtName;
        $story->alias     = changeTitle($request->txtName);
        $story->content   = $request->txtContent;
        $story->source    = $request->txtSource;
        if($request->hasFile('fImages'))
        {
            $story->image = dqhUploadURI( $story->alias );
            $imageName = $story->alias . '.jpeg';
            $request->file('fImages')->move(dqhUploadPath(), $imageName);
            $fullPath    = public_path($story->image);
            DQHAddWatermark($fullPath);
            $pathResize1 = dqhUploadURI( $story->alias . '-thumb' );
            $pathResize2 = dqhUploadURI( $story->alias . '-thumbw' );
            DQHResizeImage($fullPath, $pathResize1, 180, 80, 1);
            DQHResizeImage($fullPath, $pathResize2, 60, 85);
        }
        $story->view      = 0;
        $story->keyword   = $request->txtKeyword;
        $story->description = $request->txtDescription;
        $story->status    = $request->selStatus;
        $story->user_id = Auth::user()->id;
        $story->save();
        $story->categories()->attach($request->intCategory);
        $story->authors()->attach($request->intAuthor);


        return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Thêm truyện mới thành công !', 'flash_level'=> 'success']);
    }

    public function destroy(\App\Story $story)
    {
        $user_id = $story->user_id;
        if(!Auth::user()->isAdmin() && $user_id != Auth::user()->id)
            return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);;

        if(!empty($story->image))
        {
            @unlink(public_path() . '/' . $story->image);
            @unlink(public_path() . '/' . dqhImageThumb($story->image));
            @unlink(public_path() . '/' . dqhImageThumb($story->image, true));
        }
        $story->delete();
        return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Xóa truyện thành công !', 'flash_level'=> 'success']);
    }

    public function edit(\App\Story $story)
    {
        if(!Auth::user()->isAdmin() && Auth::user()->id != $story->user_id)
            return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Bài viết này không phải của bạn !', 'flash_level'=> 'danger']);
        $categories = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        $authors = Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        $data   = $story;
        return view('admin.story.edit', compact('data', 'categories', 'authors'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function update(Request $request)
    {

        $this->validate($request,
            ['txtName' => 'required',
            'intCategory' => 'required',
            'intAuthor'   => 'required'],
            ['txtName.required'    => 'Bạn phải nhập tên truyện !',
            'intCategory.required'=> 'Bạn phải chọn chuyên mục !',
            'intAuthor.required'  => 'Bạn phải chọn tác giả !']
            );

        $story = Story::find($request->id);
        $story->name      = $request->txtName;
        $story->alias     = changeTitle($request->txtName);
        $story->content   = $request->txtContent;
        $story->source    = $request->txtSource;
        $story->categories()->sync($request->intCategory);
        $story->authors()->sync($request->intAuthor);
        $story->keyword   = $request->txtKeyword;
        $story->description = $request->txtDescription;
        $story->status    = $request->selStatus;
        if(($request->hasFile('fImages')))
        {
            @unlink(public_path() . '/' . $story->image);
            @unlink(public_path() . '/' . dqhImageThumb($story->image));
            @unlink(public_path() . '/' . dqhImageThumb($story->image, true));
            $story->image = dqhUploadURI( $story->alias );
            $imageName = $story->alias . '.jpeg';
            $request->file('fImages')->move(dqhUploadPath(), $imageName);
            $fullPath    = public_path($story->image);
            DQHAddWatermark($fullPath);
            $pathResize1 = dqhUploadURI( $story->alias . '-thumb' );
            $pathResize2 = dqhUploadURI( $story->alias . '-thumbw' );
            DQHResizeImage($fullPath, $pathResize1, 180, 80, true);
            DQHResizeImage($fullPath, $pathResize2, 60, 85);
        }
        $story->save();
        return redirect()->route('dashboard.story.index')->with(['flash_message'=> 'Truyện này đã lưu thành công !', 'flash_level'=> 'success']);
    }

    public static function dashboardSearch( $keyword)
    {
        $data = Story::select('*')->where('name', 'like', '%'. $keyword .'%')->orderBy('updated_at', 'DESSC')->paginate(20);
        return view('admin.story.index', compact('data'));
    }

    /**
     * Index List
     */
    // Truyện mới
    public function getListNewStory(Request $r)
    {
        $stories = ($r->get('filter') == 'full') ? Story::where('status', 1)->orderBy('updated_at', 'DESC')->paginate(25) : Story::orderBy('updated_at', 'DESC')->paginate(25);
        if(!$stories) abort(404);
        $data     = [
            'title'  => 'Truyện mới cập nhật',
            'description' => 'Truyện mới cập nhật',
            'keyword' => '',
            'alias'  => route('danhsach.truyenmoi'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenmoi'), 'Truyện mới cập nhật']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện Hot
    public function getListHotStory(Request $r  )
    {
        $stories = ($r->get('filter') == 'full') ? Story::where('status', 1)->orderBy('view', 'DESC')->paginate(25) : Story::orderBy('view', 'DESC')->paginate(25);
        if(!$stories) abort(404);
        $data     = [
            'title'  => 'Truyện Hot',
            'description' => 'Truyện Hot',
            'keyword' => '',
            'alias'  => route('danhsach.truyenhot'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenhot'), 'Truyện Hot']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện full
    public function getListFullStory()
    {
        $stories = Story::where('status', 1)->orderBy('updated_at', 'DESC')->paginate(25);
        if(!$stories) abort(404);
         $data     = [
            'title'  => 'Danh sách truyện full',
             'description' => 'Truyện full',
             'keyword' => '',
            'alias'  => route('danhsach.truyenfull'),
            'stories' => $stories,
        ];
        $breadcrumb = [[route('danhsach.truyenfull'), 'Danh sách truyện full']];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện theo the loại
    public function getListByCategory($alias, Request $r)
    {

        $category = Category::where('alias', $alias)->first();
        if(!$category) abort(404);
        $story    = ($r->get('filter') == 'full') ? $category->stories()->where('status', 1)->orderBy('updated_at', 'DESC')->paginate(25) : $category->stories()->orderBy('updated_at', 'DESC')->paginate(25);
        $data     = [
            'title'  => $category->name,
            'alias'  => $category->alias,
            'keyword'=> $category->keyword,
            'description' => $category->description,
            'stories' => $story,
        ];

        $breadcrumb = [[route('category.list.index', $category->alias), $category->name]];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Truyện theo tac gia
    public function getListByAuthor($alias, Request $r)
    {
        $author = Author::where('alias', $alias)->first();
        if(!$author) abort(404);
        $story    = ($r->get('filter') == 'full') ? $author->stories()->where('status', 1)->paginate(25) : $author->stories()->paginate(25);
        $data     = [
            'title'  => $author->name,
            'alias'  => $author->alias,
            'keyword'=> $author->keyword,
            'description' => $author->description,
            'stories' => $story,
        ];
        $breadcrumb = [[route('author.list.index', $author->alias), $author->name]];
        return view('list_story', compact('data', 'breadcrumb'));
    }
    // tìm kiếm
    public function getListBySearch(Request $r)
    {
        $q = '%' . $r->get('q') . '%';

        $story    = Story::where('name', 'like', $q)->orderBy('updated_at', 'DESC')->paginate(25);
        $data     = [
            'title'  => 'Tìm kiếm: '. $r->get('q') . ' ('. $story->count() .')',
            'alias'  => null,
            'keyword'=> '',
            'description' => '',
            'stories' => $story,
        ];

        $breadcrumb = [[route('danhsach.search'), 'Tìm kiếm: '. $r->get('q')]];
        return view('list_story', compact('data', 'breadcrumb'));
    }

    // Hiển thị truyện
    public function showInfoStory($alias, Request $r)
    {
        $story = Story::where('alias', $alias)->first();
        if(!$story) abort(404);
        $breadcrumb = [[route('story.show', $story->alias), $story->name]];
        if(!$r->session()->has('viewStory' . $story->id)) {
            $story->view = $story->view + 1;
            $story->timestamps = false;
            $story->save();
            $r->session()->put('viewStory' . $story->id, true);
        }
        return view('show_story', compact('story','breadcrumb'));
    }

    // Hiển thị chương truyện
    public function showInfoChapter($alias, $aliasChapter, Request $r)
    {
        $story = Story::where('alias', $alias)->first();
        if(!$story) abort(404);
        $chapter = $story->chapters()->where('alias', $aliasChapter)->first();
        $totalChapters = $story->chapters()->count();
        $currentChapter = (int) str_replace('chuong-', '', $aliasChapter);
        if(!$chapter) abort(404);

        $viewed = new \App\Viewed();
        $viewed->addToListReading($story->id, $chapter->id);

        if(!$r->session()->has('viewChapter' . $chapter->id))
        {
            $story->view = $story->view+1;
            $story->timestamps = false;
            $story->save();
            $chapter->view = $chapter->view+1;
            $chapter->timestamps = false;
            $chapter->save();
            $r->session()->put('viewChapter' . $chapter->id, true);
        }

        $chapterNav = [
            'nextChapter' => ($currentChapter != $totalChapters) ? $story
                ->chapters()
                ->select('subname','alias')
                ->where('alias', 'chuong-' . ($currentChapter + 1))
                ->first() : false,
            'previousChapter' => ($currentChapter > 1) ? $story
                ->chapters()
                ->select('subname','alias')
                ->where('alias', 'chuong-' . ($currentChapter - 1))
                ->first() : false,
        ];
        $breadcrumb = [[route('story.show', $story->alias), $story->name], [route('chapter.show', [$story->alias, $chapter->alias]), $chapter->subname]];
        return view('show_chapter', compact('story', 'chapter', 'chapterNav', 'breadcrumb'));
    }

    // AJAX
    public function getAjaxListNewStories(Request $r)
    {
        $categoryID = $r->get('categoryID');
        return Story::getListNewStories($categoryID);
    }
    public function getAjaxListHotStories(Request $r)
    {
        $categoryID = $r->get('categoryID');
        return Story::getListHotStories($categoryID);
    }

}
