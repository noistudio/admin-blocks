<?php

namespace AdminBlocks\fields\menu;

use AdminBlocks\Interface\Field;

class MenuField implements Field
{


    public function __construct()
    {

    }


    public function setValue(){
        $post=request()->post();
        $value="";

        $result=array();
        $result['view']="";
        if(isset($post['view']) and is_string($post['view']) and strlen($post['view'])>0){
            $result['view']=$post['view'];
        }
        $result['links']=array();
        if(isset($post['links']) and is_string($post['links'])){
        $tmp_links=json_decode($post['links'],true);
        if(isset($tmp_links) and is_array($tmp_links)){
            $result['links']=$tmp_links;
        }
        }

        return $result;
    }

    public function getValue($value=null){


        $value_normal=null;
        if(isset($value) and is_array($value)){
            $value_normal=$value;
        }

        if(!$value_normal){
            $value_normal=array();
        }
        if(!isset($value_normal['links'])){
            $value_normal['links']=array();
        }

        if(!isset($value_normal['view'])){
            $value_normal['view']="";
        }

        return view("admin_blocks::fields.menu",$value_normal);
    }

    public function run($block){
        if(isset($block->data['view']) and isset($block->data['links']) and is_array($block->data['links']) and count($block->data['links'])>0){
            $data=array();
            $data['links']=$block->data['links'];
            $data['view_name']=$block->data['view'];
            return view($block->data['view'],$data)->render();
        }
        return "";
    }

}
