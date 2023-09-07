<?php

namespace App\Http;

use App\Menu\Menu;
use Rareloop\Lumberjack\Facades\Config;
use Rareloop\Lumberjack\Http\Lumberjack as LumberjackCore;

class Lumberjack extends LumberjackCore
{
    public function addToContext($context)
    {
        $context['environment'] = Config::get('app.environment');

        $context['is_home'] = is_home();
        $context['is_front_page'] = is_front_page();
        $context['is_logged_in'] = is_user_logged_in();

        $context['current_url'] = home_url($_SERVER['REQUEST_URI']);

        // In Timber, you can use TimberMenu() to make a standard Wordpress menu available to the
        // Twig template as an object you can loop through. And once the menu becomes available to
        // the context, you can get items from it in a way that is a little smoother and more
        // versatile than Wordpress's wp_nav_menu. (You need never again rely on a
        // crazy "Walker Function!")
        $context['menu'] = new Menu('main-nav');

        $this->addFurnitureContext($context);

        return $context;
    }

    public function addFurnitureContext(&$context)
    {
        $context['footer'] = [
            'menu' => new \Timber\Menu('footer-nav'),
        ];

        $context['header'] = [
            'menu' => new \Timber\Menu('header-nav'),
        ];

        $context['header']['menu']->items = collect($context['header']['menu']->items)
            ->map(function ($item) {
                $itemURL = parse_url($item->url, PHP_URL_PATH);

                if (strpos($_SERVER['REQUEST_URI'], $itemURL) === 0) {
                    $item->classes[] = 'current-menu-ancestor';
                }

                return $item;
            });

        $context['social'] = [
            'facebook' =>  get_field('social__facebook_url', 'options'),
            'twitter' =>  get_field('social__twitter_url', 'options'),
            'linkedin' =>  get_field('social__linkedin_url', 'options'),
        ];
    }
}
