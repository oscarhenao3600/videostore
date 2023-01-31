<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::post('filter', [HomeController::class, 'filter'])->name('home.filter');

Route::prefix('films')->group(function () {
    Route::get('/', [FilmsController::class, 'index'])->name('films.index');
    Route::get('create', [FilmsController::class, 'films_create'])->name('films.films_create');
    Route::post('create-process', [FilmsController::class, 'films_create_process'])->name('films.films_create_process');
    Route::get('edit/{id}', [FilmsController::class, 'films_edit'])->name('films.films_edit');
    Route::patch('edit-process/{id}', [FilmsController::class, 'films_edit_process'])->name('films.films_edit_process');
    Route::delete('delete/{id}', [FilmsController::class, 'films_delete'])->name('films.films_delete');

    Route::get('get-data', [FilmsController::class, 'films_get_data'])->name('films.films_get_data');

    Route::prefix('films-type')->group(function () {
        Route::get('/', [FilmsController::class, 'films_type_list'])->name('films.films_type.films_type_list');
        Route::post('create', [FilmsController::class, 'films_type_create'])->name('films.films_type.films_type_create');
        Route::patch('edit/{id}', [FilmsController::class, 'films_type_edit'])->name('films.films_type.films_type_edit');
        Route::delete('delete/{id}', [FilmsController::class, 'films_type_delete'])->name('films.films_type.films_type_delete');

        Route::get('get-data', [FilmsController::class, 'films_type_get_data'])->name('films.films_type.films_type_get_data');
    });

    Route::prefix('films-genders')->group(function () {
        Route::get('/', [FilmsController::class, 'films_genders_list'])->name('films.films_genders.films_genders_list');
        Route::post('create', [FilmsController::class, 'films_genders_create'])->name('films.films_genders.films_genders_create');
        Route::patch('edit/{id}', [FilmsController::class, 'films_genders_edit'])->name('films.films_genders.films_genders_edit');
        Route::delete('delete/{id}', [FilmsController::class, 'films_genders_delete'])->name('films.films_genders.films_genders_delete');

        Route::get('get-data', [FilmsController::class, 'films_genders_get_data'])->name('films.films_genders.films_genders_get_data');
    });
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientsController::class, 'index'])->name('clients.index');
    Route::post('import', [ClientsController::class, 'import'])->name('clients.import');

    Route::get('get-clients', [ClientsController::class, 'get_clients'])->name('clients.get_clients');
});

Route::prefix('rental')->group(function () {
    Route::get('/', [RentalsController::class, 'index'])->name('rental.rental_list');
    Route::get('new-rental', [RentalsController::class, 'rentals_create'])->name('rental.rentals_create');
    Route::post('new-rental-process', [RentalsController::class, 'rentals_create_process'])->name('rental.rentals_create_process');
    Route::get('edit/{id}', [RentalsController::class, 'rentals_edit'])->name('rental.rentals_edit');
    Route::patch('edit-process/{id}', [RentalsController::class, 'rentals_edit_process'])->name('rental.rentals_edit_process');
    Route::delete('delete/{id}', [RentalsController::class, 'rentals_delete'])->name('rental.rentals_delete');

    Route::get('get-rentals', [RentalsController::class, 'get_rentals'])->name('rental.get_rentals');

    Route::get('film-view-data-added/{param?}', [RentalsController::class, 'film_view_added'])->name('rental.film_view_added');
    Route::post('film-add', [RentalsController::class, 'film_add'])->name('rental.film_add');
    Route::post('film-change-dates', [RentalsController::class, 'film_change_dates'])->name('rental.film_change_dates');
    Route::post('film-remove', [RentalsController::class, 'film_remove'])->name('rental.film_remove');
});

Route::group(['prefix' => 'helpers'], function () {
    Route::post('get-modal', [ApiController::class, 'get_modal'])->name('helpers.get_modal');
});