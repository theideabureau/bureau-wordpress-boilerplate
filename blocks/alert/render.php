<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block']['template'] = esc_attr(json_encode([
    [
        'core/paragraph', [
            'placeholder' => 'Type to add content'
        ]
    ],
]));

$context['block']['align'] = $block['align'] ?? 'full';
$context['block']['align_text'] = $block['align_text'] ?? 'left';

Timber::render('templates/blocks/alert.twig', $context);
