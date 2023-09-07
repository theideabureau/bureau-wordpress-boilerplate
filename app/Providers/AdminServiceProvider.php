<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;
use Timber\Timber;

class AdminServiceProvider extends ServiceProvider
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
        $this->setOptionsPages();
        $this->outputAdminIcons();
        $this->enqueueAssets();

        add_filter('http_request_host_is_external', '__return_true');
        add_theme_support('responsive-embeds');
    }

    public function enqueueAssets()
    {
        add_action('after_setup_theme', function () {
            // Add support for editor styles.
            add_theme_support('editor-styles');

            // Enqueue editor styles.
            add_editor_style('dist/css/gutenberg.css');
        });

        // Update CSS within in Admin
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('admin-styles', get_template_directory_uri() . '/dist/css/admin.css');
            wp_enqueue_script('admin-scripts', get_stylesheet_directory_uri() . '/dist/js/admin.js', ['acf-input']);
        });
    }

    public function outputAdminIcons()
    {
        add_action('admin_head', function () {
            $context = Timber::context();
            echo Timber::compile('partials/svg-loader.twig', $context);
        });
    }

    public function setOptionsPages()
    {
        if (function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page')) {
            // add parent
            $parent = acf_add_options_page([
                'page_title' => 'Options',
                'menu_title' => 'Options',
                'redirect' => true
            ]);

            // add sub page
            acf_add_options_sub_page([
                'page_title' => 'Footer',
                'menu_title' => 'Footer',
                'parent_slug' => $parent['menu_slug'],
            ]);

            acf_add_options_sub_page([
                'page_title' => 'Social',
                'menu_title' => 'Social',
                'parent_slug' => $parent['menu_slug'],
            ]);

            acf_add_options_sub_page([
                'page_title' => 'Search',
                'menu_title' => 'Search',
                'parent_slug' => $parent['menu_slug'],
            ]);
        }
    }
}
