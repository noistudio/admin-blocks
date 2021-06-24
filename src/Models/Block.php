<?php

namespace AdminBlocks\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{

    protected $fillable = ['data'];
    protected $table = null;
    protected $casts = [
        'data' => 'array'
    ];

    function __construct(array $attributes = [])
    {
        $this->table= config("admin_blocks.tables.blocks");
    }

    public function position()
    {
        return $this->hasOne(Position::class,"id","position_id");
    }

    public function  runBlock(){

        $find_type=config("admin_blocks.types.".$this->type);
        $tmp_object=new $find_type();
        return $tmp_object->run($this);
    }

}
