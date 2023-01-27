<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Token;
use App\Models\Log;
use Carbon\Carbon;
use App\Helpers\UserHelper;

class SupplierController extends Controller
{
    
    public function index()
    {
        $suppliers = Supplier::get();
  
        return response()->json($suppliers);
    }

    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'supplier_name'  => 'required',
            'contact'        => 'required',
            'address'        => 'required|max:15',
        ]);
        $supplier_name = $request->input('supplier_name');

        $supplier = Supplier::create([
            'supplier_name'  => $request->input('supplier_name'),
            'contact'        => $request->input('contact'),
            'address'        => $request->input('address'),
        ]);
        $uh = new UserHelper;
        if ($supplier) {
            Log::create([
                'user_id' => $uh->getUserData($request->header('token'))->user_id,
                'datetime' => Carbon::now('Asia/Jakarta'),
                'activity' => 'Add Supplier(s)',
                'detail' => 'Add Supplier information with name '.$supplier_name
            ]); 
            return response()->json(['message' => 'Data added successfully'], 201);
        }else {
            return response()->json("Failure");
        }
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
            $validator = $this->validate($request, [
            'supplier_name'  => 'required',
            'contact'        => 'required',
            'address'        => 'required|max:15',
        ]);
        $supplier_name = $request->input('supplier_name');
        
        $supplier = Supplier::whereId($id)->update([
            'supplier_name' => $request->input('supplier_name'),
            'contact'       => $request->input('contact'),
            'address'       => $request->input('address'),
        ]);
        $uh = new UserHelper;
        if ($supplier) {
            Log::create([
                'user_id'   => $uh->getUserData($request->header('token'))->user_id,
                'datetime'  => Carbon::now('Asia/Jakarta'),
                'activity'  => 'Update Supplier(s)',
                'detail'    => 'Update Supplier information with name '.$supplier_name
            ]); 
            return response()->json(['message' => 'Data added successfully'], 201);
        } else {
            return response()->json("Failure");
        }
    }

    public function destroy($id)
    {
        Supplier::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}