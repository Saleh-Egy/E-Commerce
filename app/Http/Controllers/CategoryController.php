<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function destroy($id)
    {
        try {
            $record = Category::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Deleted Successfully',
            ]);
        } catch (\Throwable $th) {
            return 'Something Went Wrong';
        }
    }

    public function update(Request $request)
    {
        try {
            $record = Category::findOrFail($request->id)->update($request->all());
            return response()->json([
                'message' => 'Updated Successfully',
            ]);
        } catch (\Throwable $th) {
            return 'Something Went Wrong';
        }
    }
}
