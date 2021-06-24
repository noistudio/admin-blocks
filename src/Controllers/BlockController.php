<?php


namespace AdminBlocks\Controllers;


use AdminBlocks\Models\Block;
use AdminBlocks\Models\Position;
use AdminBlocks\Repository\FieldsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class BlockController extends Controller
{

    function index(){
        $data=array();
        $get_vars=request()->all();

        $rows=Block::query()->where(function($query) use ($get_vars){
           if(isset($get_vars['type']) and is_string($get_vars['type']) and FieldsRepository::exist($get_vars['type'])){
            $query->where("type",$get_vars['type']);
           }
            if(isset($get_vars['position']) and is_numeric($get_vars['position'])){
                $query->where("position_id",$get_vars['position']);
            }

            if(isset($get_vars['enable']) and ($get_vars['enable']==0 or $get_vars['enable']==1)){
                $query->where("enable",$get_vars['enable']);
            }

        })->get();
        $data['get_vars']=$get_vars;
        $data['rows']=$rows;
        $data['positions']=Position::query()->get();
        $data['types']=FieldsRepository::all();



        return view("admin_blocks::blocks.list",$data);
    }

    function add(){

        $data=array();
        $data['positions']=Position::query()->get();
        $data['types']=FieldsRepository::all();
        $data['current_type']=$data['types'][0];
        $get_current_type=request()->get("type");
        if(count($data['types']) and isset($get_current_type)){
            foreach($data['types'] as $type){
                if($type==$get_current_type){
                    $data['current_type']=$get_current_type;
                }
            }
        }

        return view("admin_blocks::blocks.add",$data);
    }
    function doadd(){
        $request=request();
        $validated = $request->validate([
            'title' => 'required|max:255|unique:\AdminBlocks\Models\Block,title',
            'position_id' => 'required|integer|exists:\AdminBlocks\Models\Position,id',

        ]);
        $post=$request->post();
        $new_block=new Block();
        $new_block->position_id=$validated['position_id'];
        $new_block->title=$validated['title'];
        if(!(isset($post['type']) and FieldsRepository::exist($post['type']))){
            return back()->with("error",trans("admin_blocks::main.type_not_found"));
        }

        $new_block->type=$post['type'];
        $new_block->enable=0;
        if(isset($post['enable'])){
        $new_block->enable=1;
        }


      $content=null;
      if(isset($post['content'])){
      $content=$post['content'];
      }

      $content_field=FieldsRepository::setValue($new_block->type,$content);
      if(is_bool($content_field) and $content_field===false){
          return back()->with("error",trans("admin_blocks::main.data_not_filled"));
      }

        Cache::forget('admin_block_position_'.$new_block->position_id);

        $new_block->data=$content_field;
        $new_block->save();

        return redirect()->route("admin_blocks.blocks.edit",$new_block->id)->with("success",trans("admin_blocks::main.success"));



    }

    function edit($id){

        $block=Block::query()->find($id);
        if($block){

            $data=array();
            $data['block']=$block;
            $data['positions']=Position::query()->get();

            return view("admin_blocks::blocks.edit",$data);
        }
    }

    function doedit($id){
        $block=Block::query()->find($id);
        if(!$block) {

            return back()->with("error",trans("admin_blocks::main.block_not_found"));
        }
        $request=request();
        $validated = $request->validate([
            'title' => 'required|max:255',
            'position_id' => 'required|integer|exists:\AdminBlocks\Models\Position,id',

        ]);
        $post=$request->post();

        $block->position_id=$validated['position_id'];
        $block->title=$validated['title'];

        $block->enable=0;
        if(isset($post['enable'])){
            $block->enable=1;
        }

        if(isset($post['content'])){
            $content=$post['content'];
        }
        $content_field=FieldsRepository::setValue($block->type);
        if(is_bool($content_field) and $content_field===false){
            return back()->with("error",trans("admin_blocks::main.data_not_filled"));
        }

            $block->data=$content_field;
            Cache::forget('admin_block_'.$block->id);
            Cache::forget('admin_block_position_'.$block->position_id);

            $block->save();

            return back()->with("success",trans("admin_blocks::main.success_update"));

    }
    function toogle($id){

        $block=Block::query()->find($id);
        if($block){
              if($block->enable==1){
              $block->enable=0;
              }else {
               $block->enable=1;
              }
              $message=trans("admin_blocks::main.blocks_success_enable");
              if($block->enable==0){
              $message=trans("admin_blocks::main.blocks_success_disable");
              }

              $block->save();
            Cache::forget('admin_block_'.$block->id);
            Cache::forget('admin_block_position_'.$block->position_id);
            return redirect()->route("admin_blocks.blocks.index")->with("success",$message);
        }

        return redirect()->route("admin_blocks.blocks.index");
    }
    function delete($id){

        $block=Block::query()->find($id);
        if($block){
            $block->delete();
        }

        return redirect()->route("admin_blocks.blocks.index");
    }

}
