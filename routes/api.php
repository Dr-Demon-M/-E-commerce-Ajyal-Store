    <?php

    use App\Http\Controllers\Api\AuthToken;
    use App\Http\Controllers\Api\ProductController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::apiResource('product1', ProductController::class)->only(['index', 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('product1', ProductController::class)->except(['index', 'show']);
    });

    Route::post('/auth/token', [AuthToken::class, 'store']);
    Route::delete('/auth/token', [AuthToken::class, 'destroy'])->middleware('auth:sanctum');
