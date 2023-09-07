<?php

namespace App\PostTypes;

use Rareloop\Lumberjack\Post;

class Example extends Post
{
    /**
     * Return the key used to register the post type with WordPress
     * First parameter of the `register_post_type` function:
     * https://codex.wordpress.org/Function_Reference/register_post_type
     *
     * @return string
     */
    public static function getPostType()
    {
        return 'example';
    }

    /**
     * Return the config to use to register the post type with WordPress
     * Second parameter of the `register_post_type` function:
     * https://codex.wordpress.org/Function_Reference/register_post_type
     *
     * @return array|null
     */
    protected static function getPostTypeConfig()
    {
        return [
            'has_archive' => true,
            'labels' => [
                'name' => 'Examples',
                'singular_name' => 'Example',
                'add_new_item' => 'Add New Example',
            ],
            'public' => true,
            'rewrite' => [
                'slug' => 'examples',
                'with_front' => false
            ],
            'show_in_rest' => true,
            'supports' => ['editor', 'thumbnail', 'revisions', 'title'],
        ];
    }
}
