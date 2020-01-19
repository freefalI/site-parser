<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:21
 */

namespace SiteParser\Scrappers;

use SiteParser\DTO\ScrapedData;
use SiteParser\ValueObjects\Url;

abstract class Scraper
{
    /**
     * @param Url $url
     * @param string $html
     * @return ScrapedData
     */
    abstract function run(Url $url, string $html);

}