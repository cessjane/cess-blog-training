<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\ArticleCollection;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = new ArticleCollection(Article::paginate(10));

        return Inertia::render('Article/Index', [
            'articles' => $articles,
            'create_url' => URL::route('articles.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Article/ArticlesCreate', [
                'auth_user' => Auth::user(),
                'categories' => Category::all(),
            ],
        );
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
            'article_category_id' => ['required'],
            'title' => ['required', 'max:100'],
            'slug' => ['required', 'max:50'],
            'image_path' => [],
            'contents' => ['required'],
            'updated_user_id' => ['required'],
        ]);

        $article = Article::updateOrCreate(['id' => $request->id], [
                'article_category_id' => $request->article_category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'contents' => $request->contents,
                'updated_user_id' => $request->updated_user_id,
            ]
        );

        // Upload file
        if ($request->hasFile('image_path')) {
            $photo = $request->file('image_path')->store('images');
            $article->image_path = $photo;
            $article->save();
        }
        
        // Show flash message 
        self::success('Successfully created an article.');
        return Redirect::route('articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Article/ArticlesEdit', [
            'article' => Article::find($id),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::destroy($id);

        // Show flash message 
        self::success('Successfully deleted an article.');
        return Redirect::route('articles.index');
    }
}
