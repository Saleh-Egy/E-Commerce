<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $model = Category::class;

    /**
     * Get All Records
     */

    public function index()
    {
        try {
            $records = $this->model::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $record
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Get Single Record
     */

    public function show($id)
    {
        try {
            $record = $this->model::findOrFail($id);
            if ($record){
                return response()->json([
                    'success' => true,
                    'data' => $record
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Create a New Record 
     */

    public function store(Request $request)
    {
        try {
            $record = $this->model::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
            ]);
            return response()->json([
                'message' => 'Created Successfully',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update Record
     */

    public function update(Request $request, $id)
    {
        try {
            $record = $this->model::findOrFail($id)->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
            ]);
            return response()->json([
                'message' => 'Updated Successfully',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Delete Record
     */

    public function destroy($id)
    {
        try {
            $record = $this->model::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Change Statues Of Record
     */

    public function changeStatues($id)
    {
        try {
            $record = $this->model::findOrFail($id);
            if($record){
                $record->active = !$record->active;
                $record->save();
                return response()->json([
                    'message' => 'Statues Changed Successfully',
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
