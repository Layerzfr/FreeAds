<?php
use Illuminate\Support\Facades\Input;
use App\Annonce;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', 'IndexController@showIndex');
Route::get('/accueil', 'IndexController@showIndex');
Route::auth();
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user','UserController')->middleware('auth');
Route::resource('annonces','AnnonceController')->middleware('auth');
Route::get('/annonce', 'AnnonceController@index')->name('annonceIndex')->middleware('auth');
Route::get('/annonce/add', 'AnnonceController@create')->name('annonceCreate')->middleware('auth');
/* Route::any ( '/search', function () {
    $q = Input::get ( 'q' );
    if(Input::get ( 'order' ) != ""){
    $order = Input::get ( 'order' );
    }else{
        $order = "title";
    }
    $annonce = Annonce::where ( 'title', 'LIKE', '%' . $q . '%' )->orWhere ( 'desc', 'LIKE', '%' . $q . '%' )->orderBy($order, 'desc')->get();
    if (count ( $annonce ) > 0)
        return view ( 'annonce.result', compact('annonce', 'q') )->withDetails ( $annonce )->withQuery ( $q );
        //return view('user.index',compact('users'));
    else
        return view ( 'annonce.result' )->withMessage ( 'Aucun résultat' );
} )->middleware('auth'); */
//Route::post('/search', 'AnnonceController@search')->middleware('auth');
Route::get('/search', 'AnnonceController@search')->middleware('auth');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index'])->middleware('auth');
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create'])->middleware('auth');
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store'])->middleware('auth');
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show'])->middleware('auth');
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update'])->middleware('auth');
});