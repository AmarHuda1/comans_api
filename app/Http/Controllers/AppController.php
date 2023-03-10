<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\User;

class AppController extends Controller
{
    //
    public function profile(Request $request){
        if($request->isMethod('GET')){
            if ($request->user()->cannot('viewAny', Config::class)) {
                return response('Unauthorized', 401);
            }
            $data = Config::select('key','value')->where('type', 'profile')->orderBy('key','desc')->get();
            $d = array();
            foreach($data as $da){
                $d[$da->key] = $da->value;
            }
            //var_dump($data);
            return response()->json($d
        );
        }
        if ($request->isMethod('PUT')) {
            //$this->validate($request, [
            //    'key' => 'required|max:10',
            //    'value' => 'required|max:100'
            //]);
            if ($request->user()->cannot('update', Config::class)) {
                return response('Unauthorized', 401);
            }
            $f = $request->input();
            foreach ( $f as $k => $v){
            $data = Config::where([['type', 'profile'],['key',$k]])->first();
            if($data){
                $data->update(['value' =>$v]);
                return response()->json(['message' => 'Data updated  successfully'], 201);
            }
            return response()->json(['message' => 'Data with key "'.$k.'" not found',401]);
        }
        }
        return response('Forbiden Method', 403);

    }
    public function test(Request $request, ){
        //$id = explode(' ', $request['prs']);
        //$ids = explode(',', $request['per']);
        //$b = array();
        //foreach ($ids as $a) {
        //     array_push($b,trim($a));}
        //var_dump($id);
        return response()->json(Branch::find('eec66aa2-7f2d-3f32-a83f-3890461074da')->user);
    }
}
