# PHP SEO tag

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

A PHP package inspired by [jekyll-seo-tag](https://github.com/jekyll/jekyll-seo-tag) to add metadata tags for search engines and social networks to better index and display your site's content.

## What it does

PHP SEO Tag adds the following meta tags to your site:

- Page title
- Page description
- Canonical URL
- Next and previous URLs on paginated pages
- [JSON-LD Site and post metadata](https://developers.google.com/search/docs/guides/intro-structured-data) for richer indexing
- [Open Graph](http://ogp.me) title, description, site title, and URL (for Facebook, LinkedIn, etc.)
- [Twitter Summary Card](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started) metadata

PHP SEO tag isn't designed to accommodate every possible use case. It should work for most site out of the box and without a laundry list of configuration options that serve only to confuse most users.

## Installation

You can install the package via composer:

```bash
composer require cba85/php-seo-tag
```

## Usage

```php
use Seo\Tag as Seo;

$tags = []; // Your tags
$seoTag = new Seo($tags);
$seo = $seoTag->render();
```

The package will return the HTML metatags depending of your parameters.

You then just have to display the `$seo` variable.

```php
echo $seo;
```

You'll find an example in the example folder.

### Multiples array

You can pass as parameters how many arrays containing your tags as you want. The package will merge them. It could be useful if you want to separate general tags of your website and specific tags of your page.

```php
$siteTags = []; // General tags of your website
$pageTags = []; // Tags of your page
$seotag = new SeoTag($siteTags, $pageTags);
$seo = $seotag->render();
```

You'll find an example of this in the example folder.

### Tags

The SEO tag will respect any of the following if included the `$tags` array (and simply not include them if they're not defined):

- `site_title` - Your site's title (e.g., My awesome website)

    ```php
    $tags['site_title'] => "The title of the website";
    ```

- `page_title` - Your page's title (e.g., About)

    ```php
    $tags['page_title'] => "The title of the page";
    ```

- `description` - A short description (e.g., A blog dedicated to reviewing cat gifs)

    ```php
    $tags['description'] => "The description of the page";
    ```

- `url` - The full URL to your site.

    ```php
    $tags['url'] => "https://www.example.com";
    ```

- `date` - The date your page was published.

    ```php
    $tags['date'] => "2017-11-05 18:00:00";
    ```

    - `date_modified` and `date_published` - You can manually specify the date modified and date published.

    This field will take first priority for the dateModified JSON-LD output. This is useful when the file timestamp does not match the true time that the content was modified.

    ```php
    $tags['date'] => [
        'published' => "2017-11-02 12:30:00",
        'modified' => "2017-11-03 15:01:00",
    ];
    ```

- `author` - Author name

    ```php
    $tags['author'] => "Clement";
    ```

- `twitter` - The site's Twitter handle.

    ```php
    $tags['twitter'] => "@jack";
    ```

- `facebook` - The following properties are available:
  - `app_id` - a Facebook app ID for Facebook insights
  - `publisher` - a Facebook page URL or ID of the publishing entity
  - `admins` - a Facebook user ID for domain insights linked to a personal account

  You'll want to describe one or more like so:

    ```php
    $tags['facebook'] => [
        'admins' => "Mark",
        'publisher' => "Priscilla",
        'app_id' => "123456789",
    ];
    ```

- `image` - URL to a site-wide logo (e.g., `/assets/img/your-company-logo.png`)

    ```php
    $tags['image'] => "/img/image.jpg";
    ```

    For most users, setting `$tags['image'] => "path-to-image"` on a per-page basis should be enough. If you need more control over how images are represented, the `image` property can also be an object, with the following options:

    * `path` - The relative path to the image. Same as `$tags['image'] => "path-to-image"`
    * `height` - The height of the Open Graph (`og:image`) image
    * `width` - The width of the Open Graph (`og:image`) image

    You can use any of the above, optional properties, like so:

    ```php
    $tags['image'] => [
        'path' => "/img/image.jpg",
        'height' => "350",
        'width' => "250",
    ];
    ```

- `social` - For [specifying social profiles](https://developers.google.com/structured-data/customize/social-profiles).

    ```php
    $tags['social'] => [
            "https://twitter.com/user",
            "https://www.facebook.com/user",
            "https://www.linkedin.com/in/user",
            "https://github.com/user",
            "https://medium.com/@user",
        ];
    ```

- `google_site_verification` for verifying ownership via Google webmaster tools
Alternatively, verify ownership with several services at once using the following format:

    ```php
    $tags['webmaster_verifications'] => [
            'google' => "123456789",
            'bing' => "123456789",
            'alexa' => "123456789",
            'yandex' => "123456789",
        ];
    ```

- `lang` - The locale these tags are marked up in. Of the format `language_TERRITORY`. Default is `en_US`.

    ```php
    $tags['lang'] => "fr_FR";
    ```

-  `type` - The type of things that the page represents. This must be a [Schema.org type](http://schema.org/docs/schemas.html), and will probably usually be something like [`BlogPosting`](http://schema.org/BlogPosting), [`NewsArticle`](http://schema.org/NewsArticle), [`Person`](http://schema.org/Person), [`Organization`](http://schema.org/Organization), etc.

    ```php
    $tags['type'] => "WebSite";
    ```

- `generator` - The generator of your website.

    ```php
     $tags['generator'] => "My awesome framework";
    ```

- `canonical_url` - You can set custom Canonical URL for a page by specifying canonical_url option. If no canonical_url option was specified, then uses page url for generating canonical_url.

    ```php
    $tags['canonical_url'] => "https://www.example.com";
    ```

- `previous_page` and `next_page` - Next and previous URLs on paginated pages.

    ```php
    $tabs['previous_page'] => "https://www.example.com/post/1";
    $tabs['next_page'] => "https://www.example.com/post/2";
    ```

## Testing

No unit test yet.

## Credits

- [cba85](https://github.com/cba85)

## License

Please see [License File](LICENSE.md) for more information.
