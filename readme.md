Blocks system for laravel 
 
1. install package composer require noistudio/admin-blocks
2. publish files from packages php artisan vendor:publish --tag=admin-blocks
3. run migrates  php artisan migrate
4. setup config /config/admin_blocks

Options for running

Option 1 blade directive

Option 2 dynamic run from text

If you want replace all special tags in text, You can use trait

`<?php


namespace App\Http\Controllers\web;

use AdminBlocks\Traits\HasBlockRender;

class HomeController
{
use HasBlockRender;
function index(){

      $data=array();
      $data['test']="@load_position('test_pos')";
      return $this->render("welcome",$data);
}
}
`

