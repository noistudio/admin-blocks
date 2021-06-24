<?php

$prefix=config("admin_blocks.url_prefix");
Route::prefix($prefix)->middleware(config("admin_blocks.middlewares"))->group(function () {
    Route::get("/positions/index",[\AdminBlocks\Controllers\PositionController::class,"index"])->name("admin_blocks.position.index");
    Route::get("/positions/add",[\AdminBlocks\Controllers\PositionController::class,"add"])->name("admin_blocks.position.add");
    Route::post("/positions/doadd",[\AdminBlocks\Controllers\PositionController::class,"doadd"])->name("admin_blocks.position.doadd");
    Route::get("/positions/delete/{id}",[\AdminBlocks\Controllers\PositionController::class,"delete"])->name("admin_blocks.position.delete");
    Route::get("/blocks/index",[\AdminBlocks\Controllers\BlockController::class,"index"])->name("admin_blocks.blocks.index");
    Route::get("/blocks/add",[\AdminBlocks\Controllers\BlockController::class,"add"])->name("admin_blocks.blocks.add");
    Route::post("/blocks/doadd",[\AdminBlocks\Controllers\BlockController::class,"doadd"])->name("admin_blocks.blocks.doadd");
    Route::get("/blocks/edit/{id}",[\AdminBlocks\Controllers\BlockController::class,"edit"])->name("admin_blocks.blocks.edit");
    Route::post("/blocks/doedit/{id}",[\AdminBlocks\Controllers\BlockController::class,"doedit"])->name("admin_blocks.blocks.doedit");
    Route::get("/blocks/toogle/{id}",[\AdminBlocks\Controllers\BlockController::class,"toogle"])->name("admin_blocks.blocks.toogle");

    Route::get("/blocks/delete/{id}",[\AdminBlocks\Controllers\BlockController::class,"delete"])->name("admin_blocks.blocks.delete");

});


