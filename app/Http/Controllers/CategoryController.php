<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function update(Request $request, $id)
    {
        try {
            $record = Category::findOrFail($id)->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
            ]);
            return response()->json([
                'message' => 'Updated Successfully',
            ]);
        } catch (\Throwable $th) {
            return 'Something Went Wrong';
        }
    }

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

}
