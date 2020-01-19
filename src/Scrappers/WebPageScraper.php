<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:21
 */

namespace SiteParser\Scrappers;

use SiteParser\ValueObjects\Url;

class  WebPageScraper extends Scraper
{
    /**
     * @param Url $url
     * @param string $html
     * @return void
     */
    public function run(Url $url, string $html)
    {
        // TODO: Implement run() method.
    }

}