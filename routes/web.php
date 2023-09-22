<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[ArticleController::class, 'homepage'])->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard',[ArticleController::class, 'indexAccueil'])->name('dashboard');
    
    Route::get('liste_article',[ArticleController::class, 'index'])->name('article.index'); 
    Route::get('create_article',[ArticleController::class, 'create'])->name('article.create');
    Route::post('store_article',[ArticleController::class, 'store'])->name('article.store');
    Route::get('edit_article/{id}',[ArticleController::class, 'edit'])->name('article.edit'); 
    Route::put('update_article/{id}',[ArticleController::class, 'update'])->name('article.update'); 
    Route::get('show_article/{id}',[ArticleController::class, 'show'])->name('article.show');
    // Route::post('delete_article/{id}',[ArticleController::class, 'destroy'])->name('article.destroy');
    Route::get('delete/{id}', [ArticleController::class, 'destroy'])->name('posts.delete');
    Route::get('status_update/{id}',[ArticleController::class, 'changeStatusArticle'])->name('status.update'); 


    // Route::resource('article', ArticleController::class); 

    Route::post('store_comment',[ArticleController::class, 'storeComment'])->name('comment.store');
    Route::get('show_articlecomment/{id}',[ArticleController::class, 'showArticleComment'])->name('articlecomment.show');
    

});
