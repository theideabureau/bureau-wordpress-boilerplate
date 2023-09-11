<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block']['id'] = '___' . $block['id'];
$context['block']['span'] = get_field('columns');
$context['block']['offset'] = get_field('offsets');
$context['block']['order'] = get_field('orders');
$context['block']['is_preview'] = $is_preview ? 'true' : 'false';

$context['block']['template'] = esc_attr(json_encode([
    [
        'core/paragraph',
        [
            'placeholder' => 'Start adding your content here',
        ]
    ]
]));

Timber::render('templates/blocks/grid-column.twig', $context);
