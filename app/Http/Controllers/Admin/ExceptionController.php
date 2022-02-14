<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exception;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    /**
     * Get All Records
     */
    public function index()
    {
        try {
            $records = Exception::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $records
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
