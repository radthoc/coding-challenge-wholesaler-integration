<?php

namespace kollex\Services;

class FileService implements FileServiceInterface
{
    /**
     * @param string $path
     * @return array
     */
    public function getFileContent(string $path): array
    {
        $productArray = [];

        foreach ($this->readTheFile($path) as $row) {
            $productArray[] = str_getcsv($row, ';');
            var_dump($productArray);exit;
        }

        return $productArray;
    }

    /**
     * @param string $path
     * @return iterable
     */
    public function readTheFile(string $path): iterable
    {
        $handle = fopen($path, "r");

        while (!feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFileExtension(string $path): string
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}