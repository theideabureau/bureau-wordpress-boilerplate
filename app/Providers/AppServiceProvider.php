<?php

namespace App\Providers;

use App\Assets;
use Rareloop\Lumberjack\Post;
use Rareloop\Lumberjack\Providers\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->enqueueAssets();
        $this->removeCommentMenuItems();
        $this->extendPostClass();
        $this->adjustSearchURL();
    }

    protected function enqueueAssets()
    {
        add_action('wp_enqueue_scripts', function () {
            // EXTRACTED ASSETS
            Assets::registerScript('manifest', '/dist/js/manifest.js', [], true);
            Assets::registerScript('vendor', '/dist/js/vendor.js', [], true);

            // BASE ASSETS
            Assets::registerStyle('main', '/dist/css/styles.css');
            Assets::registerScript('main', '/dist/js/scripts.js', [], true);

            Assets::registerScript('block-feature-animation', '/dist/js/block-feature-animation.js', [], true);

            // QUEUE ASSETS
            wp_enqueue_style('main');
            wp_enqueue_script('main');
            wp_enqueue_script('block-feature-animation');
        });
    }

    protected function adjustSearchURL()
    {
        add_action('template_redirect', function () {
            if (is_search() && ! empty($_GET['s'])) {
                wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
                exit();
            }
        });
    }

    protected function extendPostClass()
    {
        Post::macro('primaryTerm', function ($taxonomy) {
            $terms = collect($this->terms($taxonomy));
            $termID = null;

            if (class_exists('WPSEO_Primary_Term')) {
                $primaryTerm = new \WPSEO_Primary_Term($taxonomy, $this->id);

                if ($primaryTerm->get_primary_term() >= 0) {
                    $termID = $primaryTerm->get_primary_term();
                }
            }

            if ($termID === null || $termID === false) {
                return $terms->first();
            } else {
                return $terms->firstWhere('id', $termID);
            }
        });
    }

    public function removeCommentMenuItems()
    {
        // removes from admin menu
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });

        // removes from post and pages
        add_action('init', function () {
            remove_post_type_support('post', 'comments');
            remove_post_type_support('page', 'comments');
        }, 100);

        // removes from admin bar
        add_action('wp_before_admin_bar_render', function () {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('comments');
        });
    }
}
