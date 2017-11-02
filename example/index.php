<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

use SeoTag\Drop as SeoTag;

$params = [
    'page' => [
        'title' => "The title of the page",
        'lang' => 'fr_FR',
    ],
    'description' => "The description of the page",
    'image' => [
        'path' => "https://www.example.com/img/image.jpg",
        'height' => '350',
        'width' => '250',
    ],
    'date' => '2017-11-02',
    'site' => [
        'title' => "The title of the website",
    ],
    'author' => [
        'name' => "The author of the page",
        'twitter' => "fat",
    ],
    'twitter' => [
        'username' => 'jack',
    ],
    'facebook' => [
        'admins' => 'Mark',
        'publisher' => 'Jeanine',
        'app_id' => '123456789',
    ],
    'url' => "https://www.example.com",
    'generator' => "My awesome framework",
    'previous_page' => "https://www.example.com/post/1",
    'next_page' => "https://www.example.com/post/2",
    'webmaster_verifications' => [
        'google' => "123456789",
        'bing' => "123456789",
        'alexa' => "123456789",
        'yandex' => "123456789",
    ],
    'custom' => []
];

$seotag = new SeoTag($params);
$test = $seotag->render();

print_r($test);