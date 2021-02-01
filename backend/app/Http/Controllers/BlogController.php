<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * ブログ一覧を表示する
     * 
     * @return view
     */
    public function showList()
    {
        $blogs = Blog::all();

        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blog = Blog::find($id);

        // idに該当するブログがない場合の処理
        if (is_null($blog)) {
            // エラーメッセージ
            \Session::flash('err_msg','データがありません。');
            // ブログ一覧画面にリダイレクト
            return redirect(route('blogs'));
        }

        return view('blog.detail', ['blog' => $blog]);
    }
}
