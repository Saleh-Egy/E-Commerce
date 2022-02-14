<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    /**
     * Get All Records
     */
    public function index()
    {
        try {
            $records = ActivityLog::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $records
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
