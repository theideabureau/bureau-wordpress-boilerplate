<?php

use Timber\Timber;

$context = Timber::get_context();
$context['block']['show_background'] = get_field('show_background');
$context['block']['center_text'] = get_field('center_text');
$context['block']['is_dark'] = get_field('is_dark');
$context['block']['is_transparent'] = get_field('is_transparent');
$context['block']['colour_scheme'] = get_field('colour_scheme') ?: 'inherit';

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

Timber::render('templates/blocks/content-panel.twig', $context);
