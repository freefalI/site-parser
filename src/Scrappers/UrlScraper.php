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

    /**
     * @param Url $url
     * @param string $html
     * @return ScrapedData
     * @throws \ErrorException
     */
    public function run(Url $url, string $html)
    {
        $host = $url->getHost();
        $scheme = $url->getScheme();
        $regex = '/(?:<a[^>]*?href=")([^"]*)|((?:<a[^>]*?href=\')([^\']*))/';
        preg_match_all($regex, $html, $matches);
        $results = [];
        foreach ($matches[1] as $match) {
            if (!$match) continue;
            if ($match == "/") continue;
            $current_url = parse_url($match);
//            print_r($current_url);
//            echo "\n";

            if (isset($current_url['scheme']) && ($current_url['scheme'] == 'http' || $current_url['scheme'] == 'https')) {
                // is absolute url
                //check if home url
//                if(! isset($current_url['path']) || !$current_url['path'] || $current_url['path']=="/"){
//                    continue;
//                }
                if (isset($current_url['host']) && $current_url['host'] != $host) {
                    continue;
                }

            } else {
                $host2 = $host;
                if ($match[0] != "/") {
                    $host2 = $host . '/';
                }
                $match = $scheme . $host2 . $match;
            }
            print_r($match);
            echo "\n";
            try {
                $results[] = new Url($match);

            } catch (\ErrorException $ex) {
            }
        }
        return new ScrapedUrls($url, $results);

    }
}