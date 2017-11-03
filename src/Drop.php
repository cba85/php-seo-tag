<?php
namespace SeoTag;
use DateTime;

/**
 * Seo Tag Drop
 */
class Drop
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
                    $phpLd['image'] = $this->tags['image']['path'];
                }
            } else {
                $phpLd['image'] = $this->tags['image'];
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
                            'url' => $this->tags['image']['path'],
                        ];
                    }
                } else {
                    $phpLd['publisher']['logo'] = [
                        '@type' => 'ImageObject',
                        'url' => $this->tags['image'],
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
     * Include HTML template
     *
     * @return void
     */
    public function includeTemplate() {
        ob_start();
        require('template.php');
        return ob_get_clean();
    }

    /**
     * Render meta tags
     *
     * @return string
     */
    public function render()
    {
        return $this->includeTemplate();
    }

}