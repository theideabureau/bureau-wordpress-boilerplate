<?php

namespace App\Providers;

use App\Models\Imgix;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class ImgixServiceProvider extends ServiceProvider
{
    /**
     * Register any app specific items into the container
     */
    public function register()
    {
    }

    /**
     * Perform any additional boot required for this application
     */
    public function boot()
    {
        add_filter('timber/twig', function (\Twig\Environment $twig) {
            $twig->addFunction(new \Twig\TwigFunction('imgix', [$this, 'render']));
            return $twig;
        });
    }

    public function render($args)
    {
        return (new Imgix($args))->render();
    }
}
