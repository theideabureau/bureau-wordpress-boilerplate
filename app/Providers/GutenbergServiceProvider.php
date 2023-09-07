<?php

namespace App\Providers;

use Rareloop\Lumberjack\Providers\ServiceProvider;

class GutenbergServiceProvider extends ServiceProvider
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
        // supports
        add_action('after_setup_theme', [$this, 'addSupports'], 5);

        // blocks
        add_action('init', [$this, 'registerBlockCategories'], 5);
        add_action('init', [$this, 'loadBlocks'], 5);

        // patterns
        add_action('init', [$this, 'disableCorePatterns'], 5);
        add_action('init', [$this, 'registerPatternCategories'], 5);
        add_action('init', [$this, 'loadPatterns'], 5);
    }

    public function addSupports()
    {
        add_theme_support('align-wide');
    }

    public function disableCorePatterns()
    {
        remove_theme_support('core-block-patterns');
    }

    public function registerBlockCategories()
    {
        add_filter('block_categories_all', function ($categories, $post) {
            return array_merge($categories, [
                [
                    'slug' => 'project-name-blocks',
                    'title' => 'Project Name Blocks' // TODO: update label
                ]
            ]);
        }, 10, 2);
    }

    public function registerPatternCategories()
    {
        register_block_pattern_category('project-name-patterns', [
            'label' => 'Project Name', // TODO: update label
        ]);
    }

    public static function loadBlocks()
    {
        $blocks = glob(__DIR__ . '/../../blocks/**/block.json');
        $logoSvg = file_get_contents(get_template_directory() . '/resources/img/logo-mark.svg');

        foreach ($blocks as $blocksPath) {
            register_block_type($blocksPath, [
                'icon' => $logoSvg,
            ]);
        }
    }

    public static function loadPatterns()
    {
        $patterns = glob(__DIR__ . '/../../block-patterns/*.json');

        foreach ($patterns as $patternsPath) {
            $patternProperties = json_decode(file_get_contents($patternsPath), true);

            register_block_pattern(
                'project-name/' . basename($patternsPath, '.json'),
                $patternProperties
            );
        }
    }
}
