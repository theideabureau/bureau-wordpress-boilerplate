<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block']['template'] = esc_attr(json_encode([
    [
        'core/list', [
            'placeholder' => 'Type to add content'
        ]
    ],
]));

$context['block']['allowed_blocks'] = esc_attr(json_encode([
    'core/list',
]));

$context['block']['style'] = get_field('style');
$context['block']['columns'] = get_field('columns');

Timber::render('templates/blocks/icon-list.twig', $context);
