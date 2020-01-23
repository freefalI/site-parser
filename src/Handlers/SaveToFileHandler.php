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
    //TODO : брать путь из конфига
    const reportsFolder = 'reports/';
    /**
     * @param ScrapedData[] $dtos
     */
    public function handle($dtos)
    {
        $file = self::reportsFolder . $this->getDomain() . '.csv';
        file_put_contents($file, '');
        foreach ($dtos as $dto) {
            $string = $dto->getScrapedUrl()->toString();
            $string .= ';';
            foreach ($dto->getFoundData() as $imageUrl) {
                $string .= $imageUrl->toString() . ',';
            }
            $string .= PHP_EOL;
            file_put_contents($file, $string, FILE_APPEND);
        }
    }
}