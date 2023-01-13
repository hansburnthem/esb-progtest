<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::delete('/invoices/{invoice_id}', [InvoiceController::class, 'destroy']);

Route::get('/invoices/create', [InvoiceController::class, 'create']);
Route::post('/invoices', [InvoiceController::class, 'store']);

Route::get('/invoices/{invoice_id}', [InvoiceController::class, 'show']);
Route::get('/invoices/{invoice_id}/edit', [InvoiceController::class, 'edit']);
Route::put('/invoices/{invoice_id}', [InvoiceController::class, 'update']);


