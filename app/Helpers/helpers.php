<?php

function extract_first_image($content) {
    // Use regex to find the first <img> tag
    if (preg_match('/<img[^>]+src="([^">]+)"/', $content, $match)) {
        return $match[1]; // Return the first match (image URL)
    }
    // Return a default image if no image is found in the content
    return 'https://cdn.pixabay.com/photo/2017/05/30/03/58/blog-2355684_640.jpg';
}
