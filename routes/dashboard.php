    <?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoriesController;
    use App\Http\Controllers\Dashboard\DashboardController;
    use App\Http\Controllers\Dashboard\ProductController;
    use App\Http\Controllers\Dashboard\profileController;
    use App\Http\Controllers\Dashboard\RoleController;
    use App\Http\Controllers\Dashboard\StoreController;
    use App\Http\Controllers\Dashboard\ImportProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\front\NotificationsController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

    // , 'checkUserType:admin,super-admin'
    Route::middleware('auth:admin,web')->prefix('admin/dashboard')->group(function () { // should be auth and guard should be admin
        // Profile 
        Route::get('profile', [profileController::class, 'edit'])->name('dashboard.profile.edit');
        Route::patch('profile', [profileController::class, 'update'])->name('dashboard.profile.update'); // can't make it put cause put need variable {$id}


        // Dashboard
        // Route::get('/dashboard/index',[DashboardController::class, 'index']);
        Route::get('/', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

        // Route::middleware('ability.auto')->group(function () { // should be auth and guard should be admin
        // Category
        Route::get('/categories/trash', [CategoriesController::class, 'showTrashed'])->name('categories.trash');
        Route::put('/categories/{id}/trash', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('/categories/{id}/trash', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::resource('/categories', CategoriesController::class);


        // Product
        Route::get('products/import', [ImportProductController::class, 'index'])->name('products.import');
        Route::post('products/import', [ImportProductController::class, 'create']);

        Route::get('products/trash', [ProductController::class, 'showTrashed'])->name('products.trash');
        Route::put('products/{id}/trash', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{id}/trash', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
        Route::resource('/products', ProductController::class);


        // Store
        Route::get('stores/trash', [StoreController::class, 'showTrashed'])->name('stores.trash');
        Route::put('stores/{id}/trash', [StoreController::class, 'restore'])->name('stores.restore');
        Route::delete('stores/{id}/trash', [StoreController::class, 'forceDelete'])->name('stores.forceDelete');
        Route::resource('stores', StoreController::class);


        // Role
        Route::resource('roles', RoleController::class);
        
        // Admins
        Route::resource('admins', AdminController::class)->middleware('can:admins.index');
        
        // Users
        Route::resource('users', UserController::class)->middleware('can:users.index');
        
        // Orders
        Route::resource('orders', OrderController::class)/*->middleware('can:orders.index')*/;
        
        
        
        // });
    });
