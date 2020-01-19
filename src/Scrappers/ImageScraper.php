<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:22
 */

namespace SiteParser\Scrappers;

use SiteParser\DTO\ScrapedData;
use SiteParser\DTO\ScrapedImages;
use SiteParser\ValueObjects\Url;

class ImageScraper extends WebPageScraper
{
    /**
     * @param Url $url
     * @param string $html
     * @return ScrapedData
     * @throws \ErrorException
     */
    public function run(Url $url, string $html)
    {
        // TODO: Implement run() method.

        return new ScrapedImages($url, [new Url('789'), new Url('123')]);
    }
}