<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setMetaTitle('Blog');

        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setMetaTitle('Write Article');

        return view('articles.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', '=', $slug)->firstOrFail();
        $this->setMetaTitle($article->title);
        
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $this->setMetaTitle('Edit Article');

        $article = Article::where('slug', '=', $slug)->firstOrFail();

        return view('articles.edit', compact('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return Article
     */
    public function draft(Request $request)
    {
        return $this->saveThisArticleRequest($request);
    }

    /**
     * @param Request $request
     * @return Article
     */
    public function publish(Request $request)
    {
        return $this->saveThisArticleRequest($request);
    }

    /**
     * @param Request $request
     * @return Article
     */
    private function saveThisArticleRequest(Request $request)
    {
        $article = new Article;
        $path = storage_path('articles');
        $file = '';

        if ($request->id) {
            $article = Article::findOrFail((int)$request->id);
            $file = $article->file;
        }

        if (!$file) {
            $file = str_random(12) . '.md';
            while (app('files')->exists("{$path}/{$file}")) {
                $file = str_random(12) . '.md';
            }
        }

        app('files')->put("{$path}/{$file}", $request->article);

        $article->title = $request->title;
        $article->slug = $request->title;
        $article->excerpt = str_words($request->article, 20);
        $article->published = $request->published;
        $article->path = $path;
        $article->file = $file;
        $article->author_id = app('auth')->user()->id;
        $article->save();

        return $article;
    }
}
