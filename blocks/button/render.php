<?php

use Timber\Timber;

Timber::render('templates/blocks/button.twig', [
    'block' => [
        'has_arrow_icon' => get_field('has_arrow_icon'),
        'is_light' => get_field('is_light'),
        'is_text' => get_field('is_text'),
        'link' => get_field('link'),
    ]
]);
