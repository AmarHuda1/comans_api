<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Logs;
use App\Models\Tokens;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\UserHelper;

class CategoriesController extends Controller
{
    
    public function index($id=null)
    {
        $categories = Categories::get();
  
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'category_name'    => 'required',
            'category_type'    => 'required',
        ]);
        $category_name = $request->input('category_name');
        $category_type = $request->input('category_type');
        $t = str_replace(['-', ' '], '', $category_type);
        $n = str_replace(' ', '', $category_name);
        // $id = substr($category_type, 0, 1).'-'.substr($category_name, 0, 2);
        $id = preg_replace('/([a-z])/', '', $t).'-'.preg_replace('/([a-z])/', '', $n);
        
        $category = Categories::create([
            'category_id'      => $id,
            'category_name'    => $category_name,
            'category_type'    => $category_type,
        ]);
        $uh = new UserHelper;
        if ($category) {
            Logs::create([
                'user_id' => $uh->getUserData($request->header('token'))->user_id,
                'datetime' => Carbon::now('Asia/Jakarta'),
                'activity' => 'Add Category(s)',
                'detail' => 'Add Category with type "'.$category_type.'" named "'.$category_name
            ]);
            return response()->json(['message' => 'Data added successfully'], 201);
        }else {
            return response()->json("Failure");
        }
    }

    public function show($id)
    {
        $category = Categories::find($id);

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validate($request, [
            'category_name'    => 'required',
            'category_type'    => 'required',
        ]);
        $category_name = $request->input('category_name');
        $category_type = $request->input('category_type');

        $category = categories::whereId($id)->update([
            'category_name'   => $request->input('category_name'),
            'category_type'   => $request->input('category_type'),
        ]);
        $uh = new UserHelper;
        if ($category) {
            Logs::create([
                'user_id' => $uh->getUserData($request->header('token'))->user_id,
                'datetime' => Carbon::now('Asia/Jakarta'),
                'activity' => 'Update Category(s)',
                'detail' => 'Update Category with type "'.$category_type.'" named "'.$category_name
            ]);
            return response()->json(['message' => 'Data updated successfully'], 200);
        }else {
            return response()->json("Failure");
        }
    }

    public function destroy($id)
    {
        Categories::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
