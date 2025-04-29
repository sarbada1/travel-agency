<?php

namespace App\Traits;

trait SeoTrait
{
    protected array $seoData = [];

    // Set Meta Tagse
    public function setMeta($title, $description, $keywords = '')
    {
        $this->seoData['title'] = $title;
        $this->seoData['description'] = $description;
        $this->seoData['keywords'] = $keywords;
    }

    // Set Open Graph Tags
    public function setOpenGraph($type, $url, $image)
    {
        $this->seoData['og:type'] = $type;
        $this->seoData['og:url'] = $url;
        $this->seoData['og:image'] = $image;
    }

    // Get SEO Data for Views
    public function getSeoData()
    {
        return $this->seoData;
    }
}
