<?php

namespace App\Cards;

class ArticleCard extends BaseCard
{
    /**
     * @return array<string, mixed>
     */
    public static function convertTimberPost($post, bool $isFeatured = false, bool $isDark = false): array
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
