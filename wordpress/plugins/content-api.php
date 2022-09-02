<?php
/*
Plugin Name: Content API
Description: Custom Content API endpoints for Vue.js
Version: 0.0.1
*/

add_action( 'rest_api_init', function () {
    register_rest_route( 'content-api/v1', '/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'content_api_get_by_id',
    ) );
} );

add_action( 'rest_api_init', function () {
    register_rest_route( 'content-api/v1', '/(?P<url>.+)', array(
        'methods' => 'GET',
        'callback' => 'content_api_get_post_by_url',
    ) );
} );

function content_api_get_by_id($data) {
    return content_api_get_post_by_id($data['id']);
}

function content_api_get_post_by_url($data) {
    $id = url_to_postid( $data['url'] );

    return content_api_get_post_by_id($id);
}

function content_api_get_post_by_id($id) {
    $post = get_post($id);

    return empty($post) ? new stdClass() : content_api_format_post($post);
}

function content_api_format_post($post) {
    $custom_post = new stdClass();

    if ($post) {
        $custom_post->id = $post->ID;

        $custom_fields = get_fields($custom_post->id, true);

        if ($post->post_type === 'post') {
            $custom_post->author = get_user_by('ID', $post->post_author);
        }

        $custom_post->name = $post->post_name;
        $custom_post->title = $post->post_title;
        $custom_post->type = $post->post_type;
        $custom_post->url = rtrim(str_replace(
            home_url(),
            '',
            get_permalink($post->ID)
        ), '/');

        $custom_post->content = $custom_fields->content || [];
        $custom_post->seo = $custom_fields->seo ?? new stdClass();
    }

    return $custom_post;
}
