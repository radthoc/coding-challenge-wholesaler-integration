<?php

namespace test\Unit;

use kollex\Services\FileService;
use PHPUnit\Framework\TestCase;

class FileServiceTest extends TestCase
{
    /** @var FileService */
    private $fileService;

    public function setup()
    {
        $this->fileService = new FileService();
    }

    /**
     * Test that the file service generates an iterator to stream the file content
     *
     * @throws \ReflectionException
     */
    public function testReadFileContent()
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'data/wholesaler_a.csv';

        $fileContentIterator = $this->fileService->readTheFile($path);

        $reflectionClass = new \ReflectionClass($fileContentIterator);

        $this->assertTrue(in_array('Iterator', $reflectionClass->getInterfaceNames()));
    }
}
