<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        // Fetch top 2 unique posts of type 'post' for the top section
        $topPosts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post') // Only fetch posts of type 'post'
            ->select(
                'wp_posts.ID',
                'wp_posts.post_title',
                'wp_posts.post_name',
                'wp_posts.post_date',
                'wp_posts.post_content', // Add post_content field
                'wp_posts.post_type',    // Add post_type field
                'img.guid as post_image'
            )
            ->orderBy('wp_posts.post_date', 'desc')
            ->distinct()
            ->take(2)
            ->get();

        // Fetch next 3 unique posts of type 'post' for the middle section
        $middlePosts = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post') // Only fetch posts of type 'post'
            ->select(
                'wp_posts.ID',
                'wp_posts.post_title',
                'wp_posts.post_name',
                'wp_posts.post_date',
                'wp_posts.post_content', // Add post_content field
                'wp_posts.post_type',    // Add post_type field
                'img.guid as post_image'
            )
            ->orderBy('wp_posts.post_date', 'desc')
            ->distinct()
            ->skip(2)
            ->take(3)
            ->get();

        $popularNews = DB::table('wp_posts')
            ->leftJoin('wp_posts as img', function ($join) {
                $join->on('img.post_parent', '=', 'wp_posts.ID')
                    ->where('img.post_type', '=', 'attachment')
                    ->where('img.post_mime_type', 'LIKE', 'image/%');
            })
            ->where('wp_posts.post_status', 'publish')
            ->where('wp_posts.post_type', 'post')
            ->select(
                'wp_posts.ID',
                'wp_posts.post_title',
                'wp_posts.post_name',
                'wp_posts.post_date',
                'wp_posts.post_content', // Ensure post_content is included in the select statement
                'wp_posts.post_type',
                DB::raw('MAX(img.guid) as post_image')
            )
            ->groupBy('wp_posts.ID', 'wp_posts.post_title', 'wp_posts.post_name', 'wp_posts.post_date', 'wp_posts.post_type', 'wp_posts.post_content') // Add post_content to the group by
            ->orderBy('wp_posts.post_date', 'desc')
            ->paginate(17);

        // Fetch pages for the sidebar
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
            ->where('wp_posts.post_type', 'post') // Only fetch posts of type 'post'
            ->select(
                'wp_posts.ID',
                'wp_posts.post_title',
                'wp_posts.post_name',
                'wp_posts.post_date',
                'wp_posts.post_content', // Add post_content field
                'wp_posts.post_type',    // Add post_type field
                'img.guid as post_image'
            )
            ->orderBy('wp_posts.post_date', 'desc')
            ->distinct()
            ->limit(7)
            ->get();

        // Return the view with all the required data
        return view('home', compact('topPosts', 'middlePosts', 'popularNews', 'categories', 'pages', 'recentPosts'));
    }

    // Display an individual post based on post_name (permalink)
    public function show($post_name)
    {
        // Fetch the individual post
        $post = DB::table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_name', $post_name)
            ->first();

        if (!$post) {
            abort(404); // Post not found
        }

        // Fetch comments related to the post
        $comments = DB::table('wp_comments')
            ->where('comment_post_ID', $post->ID)
            ->where('comment_approved', 1) // Only fetch approved comments
            ->orderBy('comment_date', 'asc')
            ->get();

        // Fetch whether comments are open
        $commentsOpen = $post->comment_status === 'open';

        // Fetch other data if necessary (pages, recent posts, categories)
        $pages = DB::table('wp_posts')->where('post_type', 'page')->get();
        $recentPosts = DB::table('wp_posts')->where('post_type', 'post')->orderBy('post_date', 'desc')->get();
        $categories = DB::table('wp_terms')
            ->join('wp_term_taxonomy', 'wp_terms.term_id', '=', 'wp_term_taxonomy.term_id')
            ->where('wp_term_taxonomy.taxonomy', 'category')
            ->get();

        // Return view with the necessary data
        return view('post', compact('post', 'comments', 'commentsOpen', 'pages', 'recentPosts', 'categories'));
    }

    // Handle comment submissionpublic function postComment(Request $request)
    public function postComment(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'author' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string',
            'comment_post_ID' => 'required|integer'
        ]);

        // Get the current date and time for both comment_date and comment_date_gmt
        $currentDateTime = now();

        // Insert the comment into wp_comments with comment_date_gmt as the same as comment_date
        DB::table('wp_comments')->insert([
            'comment_post_ID' => $request->input('comment_post_ID'),
            'comment_author' => $request->input('author'),
            'comment_author_email' => $request->input('email'),
            'comment_content' => $request->input('comment'),
            'comment_date' => $currentDateTime,  // Set the current local time for comment_date
            'comment_date_gmt' => $currentDateTime->setTimezone('UTC'),  // Set the GMT equivalent time for comment_date_gmt
            'comment_approved' => 1,  // Auto-approve the comment
            'comment_author_IP' => $request->ip(),
            'comment_agent' => $request->header('User-Agent'),
        ]);

        // Redirect back to the post with a success message
        return redirect()->back()->with('success', 'Your comment has been posted successfully!');
    }

}
