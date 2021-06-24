<?php


namespace AdminBlocks\Repository;


class FieldsRepository
{

    static function all(){
        $types=config("admin_blocks.types");
        $result=array();
        if(count($types)){
            foreach($types as $key_type=>$type){

               $result[]=$key_type;
            }
        }
        return $result;
    }

    static function exist($type){
        $find_type=config("admin_blocks.types.".$type);
        if($find_type){
            return true;
        }
        return false;
    }
    static function setValue($type){
        $find_type=config("admin_blocks.types.".$type);
        $tmp_object=new $find_type();
        return $tmp_object->setValue();
    }
    static function getValue($type,$value=null){
        $find_type=config("admin_blocks.types.".$type);
        $tmp_object=new $find_type();
        return $tmp_object->getValue($value);

    }


}
