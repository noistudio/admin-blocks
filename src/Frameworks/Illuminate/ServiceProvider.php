<?php

namespace AdminBlocks\Frameworks\Illuminate;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Base;

/**
 * Class ServiceProvider
 * @package PrizyvaNet\Vault\Frameworks\Illuminate
 */
class ServiceProvider extends Base
{
    public function register()
    {

    }

    public function boot(){

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/admin_blocks.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin_blocks');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'admin_blocks');
        Blade::directive('load_block', function ($block_id){


            return $block_id;
        });
        Blade::directive('load_position', function ($position){


            return "<?php echo  \AdminBlocks\Repository\PositionRepository::run($position)  ?>";
        });

        $this->publishes([

            __DIR__.'/../../resources/public' => public_path('vendor/admin_blocks'),
        ], 'admin_blocks');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/admin_blocks'),
        ],"admin_blocks");

        $this->publishes([
            __DIR__.'/../../resources/lang' => resource_path('lang/vendor/admin_blocks'),
        ],"admin_blocks");

        $this->publishes([
            __DIR__.'/../../config/admin_blocks.php' => config_path('admin_blocks.php'),
        ],"admin_blocks");
    }

}
