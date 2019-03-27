<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;

class DashboardController extends Controller
{
    public function search(Request $request)
    {
        if($request->get('type') == 'story'){
            return StoryController::dashboardSearch($request->get('q'));
        }
        else
        {
            return ChapterController::dashboardSearch($request->get('q'));
        }
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function password()
    {
        return view('admin.user.password');
    }
}
