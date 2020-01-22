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
use SiteParser\ValueObjects\ImageUrl;
use SiteParser\ValueObjects\Url;

class ImageScraper extends WebPageScraper
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
        $regex = '/(?:<img.* src=")(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'\".,<>?«»“”‘’]))/';
        $regex = '/(?:<img.* src=")([^"]*)/';
        if (preg_match_all($regex, $html, $matches)) {
//            print_r($matches[1]);
        }
        $results = [];
        foreach ($matches[1] as $match) {
            $current_url = parse_url($match);

            if (isset($current_url['scheme']) && ($current_url['scheme'] == 'http' || $current_url['scheme'] == 'https')) {
                // is absolute url
            } else {
                $match = $this->scheme . $host . '/' . $match;
            }
            print_r($match);
            echo "\n";
            $results[] = new ImageUrl($match);
        }


        return new ScrapedUrls($url, $results);
//        return new ScrapedImages($url, [new ImageUrl('789'), new ImageUrl('123')]);
    }
}