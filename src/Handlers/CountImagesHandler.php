<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:26
 */

namespace SiteParser\Handlers;

use SiteParser\DTO\ScrapedData;

class CountImagesHandler extends Handler
{

    /**
     * @param ScrapedData[] $dtos
     * @return mixed
     */
    public function handle($dtos)
    {
        echo "calling CountImagesHandler handler\n";
        $count = 0;
        foreach ($dtos as $dto) {

            foreach ($dto->getFoundData() as $imageUrl) {
                $count++;
            }
        }
        echo "total = " . $count . "\n";
    }
}