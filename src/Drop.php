<?php

namespace SeoTag;

class Drop
{

    private $version = '1.0.0';

    private $tags;

    public function __construct(array $tags)
    {
        $this->tags = $tags;
    }

    public function jsonLd() {
        $phpLd = [];
        if (!empty($this->tags['page']['title'])) {
            $phpLd['name'] = $this->tags['page']['title'];
        }
        if (!empty($this->tags['description'])) {
            $phpLd['description'] = $this->tags['description'];
        }
        $phpLd['@context'] = "http://schema.org";
        $jsonLd = json_encode($phpLd, true);
        return $jsonLd;
    }

    public function render()
    {
        $html = include('template.php');
        return $html;
    }

}