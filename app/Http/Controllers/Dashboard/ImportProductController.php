<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProductJob;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function index()
    {
        return view('dashboard.products.import');
    }

    public function create(Request $request)
    {
        $job = new ImportProductJob($request->input('count'));
        $job->onQueue('imports')->delay(now()->addMinute(5));   
        dispatch($job);
        return redirect()->route('products.index')->with('success', 'Product import job has been dispatched!');
    }
    
}
