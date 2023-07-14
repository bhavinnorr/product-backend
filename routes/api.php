<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Welcome;
use App\Models\Product;
use App\Models\RegisterToken;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
// use File;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/products-hi', function () {
    // return array("products"=> "$products");
    // return Response::json($products);
    return Response::json([
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
    ], 200);
});


Route::post('signup', function (Request $request) {
    $data = $request->all();
    $user = Users::where('email', $data['email'])->first();
    if ($user) {
        return Response::json(['message' => 'User Already Created with That Email. Please Login.']);
    }
    $user = new Users();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = $data['password'];
    $user->save();

    return Response::json(['message' => 'User Created Successfully'], 200);
});

Route::post('signin', function (Request $request) {
    $data = $request->all();
    // return Response::json($data,200);
    $user = Users::where('email', $data['email'])->first();
    if ($user) {
        if ($data['password'] == $user->password) {
            return Response::json(['message' => 'Logged in Successfully.', 'token' => 'jhksyvg8b5tr4wv5cqt867vc544444444645gc6543v675']);
        }
    } else {
        return Response::json(['message' => 'No User Found with That Email. Please Register if you want to create an account with this mail']);
    }
});

// Route::get('products', function () {
//     $products = Product::all();

//     return Response::json($products, 200);
// });

// echo unique_code(9);




// function ($filename) {
// return Response::json(["name"=>$filename],200);
// $img = new ImageController();
// return $img->show($filename);
// });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('save-file', [FileController::class, 'store']);
    Route::get('img', [ImageController::class, 'showImage']);
    Route::post('mail', function (Request $request) {
        // try {
        $data = $request->all();
        dd($data);
        $email_data = $data;
        $token = 'jkdsyhf98sby6r7834rb8isev466o8b7435784635v84b6n78bnq346n9qcn747985nvbq3467vnb56v4bncvb6nv47856c87cv6hdfbncviwak6734';
        $data['token'] = $token;
        $register = new RegisterToken();
        $register->email = $data['email'];
        $register->token = $data['token'];
        $register->save();
        Mail::to($data['email'])->send(new Welcome($data));

        return Response::json(['message' => 'Mail sent successfully.'], 200);
    });
    Route::apiResource('products', ProductController::class)->except(['create', 'edit', 'destroy'])->middleware('auth:sanctum');
    Route::apiResource('users', UserController::class)->except(['create', 'edit', 'destroy'])->middleware('auth:sanctum');
    Route::post('add-product', function (Request $request) {
        $data = $request->all();
        $product = new Product();
        $product->name = $data['name'];
        $product->fileList = $data['fileList'];
        $product->in_stock = $data['in_stock'] == 'yes' ? true : false;
        $product->category = $data['category'];
        $product->price = $data['price'];
        $product->image = $data['image'];
        $product->deleted_at = null;
        $product->save();

        // foreach ($product->image as $imageof) {
        // try {
        // rename($imageof['name'], $imageof['name']);
        // } catch (Exception $e) {
        //     File::makeDirectory(public_path("files") . "/" . $product->id);
        //     rename(public_path("files") . "/" . $request->ip() . "/" . $imageof['name'], public_path("files") . "/" . $product->id . "/" . $imageof['name']);
        // }
        // }
        return Response::json($product, 200);
    });
    // Route::resource('products', ProductController::class)->except(['create', 'edit', 'destroy']);
    // Route::resource('users', UserController::class)->except(['create', 'edit', 'destroy']);
});

// Route::group([
//     // 'middleware' => 'auth',
//     'prefix' => 'auth'
// ], function ($router) {
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/profile', [AuthController::class, 'profile']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
// Route::resource('products', ProductController::class)->except(['create', 'edit', 'destroy']);
// Route::resource('users', UserController::class)->except(['create', 'edit', 'destroy']);
// Route::post('me', [UserController::class, 'me']);
// });