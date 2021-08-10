<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsClassController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProjectClassController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PageController::class, 'index'])
    ->name('home');
Route::get('home', [PageController::class, 'index'])
    ->name('home');
Route::get('members', [PageController::class, 'members'])
    ->name('members');
Route::get('members/{url}', [PageController::class, 'member'])
    ->name('member');
Route::get('publications', [PageController::class, 'publications'])
    ->name('publications');
Route::get('publications/{url}', [PageController::class, 'publication'])
    ->name('publication');
Route::get('patents', [PageController::class, 'patents'])
    ->name('patents');
Route::get('projects', [PageController::class, 'projects'])
    ->name('projects');
Route::get('projects/{url}', [PageController::class, 'project'])
    ->name('project');
Route::get('developments', [PageController::class, 'developments'])
    ->name('developments');
Route::get('developments/{url}', [PageController::class, 'development'])
    ->name('development');
Route::get('news', [PageController::class, 'news'])
    ->name('news');
Route::get('news/categories/{category}', [PageController::class, 'news_category'])
    ->name('news_category');
Route::get('news/{year}/{month}/{day}/{url}', [PageController::class, 'new'])
    ->name('new');
Route::get('contact', [PageController::class, 'contact'])
    ->name('contact');
Route::get('locale/{locale}', [PageController::class, 'locale'])
    ->name('locale');

require __DIR__.'/auth.php';

Route::get('admin', [ConfigurationController::class, 'index'])
    ->name('admin')
    ->middleware(['auth']);
Route::resource('admin/configuration', ConfigurationController::class)
    ->except('show','delete','create','store')
    ->middleware(['auth']);
Route::resource('admin/members', MemberController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/publications', PublicationController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/projects', ProjectController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/project_classes', ProjectClassController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/news', NewsController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/news_classes', NewsClassController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/partners', PartnerController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/sections', SectionController::class)
    ->except('show')
    ->middleware(['auth']);
Route::resource('admin/users', UserController::class)
    ->except('show','create','store')
    ->middleware(['auth']);

Route::get('{url}', [PageController::class, 'page'])
    ->name('page');
