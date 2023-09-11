<?php

use Timber\Timber;

$context = Timber::get_context();
$context['block']['image'] = get_field('image');
$context['block']['template'] = esc_attr(json_encode([
    [
        'core/heading', [
            'level' => 3,
            'placeholder' => 'Heading'
        ]
    ],
    [
        'core/paragraph', [
            'placeholder' => 'Enter your description...'
        ]
    ],
]));

Timber::render('templates/blocks/content-with-image.twig', $context);
