<?php
namespace Seo;

use DateTime;

/**
 * Seo Tag
 */
class Tag
{

    /**
     * PHP SEO Tag version
     *
     * @var string
     */
    private $version = '1.0.0';

    /**
     * Meta tags
     *
     * @var array
     */
    private $tags;

    /**
     * Get tags
     *
     * @param array $tags
     */
    public function __construct(array ...$tags)
    {
        $this->tags = call_user_func_array("array_merge", $tags);
        $this->convertDatesInXmlFormat();
    }

    /**
     * Begin tags
     *
     * @return string
     */
    public function begin() {
        $begin = "<!-- Begin PHP SEO tag v$this->version -->\n";
        return $begin;
    }

    /**
     * End tags
     *
     * @return string
     */
    public function end() {
        $end = "<!-- End PHP SEO tag -->\n";
        return $end;
    }

    /**
     * Create link tag
     *
     * @param string $rel
     * @param string $href
     * @return string
     */
    public function createLink(string $rel, string $href) {
        return "<link rel=\"" . $rel . "\" href=\"" . $href . "\">\n";
    }

    /**
     * Create meta name tag
     *
     * @param string $name
     * @param string $content
     * @return string
     */
    public function createMetaName(string $name, string $content) {
        return "<meta name=\"" . $name . "\" content=\"" . $content . "\" />\n";
    }

    /**
     * Create meta property tag
     *
     * @param string $property
     * @param string $content
     * @return string
     */
    public function createMetaProperty(string $property, string $content) {
        return "<meta property=\"" . $property . "\" content=\"" . $content . "\" />\n";
    }

    /**
     * Create HTML
     *
     * @return void
     */
    public function html() {
        $html = null;
        // Page title
        if (!empty($this->tags['page_title'])) {
            $html .= "<title>" . $this->tags['page_title'] . "</title>\n";
            $html .= $this->createMetaProperty('og:title', $this->tags['page_title']);
        }
        // Generator
        if (!empty($this->tags['generator'])) {
            $html .= $this->createMetaName('generator', $this->tags['generator']);
        }
        // Author
        if (!empty($this->tags['author'])) {
            $html .= $this->createMetaName('author', $this->tags['author']);
        }
        // Lang
        if (!empty($this->tags['lang'])) {
            $html .= $this->createMetaName('og:locale', $this->tags['lang']);
        } else {
            $html .= $this->createMetaName('og:locale', 'en_US');
        }
        // Description
        if (!empty($this->tags['description'])) {
            $html .= $this->createMetaName('description', $this->tags['description']);
            $html .= $this->createMetaProperty('"og:description', $this->tags['description']);
        }
        // URL
        if (!empty($this->tags['url'])) {
            $html .= $this->createMetaProperty('og:url', $this->tags['url']);
            if (!empty($this->tags['canonical_url'])) {
                $html .= $this->createLink('canonical', $this->tags['canonical_url']);
            } else {
                $html .= $this->createLink('canonical', $this->tags['url']);  
            }
        }
        // Site title
        if (!empty($this->tags['site_title'])) {
            $html .= $this->createMetaName('og:site_name', $this->tags['site_title']);
        }
        // Image
        if (!empty($this->tags['image'])) {
            if (is_array($this->tags['image'])) {
                if (!empty($this->tags['image']['path'])) {
                    $html .= $this->createMetaProperty('og:image', $this->tags['url'] . $this->tags['image']['path']);
                    if (!empty($this->tags['image']['height'])) {
                        $html .= $this->createMetaProperty('og:image:height', $this->tags['image']['path']['height']);
                    }
                    if (!empty($this->tags['image']['width'])) {
                        $html .= $this->createMetaProperty('og:image:width', $this->tags['image']['path']['width']);
                    }
                }
            } else {
                $html .= $this->createMetaProperty('og:image', $this->tags['url'] . $this->tags['image']);
            }
        }
        // Date
        if (!empty($this->tags['date'])) {
            $html .= $this->createMetaProperty('og:type', 'article');
            if (is_array($this->tags['date'])) {
                if (!empty($this->tags['date']['published'])) {
                    $html .= $this->createMetaProperty('article:published_time', $this->tags['date']['published']);
                }
            } else {
                $html .= $this->createMetaProperty('article:published_time', $this->tags['date']);
            }
        }
        // Previous and next page
        if (!empty($this->tags['previous_page'])) {
            $html .= $this->createLink('prev', $this->tags['previous_page']);
        }
        if (!empty($this->tags['next_page'])) {
            $html .= $this->createLink('next', $this->tags['next_page']);
        }
        // Twitter
        if (!empty($this->tags['twitter'])) {
            if (!empty($this->tags['image']['path'])) {
                $html .= $this->createMetaName('twitter:card', 'summary_large_image');
            } else {
                $html .= $this->createMetaName('twitter:card', 'summary');
            }
            $html .= $this->createMetaName('twitter:site', $this->tags['twitter']);
            $html .= $this->createMetaName('twitter:creator', $this->tags['twitter']);
        }
        // Facebook
        if (!empty($this->tags['facebook'])) {
            if (!empty($this->tags['facebook']['admins'])) {
                $html .= $this->createMetaProperty('fb:admins', $this->tags['facebook']['admins']);
            }
            if (!empty($this->tags['facebook']['publisher'])) {
                $html .= $this->createMetaProperty('article:publisher', $this->tags['facebook']['publisher']);
            }
            if (!empty($this->tags['facebook']['app_id'])) {
                $html .= $this->createMetaProperty('fb:app_id', $this->tags['facebook']['app_id']);
            }
        }
        // Site verification
        if (!empty($this->tags['google_site_verification']) or !empty($this->tags['webmaster_verifications']['google'])) {
            if (!empty($this->tags['google_site_verification'])) {
                $html .= $this->createMetaName('google-site-verification', $this->tags['google_site_verification']);
            } else {
                $html .= $this->createMetaName('google-site-verification', $this->tags['webmaster_verifications']['google']);
            }
        }
        if (!empty($this->tags['webmaster_verifications']['bing'])) {
            $html .= $this->createMetaName('msvalidate.01', $this->tags['webmaster_verifications']['bing']);
        }
        if (!empty($this->tags['webmaster_verifications']['alexa'])) {
            $html .= $this->createMetaName('alexaVerifyID', $this->tags['webmaster_verifications']['alexa']);
          }
        if (!empty($this->tags['webmaster_verifications']['yandex'])) {
            $html .= $this->createMetaName('yandex-verification', $this->tags['webmaster_verifications']['yandex']);
        }
        return $html;
    }

    /**
     * Convert dates in XML format
     *
     * @return string
     */
    public function convertDatesInXmlFormat() {
        if (!empty($this->tags['date'])) {
            if (is_array($this->tags['date'])) {
                if (!empty($this->tags['date']['published'])) {
                    $this->tags['date']['published'] = date(DateTime::RFC3339, strtotime($this->tags['date']['published']));
                }
                if (!empty($this->tags['date']['modified'])) {
                    $this->tags['date']['modified'] = date(DateTime::RFC3339, strtotime($this->tags['date']['modified']));
                }
            } else {
                $this->tags['date'] = date(DateTime::RFC3339, strtotime($this->tags['date']));
            }
        }
    }

    /**
     * Create jsonLd
     *
     * @return json
     */
    public function jsonLd() {
        $phpLd = [];
        // Name
        if (!empty($this->tags['site_title'])) {
            $phpLd['name'] = $this->tags['site_title'];
        }
        // Description
        if (!empty($this->tags['description'])) {
            $phpLd['description'] = $this->tags['description'];
        }
        // Author
        if (!empty($this->tags['author'])) {
            $phpLd['author'] = [
                '@type' => 'Person',
                'name' => $this->tags['author'],
            ];
        }
        // Website type
        if (!empty($this->tags['type'])) {
            $phpLd['@type'] = $this->tags['type'];
        }
        // URL
        if (!empty($this->tags['url'])) {
            $phpLd['url'] = $this->tags['url'];
        }
        // Image
        if (!empty($this->tags['image'])) {
            if (is_array($this->tags['image'])) {
                if (!empty($this->tags['image']['path'])) {
                    $phpLd['image'] = $this->tags['url'] . $this->tags['image']['path'];
                }
            } else {
                $phpLd['image'] = $this->tags['url'] . $this->tags['image'];
            }
        }
        // Publisher
        if (!empty($this->tags['author'])) {
            $phpLd['publisher'] = [
                '@type' => 'Organization',
                'name' => $this->tags['author'],
            ];
            if (!empty($this->tags['image'])) {
                if (is_array($this->tags['image'])) {
                    if (!empty($this->tags['image']['path'])) {
                        $phpLd['publisher']['logo'] = [
                            '@type' => 'ImageObject',
                            'url' => $this->tags['url'] . $this->tags['image']['path'],
                        ];
                    }
                } else {
                    $phpLd['publisher']['logo'] = [
                        '@type' => 'ImageObject',
                        'url' => $this->tags['url'] . $this->tags['image'],
                    ];
                }
            }
        }
        // Headline
        if (!empty($this->tags['page_title'])) {
            $phpLd['headline'] = $this->tags['page_title'];
        }
        // Date
        if (!empty($this->tags['date'])) {
            if (is_array($this->tags['date'])) {
                if (!empty($this->tags['date']['modified']) and !empty($this->tags['date']['published'])) {
                    $phpLd['dateModified'] = $this->tags['date']['modified'];
                    $phpLd['datePublished'] = $this->tags['date']['published'];
                } else if (!empty($this->tags['date']['modified']) and empty($this->tags['date']['published'])) {
                    $phpLd['dateModified'] = $this->tags['date']['modified'];
                    $phpLd['datePublished'] = $this->tags['date']['modified'];
                } else if (empty($this->tags['date']['modified']) and !empty($this->tags['date']['published'])) {
                    $phpLd['dateModified'] = $this->tags['date']['published'];
                    $phpLd['datePublished'] = $this->tags['date']['published'];
                }
            } else {
                $phpLd['dateModified'] = $this->tags['date'];
                $phpLd['datePublished'] = $this->tags['date'];
            }
        } else {
            $phpLd['dateModified'] = null;
            $phpLd['datePublished'] = null;
        }
        // Same as
        if (!empty($this->tags['social']) and is_array($this->tags['social'])) {
            foreach($this->tags['social'] as $link) {
                $phpLd['sameAs'][] = $link;
            }
        }
        // Main entity of page
        if (!empty($this->tags['type']) AND !empty($this->tags['url'])) {
            $phpLd['mainEntityOfPage'] = [
                '@type' => $this->tags['type'],
                '@id' => $this->tags['url'],
            ];
        }
        // Context
        $phpLd['@context'] = "http://schema.org";
        $jsonLd = json_encode($phpLd, JSON_UNESCAPED_SLASHES);
        return $jsonLd;
    }

    /**
     * Render meta tags
     *
     * @return string
     */
    public function render()
    {
        $render = $this->begin();
        $render .= $this->html();
        $render .= "<script type=\"application/ld+json\">\n" . $this->jsonLd() . "\n</script>\n";
        $render .= $this->end();
        return $render;
    }

}