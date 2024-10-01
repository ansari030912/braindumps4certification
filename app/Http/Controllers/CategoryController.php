<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function getCategoryPosts($slug)
    {
        // Fetch the category by its slug
        $category = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->where('wp_terms.slug', $slug)
            ->where('wp_term_taxonomy.taxonomy', 'category')
            ->select('wp_terms.term_id', 'wp_terms.name', 'wp_terms.slug')
            ->first();

        if (!$category) {
            abort(404);
        }

        // Fetch the posts associated with the category, including their images
        // Fetch the posts associated with the category, including their images, with pagination
        $posts = DB::table('wp_posts')
            ->join('wp_term_relationships', 'wp_posts.ID', '=', 'wp_term_relationships.object_id')
            ->join('wp_term_taxonomy', 'wp_term_relationships.term_taxonomy_id', '=', 'wp_term_taxonomy.term_taxonomy_id')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_term_taxonomy.term_id', $category->term_id)
            ->where('wp_posts.post_status', 'publish')
            ->select('wp_posts.post_title', 'wp_posts.post_content', 'wp_posts.post_name', 'wp_posts.post_date', 'wp_posts.post_type', 'img.guid as post_image')
            ->orderBy('wp_posts.post_date', 'desc')
            ->paginate(22); // Paginate with 10 posts per page

        // Fetch recent posts, including their images
        $recentPosts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post') // Only fetch regular posts, not pages or other types
            ->select('wp_posts.post_title', 'wp_posts.post_name', 'wp_posts.post_date', 'img.guid as post_image')
            ->orderBy('wp_posts.post_date', 'desc')
            ->limit(7) // Limit to recent 7 posts
            ->get();

        // Fetch all categories for the sidebar or menu
        $categories = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->where('wp_term_taxonomy.taxonomy', 'category')
            ->select('wp_terms.name', 'wp_terms.slug')
            ->get();

        // Fetch all published pages for the sidebar or header
        $pages = DB::table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'page')
            ->orderBy('post_date', 'desc')
            ->get();

        return view('category', compact('category', 'posts', 'recentPosts', 'categories', 'pages'));
    }
}
