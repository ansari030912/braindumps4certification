@extends('layouts.app')

@section('main-controller')
    <section class="space">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="row">
                        {{-- Middle Posts --}}
                        <div class="col-xl-4 col-sm-12 border-blog">
                            @foreach ($middlePosts as $post)
                                <div class="blog-style1">
                                    <div class="blog-img">
                                        {{-- Display the post image if available, otherwise use a fallback image --}}
                                        <img src="{{ $post->post_image ?? asset('path/to/fallback-image.jpg') }}"
                                            alt="{{ $post->post_title }}" style="max-width: 100%; height: auto;">
                                        <a data-theme-color="#FF1D50" href="{{ url($post->post_name) }}"
                                            class="category">Popular Exams</a>
                                    </div>
                                    <h3 class="box-title-22">
                                        <a class="hover-line" href="{{ url($post->post_name) }}">{{ $post->post_title }}</a>
                                    </h3>
                                    <div class="blog-meta">
                                        <a href="#"><i class="far fa-user"></i>By Hussnain</a>
                                        <a href="#"><i
                                                class="fal fa-calendar-days"></i>{{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}</a>
                                    </div>
                                    <br>
                                    @if ($post->post_type == 'post')
                                        <p>{{ Str::limit(strip_tags($post->post_content), 70) }}</p>
                                    @endif
                                    <script type="application/ld+json">
                                        {
                                            "@context": "https://schema.org",
                                            "@type": "BlogPosting",
                                            "mainEntityOfPage": {
                                                "@type": "WebPage",
                                                "@id": "{{ url($post->post_name) }}"
                                            },
                                            "headline": "{{ $post->post_title }}",
                                            "url": "{{ url($post->post_name) }}",
                                            "description": "{{ \Illuminate\Support\Str::limit(strip_tags($post->post_content), 160) }}",
                                            "datePublished": "{{ \Carbon\Carbon::parse($post->post_date)->toIso8601String() }}",
                                            "dateModified": "{{ \Carbon\Carbon::parse($post->post_modified ?? $post->post_date)->toIso8601String() }}",
                                            "author": {
                                                "@type": "Person",
                                                "name": "Hussnain",
                                                "url": "{{ url('/') }}"  {{-- Adding the author's URL here --}}
                                            },
                                            "publisher": {
                                                "@type": "Organization",
                                                "name": "Braindumps 4 Certification",
                                                "logo": {
                                                    "@type": "ImageObject",
                                                    "url": "{{ url('assets/img/examprince_logo.png') }}",
                                                    "width": 600,
                                                    "height": 60
                                                }
                                            },
                                            "image": {
                                                "@type": "ImageObject",
                                                "url": "{{ $post->post_image ?? asset('assets/img/default-post-image.png') }}",
                                                "width": 1200,
                                                "height": 628
                                            },
                                            "articleBody": "{!! \Illuminate\Support\Str::limit(strip_tags($post->post_content), 200) !!}"
                                        }
                                        </script>

                                </div>
                            @endforeach
                        </div>

                        {{-- Top Posts --}}
                        <div class="col-xl-8 col-sm-12">
                            @foreach ($topPosts as $post)
                                <div class="blog-style1 style-big">
                                    <div class="blog-img">
                                        {{-- Display the post image if available, otherwise use a fallback image --}}
                                        <img src="{{ $post->post_image ?? asset('path/to/fallback-image.jpg') }}"
                                            alt="{{ $post->post_title }}" style="max-width: 100%; height: auto;">
                                        <a data-theme-color="#FF1D50" href="{{ url($post->post_name) }}"
                                            class="category">Popular Exams</a>
                                    </div>
                                    <h3 class="box-title-30">
                                        <a class="hover-line"
                                            href="{{ url($post->post_name) }}">{{ $post->post_title }}</a>
                                    </h3>
                                    <div class="blog-meta">
                                        <a href="#"><i class="far fa-user"></i>By Hussnain</a>
                                        <a href="#"><i
                                                class="fal fa-calendar-days"></i>{{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}</a>
                                    </div>
                                    <br>
                                    @if ($post->post_type == 'post')
                                        <p>{{ Str::limit(strip_tags($post->post_content), 150) }}</p>
                                    @endif
                                    <script type="application/ld+json">
                                        {
                                            "@context": "https://schema.org",
                                            "@type": "BlogPosting",
                                            "mainEntityOfPage": {
                                                "@type": "WebPage",
                                                "@id": "{{ url($post->post_name) }}"
                                            },
                                            "headline": "{{ $post->post_title }}",
                                            "url": "{{ url($post->post_name) }}",
                                            "description": "{{ \Illuminate\Support\Str::limit(strip_tags($post->post_content), 160) }}",
                                            "datePublished": "{{ \Carbon\Carbon::parse($post->post_date)->toIso8601String() }}",
                                            "dateModified": "{{ \Carbon\Carbon::parse($post->post_modified ?? $post->post_date)->toIso8601String() }}",
                                            "author": {
                                                "@type": "Person",
                                                "name": "Hussnain",
                                                "url": "{{ url('/') }}"  {{-- Adding the author's URL here --}}
                                            },
                                            "publisher": {
                                                "@type": "Organization",
                                                "name": "Braindumps 4 Certification",
                                                "logo": {
                                                    "@type": "ImageObject",
                                                    "url": "{{ url('assets/img/examprince_logo.png') }}",
                                                    "width": 600,
                                                    "height": 60
                                                }
                                            },
                                            "image": {
                                                "@type": "ImageObject",
                                                "url": "{{ $post->post_image ?? asset('assets/img/default-post-image.png') }}",
                                                "width": 1200,
                                                "height": 628
                                            },
                                            "articleBody": "{!! \Illuminate\Support\Str::limit(strip_tags($post->post_content), 200) !!}"
                                        }
                                        </script>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="sec-title has-line">All Posts</h2>
                        </div>
                    </div>
                    <div class="filter-active">
                        {{-- Popular News --}}
                        @foreach ($popularNews as $post)
                            <div class="border-blog2 filter-item cat1">
                                <div class="blog-style4">
                                    <div class="blog-img">
                                        {{-- Display the post image if available, otherwise use a fallback image --}}
                                        <img src="{{ $post->post_image }}" alt="{{ $post->post_title }}"
                                            style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="blog-content">
                                        <h3 class="box-title-24">
                                            <a class="hover-line"
                                                href="{{ url($post->post_name) }}">{{ $post->post_title }}</a>
                                        </h3>
                                        <div class="blog-meta">
                                            <a href="#"><i class="far fa-user"></i>By Hussnain</a>
                                            <a href="#"><i
                                                    class="fal fa-calendar-days"></i>{{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}</a>
                                        </div>
                                        <br>
                                        @if ($post->post_type == 'post')
                                            <p>{{ Str::limit(strip_tags($post->post_content), 150) }}</p>
                                        @endif
                                        <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url($post->post_name) }}"
    },
    "headline": "{{ $post->post_title }}",
    "url": "{{ url($post->post_name) }}",
    "description": "{{ \Illuminate\Support\Str::limit(strip_tags($post->post_content), 160) }}",
    "datePublished": "{{ \Carbon\Carbon::parse($post->post_date)->toIso8601String() }}",
    "dateModified": "{{ \Carbon\Carbon::parse($post->post_modified ?? $post->post_date)->toIso8601String() }}",
    "author": {
        "@type": "Person",
        "name": "Hussnain",
        "url": "{{ url('/') }}"  {{-- Adding the author's URL here --}}
    },
    "publisher": {
        "@type": "Organization",
        "name": "Braindumps 4 Certification",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ url('assets/img/examprince_logo.png') }}",
            "width": 600,
            "height": 60
        }
    },
    "image": {
        "@type": "ImageObject",
        "url": "{{ $post->post_image ?? asset('assets/img/default-post-image.png') }}",
        "width": 1200,
        "height": 628
    },
    "articleBody": "{!! \Illuminate\Support\Str::limit(strip_tags($post->post_content), 200) !!}"
}
</script>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="pagination-wrap" style="padding: 20px 0;">
                        <ul class="pagination">
                            {{ $popularNews->links('pagination::bootstrap-4') }}
                        </ul>
                    </div>
                </div>

                {{-- Sidebar content for Pages, Recent Posts, and Categories --}}
                <div class="col-xl-3 mt-35 mt-xl-0">
                    {{-- Pages --}}
                    <div class="nav tab-menu indicator-active" role="tablist">
                        <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one"
                            type="button" role="tab" aria-controls="nav-one" aria-selected="true">Pages</button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel">
                            <div class="row gy-4">
                                @foreach ($pages as $post)
                                    @if ($post->post_type == 'page')
                                        <div class="col-xl-12 px-4 col-md-6 border-blog">
                                            <div class="blog-style2">
                                                <div class="blog-content">
                                                    <h3 class="box-title-18" style="margin-bottom: 0;">
                                                        <a class="hover-line" href="{{ url($post->post_name) }}">
                                                            {{ $post->post_title }}
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

                    {{-- Recent Posts --}}
                    <div class="mt-4 ml-4">
                        <aside>
                            <div class="widget">
                                <ul style="list-style-type: none; padding: 0;">
                                    @foreach ($recentPosts as $post)
                                        <li class="recent-post-item mb-2"
                                            style="position: relative; overflow: hidden; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(163, 155, 155, 0.1); height: 150px; background-image: url('{{ $post->post_image ?: asset('path/to/static/image.jpg') }}'); background-size: cover; background-position: center;">
                                            <div
                                                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.7);">
                                            </div>
                                            <div
                                                style="position: relative; z-index: 1; padding: 10px; color: white; height: 100%; display: flex; flex-direction: column; justify-content: flex-end;">
                                                <a class="hover-line" href="{{ url($post->post_name) }}"
                                                    style="color: white; text-decoration: none;">
                                                    <b>{{ $post->post_title }}</b>
                                                </a>
                                                <div
                                                    style="display: flex; justify-content: space-between; font-size: 14px;">
                                                    <small><i class="far fa-user pr-1"></i> By Hussnain</small>
                                                    <small><i class="fal fa-calendar-days pr-1"></i>
                                                        {{ \Carbon\Carbon::parse($post->post_date)->format('d M, Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>

                    {{-- Categories --}}
                    <div class="nav tab-menu indicator-active" role="tablist">
                        <button class="tab-btn active" id="nav-one-tab" data-bs-toggle="tab" data-bs-target="#nav-one"
                            type="button" role="tab" aria-controls="nav-one" aria-selected="true">Category</button>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one" role="tabpanel">
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
