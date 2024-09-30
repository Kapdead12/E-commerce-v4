<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComercianteController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para Administrador
    Route::middleware('role:admin')->group(function () {
        Route::get('/users-management', [UserController::class, 'index'])->name('users.index');
        
        // Añadir la ruta para listar usuarios
        //Route::get('/gestion-usuarios/listar', [UserController::class, 'index'])->name('admin.users.index');
        
        // Ruta para asignar roles a los usuarios
        //Route::post('/gestion-usuarios/{user}/asignar-rol', [UserController::class, 'assignRole'])->name('admin.users.assign-role');
        
        //Route::get('/gestion-productos', [AdminController::class, 'manageProducts']);
        //Route::get('/gestion-pedidos', [AdminController::class, 'manageOrders']);
        //Route::resource('roles', RoleController::class);  // Manteniendo la ruta de roles
    });
/*
    // Rutas para Comerciante
    Route::middleware('role:comerciante')->group(function () {
        Route::get('/mis-productos', [ComercianteController::class, 'myProducts']);
        Route::get('/pedidos', [ComercianteController::class, 'myOrders']);
    });

    // Rutas para Delivery
    Route::middleware('role:delivery')->group(function () {
        Route::get('/pedidos-disponibles', [DeliveryController::class, 'availableOrders']);
        Route::get('/mis-entregas', [DeliveryController::class, 'myDeliveries']);
    });
*/
    
});
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;   
use App\Http\Controllers\PermisoController;         
            

Route::get('/', function () {return view('welcome');})->middleware('guest')->name('welcome');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () { 
    //Para administrador   
    Route::get('/users', [UserController::class, 'index'])->name('users.index')
        ->middleware('permission:gestionar usuarios');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')
        ->middleware('permission:gestionar usuarios');
    Route::put('/users/{id}/edit', [UserController::class, 'update'])->name('users.update')
        ->middleware('permission:gestionar usuarios');

    // Para permisos a los usuarios
    Route::get('/users/{id}/permissions', [UserController::class, 'permisos'])->name('users.permisos')
        ->middleware('permission:gestionar permisos');
    Route::put('/users/{id}/permissions', [UserController::class, 'updatePermissions'])->name('users.updatePermisos')
        ->middleware('permission:gestionar permisos');
    //Demas rutas
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //Para actualizar el perfil
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    //Para crear y editar roles
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')
        ->middleware('permission:gestionar usuarios');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store')
        ->middleware('permission:gestionar usuarios');

    //Para crear y editar permisos
    Route::get('/permisos/create', [PermisoController::class, 'create'])->name('permisos.create')
        ->middleware('permission:gestionar permisos');
    Route::post('/permisos/store', [PermisoController::class, 'store'])->name('permisos.store')
        ->middleware('permission:gestionar permisos');    

    //Para mostrar roles-permisos
    Route::get('/users/rolesPermisos', [RoleController::class, 'show'])->name('rolesPermisos.show')
    ->middleware('permission:gestionar usuarios');
   
});
