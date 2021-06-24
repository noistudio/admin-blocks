<?php


namespace AdminBlocks\Repository;


use AdminBlocks\Models\Block;
use AdminBlocks\Models\Position;
use Illuminate\Support\Facades\Cache;

class BlockRepository
{

    static function run($id){

        $block=Block::query()->where("id",$id)->where("enable",1)->first();
        if(!$block){
            return "";
        }

        $cached_block=Cache::get('admin_block_'.$block->id);
        if($cached_block){
            return $cached_block;
        }


        $new_block=new \stdClass();
        $new_block->content=$block->runBlock();
        $finder_blocks=PositionRepository::find_between($new_block->content,"@load_block(",")");
        if(count($finder_blocks)){
           foreach($finder_blocks as $find_block){
               if($find_block==$block->id){
                   $result="";
               }else {
                   $result = BlockRepository::run($find_block);
               }

               $new_block->content=str_replace("@load_block(".$find_block.")",$result,$new_block->content);
           }
        }
        Cache::put('admin_block_'.$block->id, $new_block->content);


        return $new_block->content;



    }


}
