<?php

// namespace App\Models;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// use Response;

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
$products = [
    [
        'uid' => '-1',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
    [
        'uid' => '2',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
    [
        'uid' => '3',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
    [
        'uid' => '4',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
    [
        'uid' => '5',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
    [
        'uid' => '6',
        'name' => 'image.png',
        'status' => 'done',
        'url' => 'https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png',
    ],
];
Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return 'Hi';
});
Route::get('items/{id?}', function ($id = 10) {
    echo 'ID: '.$id;
});
// $product = \App\Models\Product::all();

// Route::get("mail/{email?}", function ($email='ravisinghopen90@gmail.com') {
//   $mail=$email;
//   Mail::send('welcome', ['name' => 'John Doe'], function ($message) {
//     $message->to($mail, 'John Doe');
//     $message->subject('Welcome!');
//   });
//   return Response::json("Mail sent successfully", 200);
// });
