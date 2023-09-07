<?php

use Timber\Timber;

Timber::render('templates/blocks/logo-grid.twig', [
    'block' => [
        'logos' => get_field('logos'),
        'is_inner_block' => get_field('is_inner_block'),
    ]
]);
