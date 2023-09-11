<?php

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

namespace App;

use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Timber\Timber;

class ArchiveExampleController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page(get_page_for_post_type());

        the_post();

        $context['page']['content'] = $page->content;

        return new TimberResponse('templates/generic-page.twig', $context);
    }
}
