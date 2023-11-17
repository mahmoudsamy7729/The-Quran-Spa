<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Homepage;
use App\Livewire\Reciters;
use App\Livewire\Surah;
use App\Livewire\SurahEn;


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

Route::get('/', Homepage::class)->name('homepage');
Route::get('/reciters', Reciters::class)->name('reciters');
Route::get('/surah/{id}', Surah::class)->name('surah');
Route::get('/surah/en/{id}', SurahEn::class)->name('surah-en');

