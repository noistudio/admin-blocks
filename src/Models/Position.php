<?php

namespace AdminBlocks\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    protected $table = null;

    function __construct(array $attributes = [])
    {
        $this->table= config("admin_blocks.tables.positions");
    }

    public function blocks()
    {
        return $this->hasMany(Block::class,"position_id","id");
    }

}
