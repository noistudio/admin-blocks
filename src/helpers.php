<?php


if (!function_exists('block_get')) {
    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */

    function block_get($block_id){

        $block=\AdminBlocks\Models\Block::query()->find($block_id);

        return $block;

    }

}

