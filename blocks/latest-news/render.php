<?php

use App\Cards\Article as ArticleCard;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

$context = Timber::get_context();

$context['block']['posts'] = Post::whereStatus('publish')
    ->limit(3)
    ->get()
    ->map(fn ($post) => ArticleCard::convertTimberPost($post, false, true));

Timber::render('templates/blocks/latest-news.twig', $context);
