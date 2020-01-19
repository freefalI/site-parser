<?php

/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 17:07
 */

namespace SiteParser\DTO;

use SiteParser\ValueObjects\Url;

class ScrapedData extends DataTransferObject
{

    /**
     * Scraped url:
     *
     * @var Url
     */
    public $scrapedUrl;


    /**
     * Lists of found images:
     *
     * @var string[]|Url[]
     */
    public $foundData;

    /**
     * ScrapedData constructor.
     * @param Url $scrapedUrl
     * @param array $foundData
     */
    public function __construct(Url $scrapedUrl, array $foundData)
    {
        $this->scrapedUrl = $scrapedUrl;
        $this->foundData = $foundData;
    }

    /**
     * @return Url
     */
    public function getScrapedUrl()
    {
        return $this->scrapedUrl;
    }

    /**
     * @return Url[]|string[]
     */
    public function getFoundData()
    {
        return $this->foundData;
    }

}