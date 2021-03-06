<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class IndexController extends Controller
{
    // 为前端提供最新的日志，返回 JSON
    // 提供翻页功能
    public function ajaxnewblogs() {

        $blogs = Blog::newBlogs();

        // Larevel会自动转成JSON
  
        return [
            'code'=>0,
            'data' => $blogs,
        ];

     

    }

    // 首页
    public function index() {

        // 活跃用户
        $acUsers = User::acUsers();

        // 获取日志排行榜
        $top10 = Blog::top10();

        return view('index.index', [
            'acUsers' => $acUsers,
            'top10' => $top10,
        ]);
    }

    // 日志详情
    public function blog($id) {

        // 先根据ID取出日志的信息
        $blog = Blog::viewAndAddDisplay($id);

        // 取出日志排行榜
        $top10 = Blog::top10();

        return view('index.blog', [
            'blog' => $blog,
            'top10' => $top10,
        ]);
    }
}
