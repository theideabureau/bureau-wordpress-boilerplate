<?php

use Timber\Timber;

$context = Timber::get_context();

$context['block']['allowed_inner_blocks'] = esc_attr(wp_json_encode([
    'project-name/grid-column',
]));

$context['block']['template'] = esc_attr(json_encode([
    [
        'project-name/grid-column',
        [
            'data' => [
                'field_624cb20111f98' => [
                    'field_624cb24e11f99' => '12',
                    'field_624cb25811f9a' => '12',
                    'field_624cb26211f9c' => '8'
                ],
                'field_624d3f8ccaf80' => [
                    'field_624d3f8ccaf81' => '0',
                    'field_624d3f8ccaf82' => '0',
                    'field_624d3f8ccaf83' => '0'
                ]
            ]
        ]
    ]
]));

$context['block']['is_preview'] = $is_preview ? 'true' : 'false';

Timber::render('templates/blocks/grid-container.twig', $context);
