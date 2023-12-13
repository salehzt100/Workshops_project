<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use App\Http\Controllers\v1\EmployeeController;

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
/*

Route::get('/', function () {
    \Illuminate\Support\Facades\DB::listen(function ($query){
        logger($query->sql);
    });
    return view('posts', [
            "posts" => Post::with('category')->get()
        ]
    );}
);*/


/*
Route::get("/api/{version}/employees", function(){


    $current_page=key_exists('page',$_GET)?$_GET['page']:1;
    $limit=key_exists('limit',$_GET)?$_GET['limit']:2;
    $paginator=User::query()->paginate($limit,['id','userName','profile_image'],"page",$current_page);
    return $paginator->items();


});*/


include(base_path('routes/api.php'));
