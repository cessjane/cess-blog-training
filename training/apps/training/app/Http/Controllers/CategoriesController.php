<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\CategoryCollection;
use Illuminate\Support\Facades\URL;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = new CategoryCollection(Category::paginate(10));

        return Inertia::render('Category/Index', [
            'categories' => $categories,
            'create_url' => URL::route('categories.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Category/CategoriesCreate',
            ['auth_user' => Auth::user()],
        );
    }

    /**
     * Store a newly created resource or existing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::updateOrCreate(
            ['id' => $request->id],
            $request->validate([
                'name' => ['required', 'max:50', 'unique:categories,name'],
                'updated_user_id' => ['required'],
            ])
        );

        // Show flash message 
        self::success('Successfully created a category.');
        return Redirect::route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Category/CategoriesEdit', [
            'category' => Category::find($id),
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
        Category::destroy($id);

        // Show flash message 
        self::success('Successfully created a category.');
        return Redirect::route('categories.index');
    }
}
