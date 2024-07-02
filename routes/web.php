<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PublicController::class,'home'])->name('home');

Route::get('/article/create' , [ArticleController::class , 'create'])->name('article.create');

Route::post('/article/store' , [ArticleController::class, 'store'])->name('article.store');

Route::get('/article/all' , [ArticleController::class , 'allArticle'])->name('article.all');

Route::get('/article/detail/{article}',[ArticleController::class,'show'])->name('article.show');

Route::delete('/article/delete/{article}', [ArticleController::class, 'destroy'])->name('article.delete');

Route::get('/article/category/{category}', [ArticleController::class, 'articleByCat'])->name('article.category');

Route::get('/revisor/home', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');

Route::get('/ricerca/annuncio',[PublicController::class,'searchArticles'])->name('articles.search');

Route::patch('/accetta/annuncio/{article}', [RevisorController::class, 'acceptArticle'])->name('revisor.accept_article');

Route::patch('/rifiuta/annuncio/{article}', [RevisorController::class, 'rejectArticle'])->name('revisor.reject_article');

// Route::get('/richiesta/revisore', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

Route::get('/show/form', [PublicController::class, 'showForm'])->middleware('auth')->name('show.form');

Route::post('/salva/body', [PublicController::class, 'salvaBody'])->name('salva.body');

Route::get('/rendi/revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

Route::patch('/rifiuta/annuncio/{article}', [RevisorController::class, 'rejectArticle'])->name('revisor.reject_article');

Route::get('/ricerca/articolo',[PublicController::class,'searchArticles'])->name('articles.search');

Route::get('/lavoraConNoi',[RevisorController::class,'form'])->name('work');

Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('set_language_locale');


