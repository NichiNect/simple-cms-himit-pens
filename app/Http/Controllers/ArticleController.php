<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Article;
use Auth;
use Str;

class ArticleController extends Controller
{
    /**
     * Constructor Method
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(6);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'content' => 'required'
        ]);

        if ($request->hasFile('thumbnail')) {
            $photo = $request->file('thumbnail');
            $image_extension = $photo->extension();
            $image_name = Str::slug($request->title) . time() . "." . $image_extension;
            $photo->storeAs('/images/articles', $image_name, 'public');
        }

        $article = new Article;
        $article->judul = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->gambar = $image_name;
        $article->user_id = Auth::user()->id;

        $article->save();

        session()->flash('success', 'Article posted!');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // $article = Article::where('slug', $slug)->get();
        $article = Article::findOrFail($article->id);
        $moreArticles = Article::latest()->limit(5)->get();
        return view('articles.show', compact('article', 'moreArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'content' => 'required'
        ]);

        if ($request->hasFile('thumbnail')) {
            // check had thumbnail yet or no
            if ($article->gambar) {
                \Storage::delete('public/images/articles/'.$article->gambar);
            }
            $photo = $request->file('thumbnail');
            $image_extension = $photo->extension();
            $image_name = Str::slug($request->title) . time() . "." . $image_extension;
            $photo->storeAs('/images/articles', $image_name, 'public');
            $thumb = $image_name;
        } else {
            $thumb = $article->gambar;
        }

        $article->update([
            'judul' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'gambar' => $thumb
        ]);

        session()->flash('success', "Data berhasil di update");
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if($article->gambar != null) {
            \Storage::delete($article->gambar);
        }

        Article::destroy('id', $article->id);

        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->route('articles.index');
    }
}
