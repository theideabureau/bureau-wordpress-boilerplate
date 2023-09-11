<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

namespace App;

use App\Cards\ArticleCard;
use App\Http\Controllers\Controller;
use Rareloop\Lumberjack\Http\Responses\TimberResponse;
use Rareloop\Lumberjack\Page;
use Rareloop\Lumberjack\Post;
use Timber\Timber;

class HomeController extends Controller
{
    public function handle()
    {
        $context = Timber::get_context();
        $page = new Page(get_option('page_for_posts'));

        $context['post'] = $page;
        $context['title'] = $page->title;
        $context['content'] = $page->content;

        if ($this->getPageNumber() === 1) {
            $context['home']['featured_post'] = ArticleCard::convertTimberPost(
                $this->getFeaturedPost(),
                true
            );
        }

        $context['home']['posts'] = ArticleCard::convertCollection(
            $this->getPostsContext()
        );

        $context['home']['next_page_url'] = get_next_posts_link() ? get_next_posts_page_link() : null;
        $context['home']['prev_page_url'] = get_previous_posts_link() ? get_previous_posts_page_link() : null;

        return new TimberResponse('templates/home.twig', $context);
    }

    protected function getPageNumber()
    {
        return (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    protected function getFeaturedPost()
    {
        return (new Post())
            ->query([
                'post_type' => 'post',
                'posts_per_page' => 1
            ])
            ->first();
    }

    protected function getPostsContext()
    {
        $featuredPost = $this->getFeaturedPost();

        return (new Post())
            ->query([
                'posts_per_page' => 9,
                'post__not_in' => [$featuredPost->id],
                'paged' => $this->getPageNumber(),
            ]);
    }
}
