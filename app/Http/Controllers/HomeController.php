<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Display all posts on the homepage
    public function index()
    {
        // Fetch categories for the sidebar
        $categories = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->where('wp_term_taxonomy.taxonomy', 'category')
            ->select('wp_terms.term_id', 'wp_terms.name', 'wp_terms.slug')
            ->get();

        // Fetch posts, including their images
        $posts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->select('wp_posts.*', 'img.guid as post_image')
            ->orderBy('wp_posts.post_date', 'desc')
            ->get();

        // Fetch pages
        $pages = DB::table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'page')
            ->orderBy('post_date', 'desc')
            ->get();

        // Fetch recent posts, including their images
        $recentPosts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post')
            ->select('wp_posts.*', 'img.guid as post_image')
            ->orderBy('wp_posts.post_date', 'desc')
            ->limit(7)
            ->get();

        // Paginate posts for 'Popular News', including their images
        $popularNews = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post')
            ->select('wp_posts.*', 'img.guid as post_image')
            ->orderBy('wp_posts.post_date', 'desc')
            ->paginate(15);

        // Return the view with all the required data
        return view('home', compact('posts', 'pages', 'popularNews', 'categories', 'recentPosts'));
    }

    // Display an individual post based on post_name (permalink)
    public function show($post_name)
    {
        // Fetch the individual post using the post_name
        $post = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_name', $post_name)
            ->select('wp_posts.*', 'img.guid as post_image')
            ->first();

        // If the post is not found, return a 404 error
        if (!$post) {
            abort(404);
        }

        // Fetch categories for the sidebar
        $categories = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->where('wp_term_taxonomy.taxonomy', 'category')
            ->select('wp_terms.term_id', 'wp_terms.name', 'wp_terms.slug')
            ->get();

        // Fetch pages for the sidebar
        $pages = DB::table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'page')
            ->orderBy('post_date', 'desc')
            ->get();

        // Fetch recent posts for the sidebar
        $recentPosts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->orderBy('wp_posts.post_date', 'desc')
            ->get();

        // Return the individual post view with the post and other data
        return view('post', compact('post', 'recentPosts', 'pages', 'categories'));
    }
}
