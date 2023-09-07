<?php

namespace App\Cards;

class ArticleCard extends Base
{
    public static function convertTimberPost($post, $isFeatured = false, $isDark = false)
    {
        $excerptLength = $isFeatured ? 30 : 15;

        return [
            'title' => $post->post_title,
            'url' => $post->link(),
            'image' => $post->thumbnail(),
            'lead' => $post->preview->length($excerptLength)->read_more(false)->__toString(),
            'date' => [
                'raw' => $post->date('Y-m-d'),
                'formatted' => $post->date()
            ],
            'is_featured' => $isFeatured,
            'is_dark' => $isDark,
        ];
    }
}
