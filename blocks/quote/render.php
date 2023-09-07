<?php

use Timber\Timber;

$context['block']['text'] = get_field('quotation');
$context['block']['show_citation'] = get_field('show_citation');
$context['block']['author'] = get_field('citation');
$context['block']['is_large'] = get_field('is_large');
$context['block']['color'] = get_field('colour') ?: 'inherit';

Timber::render('templates/blocks/quote.twig', $context);
