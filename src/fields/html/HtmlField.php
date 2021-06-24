<?php

namespace AdminBlocks\fields\html;

use AdminBlocks\Interface\Field;

class HtmlField implements Field
{


    public function __construct()
    {

    }


    public function setValue(){
    $post=request()->post();
    $value="";
    if(isset($post['content']) and is_string($post['content'])){
      $value=$post['content'];
    }
        return array('content'=>$value);
    }

    public function getValue($value=null){


        $value_normal=null;
        if(isset($value) and is_array($value) and isset($value['content'])){
            $value_normal=$value['content'];
        }
        $data=array();
        $data['value']=$value_normal;
        return view("admin_blocks::fields.html",$data);
    }

    public function run($block){

        if(isset($block->data['content'])){
            return $block->data['content'];
        }
        return "";
    }

}
