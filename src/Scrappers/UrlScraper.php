<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:22
 */

namespace SiteParser\Scrappers;

use SiteParser\DTO\ScrapedData;
use SiteParser\DTO\ScrapedUrls;
use SiteParser\ValueObjects\Url;

class UrlScraper extends WebPageScraper
{
    private $scheme = 'http://';

    /**
     * @param Url $url
     * @param string $html
     * @return ScrapedData
     * @throws \ErrorException
     */
    public function run(Url $url, string $html)
    {
        $host = parse_url($url->getUrl())['host'];
        $regex = '/(?:<a.* href=")(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'\".,<>?«»“”‘’]))/';
        $regex = '/(?:<a.* href=")([^"]*)/';
        if (preg_match_all($regex, $html, $matches)) {
            print_r($matches[1]);
        }
        $results = [];
        foreach ($matches[1] as $match) {
            $current_url = parse_url($match);

            if (isset($current_url['scheme']) && ($current_url['scheme'] == 'http' || $current_url['scheme'] == 'https')) {
                // is absolute url
            } else {
                $match = $this->scheme . $host . '/' . $match;
            }
            $results[] = new Url($match);
        }
        return new ScrapedUrls($url, [new Url('123'), new Url(456)]);

    }
}