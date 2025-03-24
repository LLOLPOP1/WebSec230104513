<?php

use App\Http\Controllers\{
    AdminController,
    CustomerController,
    EmployeeController,
    ProductController,
    PurchaseController,
    UserController
};
use App\Http\Controllers\CreditController;
use App\Services\GradeService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->getDashboardRoute());
    }
    return redirect()->route('login');
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

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'doLogin')->name('login.submit');
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'doRegister')->name('register.submit');
    });
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/edit/{product?}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/store/{product?}', [ProductController::class, 'store'])->name('products.store');
Route::get('products/delete/{product}', [ProductController::class, 'destroy'])->name('products.delete');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('users', UserController::class)->names([
                'index' => 'users.index',
                'create' => 'users.create',
                'store' => 'users.store',
                'show' => 'users.show',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ]);
            Route::resource('employees', EmployeeController::class);
        });

    // Employee Routes
    Route::middleware('role:admin,employee')
        ->prefix('employee')
        ->name('employee.')
        ->group(function () {
            Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
            Route::resource('products', ProductController::class);
            Route::post('credit/{user}/add', [CreditController::class, 'addCredit'])->name('credit.add');
        });

    // Customer Routes
    Route::middleware('role:customer')
        ->prefix('customer')
        ->name('customer.')
        ->group(function () {
            Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
            Route::get('products', [ProductController::class, 'browse'])->name('products.browse');
            Route::post('products/{product}/purchase', [PurchaseController::class, 'purchase'])->name('products.purchase');
            Route::get('purchases', [PurchaseController::class, 'index'])->name('purchases.index');
        });
});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post('/login', [UserController::class, 'doLogin'])->name('do_login');
