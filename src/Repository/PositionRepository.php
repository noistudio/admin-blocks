<?php
namespace AdminBlocks\Repository;

use AdminBlocks\Models\Position;
use Illuminate\Support\Facades\Cache;

class PositionRepository
{

    static function find_between($string = "", $start = "", $end = "", $greedy = false, $isunique = false) {
        if (is_null($string)) {
            $string = "";
        }
        $start = preg_quote($start);
        $end = preg_quote($end);

        $format = '/(%s)(.*';
        if (!$greedy)
            $format .= '?';
        $format .= ')(%s)/';

        $pattern = sprintf($format, $start, $end);
        preg_match_all($pattern, $string, $matches);

        $results = $matches[2];
        $old_results = $results;
        if ($isunique == true) {
            $results = array_unique($results);
            $results = array_values($results);
        }
        return $results;
    }

    static function run($position){

        $position_model=Position::query()->where("name",$position)->first();
        if(!$position_model){
            return "";
        }

        $cached_position=Cache::get('admin_block_position_'.$position_model->id);
        if($cached_position){
            return $cached_position;
        }


        $blocks=$position_model->blocks->where("enable",1);
        if(count($blocks)==0){
            return "";
        }
        $default_render=config("admin_blocks.default_render_position");
        $render_position=config("admin_blocks.render_positions.".$position_model->name);


        if(!$render_position){
            $render_position=$default_render;
        }

        $blocks_completes=array();
        foreach($blocks as $block){
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
            $blocks_completes[]=$new_block;

        }

        $data=array();
        $data['blocks']=$blocks_completes;

        $render= view($render_position,$data)->render();
         Cache::put('admin_block_position_'.$position_model->id,$render);
       return $render;



    }

}
