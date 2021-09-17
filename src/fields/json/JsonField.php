<?php

namespace AdminBlocks\fields\json;

use AdminBlocks\Interface\Field;

class JsonField implements Field
{


    public function __construct()
    {

    }


    public function setValue(){
        $request=request();
        $post=request()->post();
        $value="";


        $result=array();
        $result['view']="";
        if(isset($post['view']) and is_string($post['view']) and strlen($post['view'])>0){
            $result['view']=$post['view'];
        }
        $result['fields']=array();
        $result['config']=array();
        if(isset($post['config']) and is_string($post['config'])){
            $tmp_config=json_decode($post['config'],true);

            if(isset($tmp_config) and is_array($tmp_config) and count($tmp_config)>0){
                $types=array('text','image','file');
                foreach($tmp_config as $config_row){
                    if(isset($config_row['field_name']) and isset($config_row['title'])){


                     if(isset($config_row['type']) and $config_row['type']=="image"){
                         try {
                             $request->validate([
                                 $config_row['field_name'] => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                             ]);
                             $img_name = $config_row['field_name'];
                             $imageName = time() . '.' . $request->$img_name->extension();
                             $request->$img_name->move(public_path(config("admin_blocks.public_path_for_files")), $imageName);
                             $value_img = config("admin_blocks.public_path_for_files") . "/" . $imageName;


                      //       if (isset($config_row['value']) and strlen($config_row['value']) > 0) {
                      //           unlink(public_path($config_row['value']));
                      //       }
                             $config_row['value'] = $value_img;
                             $result['fields'][$config_row['field_name']] = $config_row['value'];
                         }catch(\Exception $e){

                         }

                     }else if(isset($config_row['type']) and $config_row['type']=="file"){
                         try {
                             $request->validate([
                                 $config_row['field_name'] => 'required',
                             ]);
                             $img_name = $config_row['field_name'];
                             $imageName = time() . '.' . $request->$img_name->extension();
                             $request->$img_name->move(public_path(config("admin_blocks.public_path_for_files")), $imageName);
                             $value_img = config("admin_blocks.public_path_for_files") . "/" . $imageName;


                       //      if (isset($config_row['value']) and strlen($config_row['value']) > 0) {
                      //           unlink(public_path($config_row['value']));
                      //       }
                             $config_row['value'] = $value_img;
                             $result['fields'][$config_row['field_name']] = $config_row['value'];
                         }catch(\Exception $e){

                         }
                     }
                     else if(isset($post[$config_row['field_name']]) and is_string($post[$config_row['field_name']])){
                         $config_row['value']="";
                      $config_row['value']=$post[$config_row['field_name']];
                      $result['fields'][$config_row['field_name']]=$post[$config_row['field_name']];
                     }
                     $result['config'][]=$config_row;

                    }
                }
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
        if(!isset($value_normal['config'])){
            $value_normal['config']=array();
        }

        if(!isset($value_normal['view'])){
            $value_normal['view']="";
        }

        return view("admin_blocks::fields.json",$value_normal);
    }

    public function run($block){
        if(isset($block->data['view']) and isset($block->data['fields']) and is_array($block->data['fields']) and count($block->data['fields'])>0){
            $data=$block->data['fields'];

            $data['view_name']=$block->data['view'];
            return view($block->data['view'],$data)->render();
        }
        return "";
    }

}
