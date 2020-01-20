<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:26
 */

namespace SiteParser\Handlers;

use SiteParser\DTO\ScrapedData;

class SaveToFileHandler extends Handler
{
    /**
     * @param ScrapedData[] $dtos
     */
    public function handle($dtos)
    {
        $file = 'reports/' . $this->getDomain();
        foreach ($dtos as $dto) {
            $string = $dto->getScrapedUrl()->getUrl();
            $string .= ';';
            foreach ($dto->getFoundData() as $imageUrl) {
                $string .= $imageUrl->getUrl() . ',';
            }
            $string .= '\n';
            file_put_contents($file, $string, FILE_APPEND);
        }
    }
}