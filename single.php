<?php

/**
 * The Template for displaying all single posts
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class SingleController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();

        $post = new Post();

        $context['single']['post'] = $post;

        return new TimberResponse('templates/single.twig', $context);
    }
}
