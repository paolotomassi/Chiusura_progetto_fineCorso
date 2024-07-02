<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Mail\BecomeRevisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function home(){
        $articles = Article::where('is_accepted', true)->latest()->take(4)->get();
        return view('welcome' , compact('articles'));        
    }

    public function searchArticles(Request $request){
        $articles = Article::search($request->search)->where('is_accepted',true)->paginate(10);
    return view('welcome' , compact('articles'));

    }

    public function showForm(){
        return view('form');
    }

    public function salvaBody(Request $request){
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user(), $request->body));
        return redirect()->back()->with('message', 'Complimenti! Hai richiesto di diventare revisore correttamente.');
    }

    public function setLanguage($lang){
    
        session()->put('locale', $lang);
        return redirect()->back();
        
    }
}
