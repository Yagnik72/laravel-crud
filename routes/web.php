<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterFormController;
use App\Http\Controllers\CustomerFormController;
use App\Models\Customer;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('index');
});
// })->middleware('guard');

Route::get('/registration', [RegisterFormController::class, 'index']);
Route::post('/registration', [RegisterFormController::class, 'register']);

Route::group(['middleware' => ['guard'], 'prefix' => '/customer'], function () {
    Route::get('/', [CustomerFormController::class, 'view'])->name('customer.page');
    Route::get('trash', [CustomerFormController::class, 'trash'])->name('customer.trash');
    Route::get('create', [CustomerFormController::class, 'index'])->name('customer.create');
    Route::post('create', [CustomerFormController::class, 'store']);
    Route::get('restore/{id}', [CustomerFormController::class, 'restore'])->name('customer.restore');
    Route::get('force-delete/{id}', [CustomerFormController::class, 'forceDelete'])->whereNumber('id')->name('force-customer.delete');
    Route::get('delete/{id}', [CustomerFormController::class, 'delete'])->whereNumber('id')->name('customer.delete'); // softDelete
    Route::get('edit/{id}', [CustomerFormController::class, 'edit'])->whereNumber('id')->name('customer.edit');
    Route::post('update/{id}', [CustomerFormController::class, 'update'])->whereNumber('id')->name('customer.update');
    Route::post('status/', [CustomerFormController::class, 'statusChange'])->name('customer.status');
});

Route::get('/get-all-session', function(){
    $session = session()->all();
    echo "<pre>";
    print_r($session);
    echo "</pre>";
    exit;

});

Route::get('/no-access', function () {
    return "You're not access this page";
    die;

});

Route::get('/set-session', function(Request $request){
    $request->session()->put('user_name', 'Yagnik');
    $request->session()->put('user_id', 45);

    // return redirect('get-all-session');
    return redirect('customer');
})->name('set-session.set');

Route::get('/destroy-session', function(Request $request){
    session()->forget(['user_name','user_id']);

    // return redirect('get-all-session');
    return redirect('/');
})->name('session.unset');
