<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $model = User::class;

     /**
     * Get All Records
     */

    public function index()
    {
        try {
            $records = $this->model::latest()->get();
            return response()->json([
                'success' => true,
                'data' => $records
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
     * Update Record
     */

    public function update(Request $request, $id)
    {
        try {
            $record = $this->model::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
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
