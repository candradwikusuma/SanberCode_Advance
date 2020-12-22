<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listname;
use App\Http\Resources\ListResource;

class ListController extends Controller
{
    public function index(){
        $list= Listname::all();
        return ListResource::collection($list);
    }

    public function store(Request $request){
        $list= Listname::create([
            'name'=>$request->name
        ]);
            
        return new ListResource($list);

    }
    public function update(Request $request,$id){
        $list=Listname::find($id);

        $list->update([
            'name'=> $request->name
        ]);
        return new ListResource($list);
    }
    public function delete($id){
        Listname::destroy($id);
        return response()->json([
            'response_code'=>'00',
            'response_message'=> 'Profile user berhasil di delete',
        ],200);
    }


}
