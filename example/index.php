<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

use SeoTag\Drop as SeoTag;

/*
 Unique array
*/
$tags = [
    'page_title' => "The title of the page",
    'description' => "The description of the page",
    'image' => "https://www.example.com/img/image.jpg",
    /*
    'image' => [
        'path' => "https://www.example.com/img/image.jpg",
        'height' => "350",
        'width' => "250",
    ],
    */
    'date' => "2017-11-02 12:30:00",
    /*
    'date' => [
        'published' => "2017-11-02 12:30:00",
        'modified' => "2017-11-03 15:01:00",
    ],
    */
    'site_title' => "The title of the website",
    'author' => "Clement",
    'twitter' => [
        'username' => "jack",
    ],
    'facebook' => [
        'admins' => "Mark",
        'publisher' => "Priscilla",
        'app_id' => "123456789",
    ],
    'url' => "https://www.example.com",
    'type' => "WebSite", // or "WebPage" or "BlogPosting"
    'social' => [
        "https://twitter.com/user",
        "https://www.facebook.com/user",
        "https://www.linkedin.com/in/user",
        "https://github.com/user",
        "https://medium.com/@user",
    ],
    'lang' => "fr_FR",
    'generator' => "My awesome framework",
    'google_site_verification' => '123456789',
    'webmaster_verifications' => [
        'google' => "123456789",
        'bing' => "123456789",
        'alexa' => "123456789",
        'yandex' => "123456789",
    ],
    'previous_page' => "https://www.example.com/post/1",
    'next_page' => "https://www.example.com/post/2",
];

$seotag = new SeoTag($tags);
$uniqueArray = $seotag->render();
print_r($uniqueArray);

/*
 Multiples arrays (for site tags and page tags for example)
*/
$siteTags = [
    'date' => "2017-11-02 12:30:00",
    'site_title' => "The title of the website",
    'author' => "Clement",
    'twitter' => [
        'username' => "jack",
    ],
    'facebook' => [
        'admins' => "Mark",
        'publisher' => "Priscilla",
        'app_id' => "123456789",
    ],
    'social' => [
        "https://twitter.com/user",
        "https://www.facebook.com/user",
        "https://www.linkedin.com/in/user",
        "https://github.com/user",
        "https://medium.com/@user",
    ],
    'lang' => "fr_FR",
    'generator' => "My awesome framework",
    'google_site_verification' => '123456789',
    'webmaster_verifications' => [
        'google' => "123456789",
        'bing' => "123456789",
        'alexa' => "123456789",
        'yandex' => "123456789",
    ],
];

$pageTags = [
    'page_title' => "The title of the page",
    'description' => "The description of the page",
    'image' => "https://www.example.com/img/image.jpg",
    'date' => "2017-11-02 12:30:00",
    'url' => "https://www.example.com",
    'type' => "WebSite", // or "WebPage" or "BlogPosting"
    'previous_page' => "https://www.example.com/post/1",
    'next_page' => "https://www.example.com/post/2",
];

$seotag = new SeoTag($siteTags, $pageTags);
$multipleArrays = $seotag->render();
print_r($multipleArrays);