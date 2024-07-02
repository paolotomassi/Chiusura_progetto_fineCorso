<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        // $articles = Article::all()->sortDesc();
        // return view('welcome' , compact('articles'));
        
        
    }
    
    public function allArticle()
    {
        $articles = Article::all()->sortDesc();
        return view('allArticle' , compact('articles'));
        
        
    }
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        $categories = Category::all();
        return view('article/create' , compact('categories'));
        
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        Article::create(
            [
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'body' => $request->input('body'),
                'price' => $request->input('price'),
                'category_id'=>$request->input('category_id'),
                'img' => $request->has('img') ? $request->file('img')->store('public') : '/img/default.jpeg',
                'user_id'=>Auth::id()
                ]
            );
            return redirect(route('home'))->with('message', 'Articolo inserito correttamente');
        }
        
        /**
        * Display the specified resource.
        */
        public function show(Article $article)
        {
            return view('article.show',compact('article'));
        }
        
        /**
        * Show the form for editing the specified resource.
        */
        public function edit(Article $article)
        {
            //
        }
        
        /**
        * Update the specified resource in storage.
        */
        public function update(Request $request, Article $article)
        {
            //
        }
        
        /**
        * Remove the specified resource from storage.
        */
        public function destroy(Article $article)
        {
            $article->delete();
            return redirect(route('home'))->with('message', 'Articolo cancellato correttamente');
        }
        
        public function articleByCat(Category $category){
            return view('article.category', compact('category'));
        }
        
    }
    