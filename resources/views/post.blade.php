@extends('layouts.app')

@section('main-controller')
    <section class="th-blog-wrapper blog-details space-top space-extra-bottom">
        <div class="container">
            <div class="row">
                <!-- Main post content -->
                <div class="col-xxl-9 col-lg-8">
                    <div class="th-blog blog-single">
                        <a data-theme-color="#4E4BD0" href="{{ url('/') }}" class="category"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 512 512">
                                <rect width="512" height="512" fill="none" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="48" d="M244 400L100 256l144-144M120 256h292" />
                            </svg> All Posts</a>
                        <h2 class="blog-title">{{ $post->post_title }}</h2>
                        <div class="blog-meta">
                            <a class="author" href="#"><i class="far fa-user"></i>By - Hussnain</a>
                            <a href="#"><i
                                    class="fal fa-calendar-days"></i>{{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}</a>
                        </div>
                        <div class="blog-content-wrap">
                            <div class="content">
                                {!! $post->post_content !!}
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="th-comments-wrap">
                        <h2 class="blog-inner-title h3">Comments ({{ $comments->count() }})</h2>
                        <ul class="comment-list">
                            @foreach ($comments as $comment)
                                <li class="th-comment-item">
                                    <div class="th-post-comment">
                                        <div class="comment-avater">
                                            <img src="{{ url('assets/img/user.jpg') }}" alt={{ $comment->comment_author }}>
                                        </div>
                                        <div class="comment-content">
                                            <span class="commented-on"><i
                                                    class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($comment->comment_date)->format('d M, Y') }}</span>
                                            <h3 class="name">{{ $comment->comment_author }}</h3>
                                            <p class="text">{{ $comment->comment_content }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Comment Form -->
                    @if ($commentsOpen)
                        <div class="th-comment-form">
                            <div class="form-title">
                                <h3 class="blog-inner-title mb-2">Leave a Comment</h3>
                                <p class="form-text">Your email address will not be published. Required fields are marked *
                                </p>
                            </div>

                            <!-- Display success message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('comment.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="comment_post_ID" value="{{ $post->ID }}">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="text" name="author" placeholder="Your Name*" class="form-control"
                                            required>
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="email" name="email" placeholder="Your Email*" class="form-control"
                                            required>
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="col-12 form-group">
                                        <textarea name="comment" placeholder="Write a Comment*" class="form-control" required></textarea>
                                        <i class="far fa-pencil"></i>
                                    </div>
                                    <div class="col-12 form-group mb-0">
                                        <button type="submit" class="th-btn">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <p class="form-text">Comments are closed for this post.</p>
                    @endif
                </div>

                <!-- Sidebar Content -->
                <div class="col-xxl-3 col-lg-4 sidebar-wrap">
                    <!-- Pages Section -->
                    <div class="nav tab-menu indicator-active" role="tablist">
                        <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one"
                            type="button" role="tab" aria-controls="nav-one" aria-selected="true">Pages</button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                            <div class="row gy-4">
                                @foreach ($pages as $page)
                                    @if ($page->post_type == 'page')
                                        <div class="col-xl-12 px-4 col-md-6 border-blog">
                                            <div class="blog-style2">
                                                <div class="blog-content">
                                                    <h3 class="box-title-18" style="margin-bottom: 0;">
                                                        <a class="hover-line" href="{{ url($page->post_name) }}">
                                                            {{ $page->post_title }}
                                                        </a>
                                                    </h3>
                                                    <hr style="margin-top: 10px; margin-bottom: 0;" />
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Recent Posts Section -->
                    <br>
                    <aside>
                        <div class="widget">
                            <div class="nav tab-menu indicator-active" role="tablist">
                                <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one"
                                    aria-selected="true">Recent Posts</button>
                            </div>
                            <ul style="list-style-type: none; padding: 0;">
                                @foreach ($recentPosts->skip(0)->take(7) as $post)
                                    <li class="recent-post-item mb-2"
                                        style="position: relative; overflow: hidden; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(163, 155, 155, 0.1); height: 150px; background-image: url('{{ extract_first_image($post->post_content) }}'); background-size: cover; background-position: center;">

                                        <!-- Darker overlay -->
                                        <div
                                            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.7);">
                                        </div>

                                        <!-- Content -->
                                        <div
                                            style="position: relative; z-index: 1; padding: 10px; color: white; height: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                                            <a class="hover-line" href="{{ url($post->post_name) }}"
                                                style="color: white; text-decoration: none;">
                                                <b>{{ $post->post_title }}</b>
                                            </a>
                                            <div style="display: flex; justify-content: space-between; font-size: 14px;">
                                                <small><i class="far fa-user pr-1"></i> By Hussnain</small>
                                                <small><i class="fal fa-calendar-days pr-1"></i>
                                                    {{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <!-- Categories Section -->
                    <div class="nav tab-menu indicator-active" role="tablist">
                        <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one"
                            type="button" role="tab" aria-controls="nav-one" aria-selected="true">Category</button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                            aria-labelledby="nav-one-tab">
                            <div class="row gy-4">
                                @foreach ($categories as $category)
                                    <div class="col-xl-12 px-4 col-md-6 border-blog">
                                        <div class="blog-style2">
                                            <div class="blog-content">
                                                <h3 class="box-title-18" style="margin-bottom: 0;">
                                                    <a class="hover-line"
                                                        href="{{ url('/category/' . $category->slug) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </h3>
                                                <hr style="margin-top: 10px; margin-bottom: 0;" />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
