<?php

use Timber\Timber;

$context = Timber::get_context();
$context['block']['sections'] = get_field('sections');
$context['block']['preview'] = $is_preview;

Timber::render('templates/blocks/accordion.twig', $context);
