<?php

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

Route::get('/', "App\Http\Controllers\LoginController@index");



Route::resource('login',"App\Http\Controllers\LoginController");


Route::group(['prefix' => 'admin', 'middleware' => ['adminMiddleware', 'auth' => 'role:user|administrator|superadministrator']], function() {

    Route::get('/', function () {
        return view('Dashboard.dashboard');
    })->name('admin');
/*
 *  Ajax Route
 * */

    route::get('get-sports', "\App\Http\Controllers\LevelsController@getSports")->name('get-sports');
    route::get('get-trainers', "\App\Http\Controllers\TrainerController@getTrainers")->name('get-trainers');
    route::get('get-stadium', "\App\Http\Controllers\StadiumController@getStadium")->name('get-stadiums');
    route::get('get-players', "\App\Http\Controllers\PlayersController@getPlayers")->name('get-players');
    route::get('get-sports-player', "\App\Http\Controllers\PlayersController@getSports")->name('get-sports-player');
    route::get('get-levels', "\App\Http\Controllers\LevelsController@getLevels")->name('get-levels');
    route::get('get-price-list', "\App\Http\Controllers\PackagesController@getPriceList")->name('get-price-list');
    route::get('get-price', "\App\Http\Controllers\PackagesController@getPrice")->name('get-price');
    route::get('get-price-list-player', "\App\Http\Controllers\PriceListController@getPriceList")->name('get-price-list-player');

   /*
    *  Routes Full Calender for Stadiums and Trainers
    */
    Route::post('trainer-and-player/ajax/store', "\App\Http\Controllers\TrainerAndPlayerController@store")->name('store-event');
    Route::post('trainer-and-player/ajax/update', "\App\Http\Controllers\TrainerAndPlayerController@update")->name('update-event');
    Route::post('trainer-and-player/ajax/delete', "\App\Http\Controllers\TrainerAndPlayerController@destroy")->name('delete-event');
    Route::get('trainer-and-player/ajax/show', "\App\Http\Controllers\TrainerAndPlayerController@show")->name('show-event');
    Route::get('role/ajax/get_permissions', "\App\Http\Controllers\RoleController@get_permissions")->name('get_permissions');

    Route::post('stadium-rent-table/ajax/store', "\App\Http\Controllers\StadiumsRentTableController@store")->name('store-stadium');
    Route::post('stadium-rent-table/ajax/update', "\App\Http\Controllers\StadiumsRentTableController@update")->name('update-stadium');
    Route::post('stadium-rent-table/ajax/delete', "\App\Http\Controllers\StadiumsRentTableController@destroy")->name('delete-stadium');
    Route::get('stadium-rent-table/ajax/show', "\App\Http\Controllers\StadiumsRentTableController@show")->name('show-stadium');
    Route::get('tournament-subscription/get-tournament-information', "\App\Http\Controllers\TournamentSubscriptionsController@getTournamentInformation")->name('get-tournament-information');
    Route::get('tournament-subscription/get-tournament-selected-players', "\App\Http\Controllers\TournamentSubscriptionsController@getSelectedPlayers")->name('get-tournament-selected-players');
    Route::get('tournament-follow/get-tournament-information', "\App\Http\Controllers\TournamentPlayersDetailsController@getTournamentInformation")->name('get-tournament-follow-information');
    Route::get('tournament-follow/get-player-information', "\App\Http\Controllers\TournamentPlayersDetailsController@getPlayerInformation")->name('get-player-information');

    #################################################.

    route::get('get-players-sports-price', "\App\Http\Controllers\ReceiptsController@getPlayerSportPrice")->name('get-players-sports-price');
    route::get('get-players-data', "\App\Http\Controllers\PlayersController@getPlayerData")->name('get-players-data');

    #################################################.
    route::get('/file/delete/{id}',"\App\Http\Controllers\PlayersController@deleteFiles");
    ################################################

    ################### Custody expense Route ajax ##############################.
    route::get('/custody-expense-get',"\App\Http\Controllers\CustodyExpenseController@index")->name('custody-expense-get');
    route::post('/custody-expense-store',"\App\Http\Controllers\CustodyExpenseController@store")->name('custody-expense-store');
    ################################################

    ################### ٌ  Route PDf and Excel  ##############################.
    Route::get('receipt/pdf', "\App\Http\Controllers\ReceiptsController@pdfFile")->name('receipt.pdf');
    Route::get('receipt/excel', "\App\Http\Controllers\ReceiptsController@pdfFile")->name('receipt.excel');

    ################################################


    Route::resource('branch', "\App\Http\Controllers\BranchesController");
    Route::resource('sport', "\App\Http\Controllers\SportsController");
    Route::resource('level', "\App\Http\Controllers\LevelsController");
    Route::resource('price-list', "\App\Http\Controllers\PriceListController");
    Route::resource('package', "\App\Http\Controllers\PackagesController");
    Route::resource('receipt', "\App\Http\Controllers\ReceiptsController");
    Route::resource('receipt-type', "\App\Http\Controllers\ReceiptTypesController");
    Route::resource('receipt-pay', "\App\Http\Controllers\ReceiptsPayController");
    Route::resource('receipt-type-pay', "\App\Http\Controllers\ReceiptTypePayController");
    Route::resource('employee', "\App\Http\Controllers\EmployeesController");
    Route::resource('player', "\App\Http\Controllers\PlayersController");
    Route::resource('item', "\App\Http\Controllers\ItemsController");
    Route::resource('contract', "\App\Http\Controllers\ContractController");
    Route::resource('trainer', "\App\Http\Controllers\TrainerController");
    Route::resource('trainer-and-player', "\App\Http\Controllers\TrainerAndPlayerController");
    Route::resource('stadium-rent-table', "\App\Http\Controllers\StadiumsRentTableController");
    Route::resource('attendance-player', "\App\Http\Controllers\AttendancePlayersController");
    Route::resource('attendance-trainer', "\App\Http\Controllers\TrainerAttendanceController");
    Route::resource('stadium', "\App\Http\Controllers\StadiumController");
    Route::resource('role', "\App\Http\Controllers\RoleController");

    Route::resource('custody', "\App\Http\Controllers\CustodyController");
    Route::resource('settlement-request', "\App\Http\Controllers\SettlementRequestController");
    Route::resource('cuts-employee', "\App\Http\Controllers\CutsEmployeeController");
    Route::resource('partner-contract', "\App\Http\Controllers\PartnerContractsController");
    Route::resource('tournament', "\App\Http\Controllers\TournamentsController");
    Route::resource('tournament-subscription', "\App\Http\Controllers\TournamentSubscriptionsController");
    Route::resource('tournament-follow', "\App\Http\Controllers\TournamentPlayersDetailsController");
    Route::resource('contract-partner',"\App\Http\Controllers\ContractPartnersController");
    Route::resource('partner',"\App\Http\Controllers\PartnersController");
    Route::resource('report',"\App\Http\Controllers\ReportController");

Route::get('logout',"App\Http\Controllers\LoginController@logout")->name('logout');
});

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
