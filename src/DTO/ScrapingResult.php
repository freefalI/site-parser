<?php

/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 17:07
 */

namespace SiteParser\DTO;

use SiteParser\ValueObjects\ImageLink;
use SiteParser\ValueObjects\Link;

class ScrapingResult extends DataTransferObject
{

    /**
     * Scraped url:
     *
     * @var Link
     */
    public $scrapedLink;


    /**
     * Lists of found links:
     *
     * @var Link[]
     */
    public $foundLinks;

    /**
     * Lists of found images:
     *
     * @var ImageLink[]
     */
    public $foundImages;

    /**
     * ScrapingResult constructor.
     * @param Link $scrapedLink
     * @param Link[] $foundLinks
     * @param ImageLink[] $foundImages
     */
    public function __construct(Link $scrapedLink, array $foundLinks, array $foundImages)
    {
        $this->scrapedLink = $scrapedLink;
        $this->foundLinks = $foundLinks;
        $this->foundImages = $foundImages;
    }

}