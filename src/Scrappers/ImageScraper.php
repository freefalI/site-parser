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
    /**
     * @param Url $url
     * @param string $html
     * @return ScrapedData
     * @throws \ErrorException
     */
    public function run(Url $url, string $html)
    {
        echo "\n";
        print_r('images');
        echo "\n";

        $host = $url->getHost();
        $scheme = $url->getScheme();
        $regex = '/(?:<img[^>]*?src=")([^"]*)|((?:<img[^>]*? src=\')([^\']*))/';
        preg_match_all($regex, $html, $matches);
        $results = [];
        foreach ($matches[1] as $match) {
            $current_url = parse_url($match);

            if (isset($current_url['scheme']) && ($current_url['scheme'] == 'http' || $current_url['scheme'] == 'https')) {
                // is absolute url
            } else {
                $match = $scheme . '://' . $host . '/' . $match;
            }
            print_r($match);
            echo "\n";
            try {
                $results[] = new ImageUrl($match);
            } catch (\ErrorException $ex) {
            }
        }


        return new ScrapedUrls($url, $results);
    }
}