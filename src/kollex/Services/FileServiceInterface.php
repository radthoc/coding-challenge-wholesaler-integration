<?php

namespace kollex\Services;

interface FileServiceInterface
{
    /**
     * @param string $path
     * @return iterable
     */
    public function readTheFile(string $path): iterable;

    /**
     * @param string $path
     * @return string
     */
    public function getFileExtension(string $path): string;
}