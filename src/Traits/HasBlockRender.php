<?php

namespace AdminBlocks\Traits;

use AdminBlocks\Repository\BlockRepository;
use AdminBlocks\Repository\PositionRepository;

trait HasBlockRender
{

    public function render($view_name,$data=array()){

        $render=view($view_name,$data)->render();
        $finder_blocks=PositionRepository::find_between($render,"@load_block(",")");
        if(count($finder_blocks)){
            foreach($finder_blocks as $find_block){
                $result = BlockRepository::run($find_block);

                $render=str_replace("@load_block(".$find_block.")",$result,$render);
            }
        }

        $finder_position=PositionRepository::find_between($render,"@load_position(",")");


        if(count($finder_position)){
            foreach($finder_position as $find_position){



                $find_position = str_replace(array('\'', '"','&quot;','&#039;'), '', $find_position);

                $result=PositionRepository::run($find_position);


                $render=str_replace("@load_position(&#039;".$find_position."&#039;)",$result,$render);
                $render=str_replace('@load_position(&quot;'.$find_position.'&quot;)',$result,$render);
            }
        }
        return $render;


    }

}
