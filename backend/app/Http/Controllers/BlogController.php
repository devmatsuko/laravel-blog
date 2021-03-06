<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

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
            \Session::flash('err_msg', 'データがありません。');
            // ブログ一覧画面にリダイレクト
            return redirect(route('blogs'));
        }

        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * ブログ登録画面を表示する
     * 
     * @return view
     */
    public function showCreate()
    {
        // 登録画面を返す
        return view('blog.form');
    }

    /**
     * ブログの登録を行う
     * 
     * @return view
     */
    public function exeStore(BlogRequest $request)
    {
        // ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // ブログを登録
            Blog::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            // 500エラーのページを表示する
            abort(500);
        }

        // サクセスメッセージ
        \Session::flash('err_msg', 'ブログを登録しました。');
        // ブログ一覧画面にリダイレクト
        return redirect(route('blogs'));
    }

    /**
     * ブログ編集画面を表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $blog = Blog::find($id);

        // idに該当するブログがない場合の処理
        if (is_null($blog)) {
            // エラーメッセージ
            \Session::flash('err_msg', 'データがありません。');
            // ブログ一覧画面にリダイレクト
            return redirect(route('blogs'));
        }

        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログの更新を行う
     * 
     * @return view
     */
    public function exeUpdate(BlogRequest $request)
    {
        // ブログのデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            // ブログを登録
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content']
            ]);
            $blog->save();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            // 500エラーのページを表示する
            abort(500);
        }

        // サクセスメッセージ
        \Session::flash('err_msg', 'ブログを登録しました。');
        // ブログ一覧画面にリダイレクト
        return redirect(route('blogs'));
    }

    /**
     * ブログの削除を行う
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません');
            return redirect(route('blogs'));
        }

        try {
            // ブログを削除
            Blog::destroy($id);
        } catch (\Throwable $e) {
            // 500エラーのページを表示する
            abort(500);
        }

        // サクセスメッセージ
        \Session::flash('err_msg', '削除しました。');
        return redirect(route('blogs'));
    }
}
