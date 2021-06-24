<?php

namespace AdminBlocks\Controllers;



use AdminBlocks\Models\Position;

class PositionController extends \App\Http\Controllers\Controller
{

    function index(){

        $data=array();
        $data['rows']=\AdminBlocks\Models\Position::query()->get();




         return   view("admin_blocks::positions.index",$data);
    }

    function add(){
        $data=array();


        return   view("admin_blocks::positions.add");
    }

    function doadd(){
        $request=request();
        $validated = $request->validate([
            'position' => 'required|unique:\AdminBlocks\Models\Position,name|max:255',

        ]);
        $position=new Position();
        $position->name=$validated['position'];
        $position->save();

        return redirect()->route("admin_blocks.position.index");
    }


    function delete($id){

        $position=Position::query()->find($id);
        if($position){
            $position->delete();
        }

        return redirect()->route("admin_blocks.position.index");
    }

}
