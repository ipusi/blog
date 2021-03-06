<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //简讯
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(6);
        
        return view('news/news', ['newses' => $news]);
    }

    //新闻详情
    
    public function show($articleid)
    {
        News::where('articleid', '=', $articleid)->increment('visits');
        $news = News::where('articleid', '=', $articleid)->first();
        // $relatednews = News::where('articleid','=',$articleid)->relatednews();
        $relatednews = $news->relatednews;
        $newstimelines = $news->newstimelines;
        // return $news;
        return view('news/newsdetail', ['news' => $news]);
    }
}
