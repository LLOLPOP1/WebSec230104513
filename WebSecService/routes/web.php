<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
///////////////////////////////////////////////////////////////////////////
Route::get('/multable', function () {
    return view('multable');
})->name('multable');
///////////////////////////////////////////////////////////////////////////
Route::get('/even', function () {
    return view('even_number');
})->name('even');
///////////////////////////////////////////////////////////////////////////
Route::get('/prime', function () {
    return view('prime_number');
})->name('prime');
///////////////////////////////////////////////////////////////////////////
Route::get('/mini-test', function () {
    $bill = new stdClass();
    $bill->items = [
        (object)['name' => 'Apple', 'quantity' => 4, 'price' => 7],
        (object)['name' => 'Banana', 'quantity' => 5, 'price' => 1],
        (object)['name' => 'Orange', 'quantity' => 3, 'price' => 2],
        (object)['name' => 'sss', 'quantity' => 3, 'price' => 2],
    ];
    $bill->total = array_reduce($bill->items, function ($carry, $item) {
        return $carry + ($item->quantity * $item->price);
    }, 0);
    return view('lec1.mini_test', compact('bill'));
})->name('mini-test');

///////////////////////////////////////////////////////////////////////////
Route::get('/gpa', function () {
    $courses = [
        ['code' => 'CS101', 'name' => 'Introduction to Programming', 'ch' => 3, 'grade' => 85],
        ['code' => 'CS102', 'name' => 'Data Structures', 'ch' => 3, 'grade' => 92],
        ['code' => 'MATH201', 'name' => 'Calculus I', 'ch' => 4, 'grade' => 88],
        ['code' => 'ENG101', 'name' => 'Academic Writing', 'ch' => 3, 'grade' => 78],
        ['code' => 'HIST101', 'name' => 'World History', 'ch' => 3, 'grade' => 80],
        ['code' => 'PHYS101', 'name' => 'Physics I', 'ch' => 4, 'grade' => 75],
        ['code' => 'CHEM101', 'name' => 'General Chemistry', 'ch' => 4, 'grade' => 82],
        ['code' => 'BIO101', 'name' => 'Biology I', 'ch' => 3, 'grade' => 89]
    ];

    $totalCredits = 0;
    $totalPoints = 0;

    foreach ($courses as &$course) {
        $course['gpa'] = calculateGPA($course['grade']);
        $course['letter'] = getGradeLetter($course['grade']);
        $totalCredits += $course['ch'];
        $totalPoints += $course['gpa'] * $course['ch'];
    }

    $overallGPA = $totalPoints / $totalCredits;
    $overallGradeLetter = getGradeLetter($overallGPA * 25); // تحويل الـ GPA إلى مقياس 100 لحساب التقدير

    return view('lec1.gpa_task', compact('courses', 'overallGPA', 'overallGradeLetter'));
})->name('gpa');


function calculateGPA($grade) {
    if ($grade >= 90) return 4.0;
    if ($grade >= 85) return 3.5;
    if ($grade >= 80) return 3.0;
    if ($grade >= 75) return 2.5;
    if ($grade >= 70) return 2.0;
    if ($grade >= 65) return 1.5;
    if ($grade >= 60) return 1.0;
    return 0.0;
}

function getGradeLetter($grade) {
    if ($grade >= 90) return 'A';
    if ($grade >= 85) return 'B+';
    if ($grade >= 80) return 'B';
    if ($grade >= 75) return 'C+';
    if ($grade >= 70) return 'C';
    if ($grade >= 65) return 'D+';
    if ($grade >= 60) return 'D';
    return 'F';
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/edit/{products?}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/save/{products?}', [ProductController::class, 'store'])->name('products.save');
Route::get('products/delete/{products}', [ProductController::class, 'destroy'])->name('products.delete');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('user/create', [UserController::class, 'create'])->name('users.create');
Route::post('user/create', [UserController::class, 'store'])->name('users.store');
Route::get('user/edit/{user?}', [UserController::class, 'edit'])->name('users.edit');
Route::post('user/save/{user?}', [UserController::class, 'update'])->name('users.update');
Route::get('user/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('do_login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'doRegister'])->name('do_register');
Route::get('/logout', [UserController::class, 'logout'])->name(name: 'logout');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////