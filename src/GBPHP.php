<?php

namespace GBPHP;

use GBPHP\Compiler\Config;
use GBPHP\FileSystem\FileLoader;
use GBPHP\Compiler\Compiler;

class GBPHP
{
    /**
     * Holds a config object
     *
     * @var Config
     */
    private $config;

    /**
     * Holds file loader object
     *
     * @var Compiler\FileLoader
     */
    private $fileLoader;

    /**
     * Holds the compiler object
     *
     * @var Compiler
     */
    private $compiler;

    /**
     * GBPHP constructor.
     *
     * @param $config
     *
     * @param $fileLoader
     *
     * @param $compiler
     */
    public function __construct(Config $config, FileLoader $fileLoader, Compiler $compiler)
    {
        $this->config = $config;
        $this->fileLoader = $fileLoader;
        $this->compiler = $compiler;
    }

    /**
     * Responsible for running the compilation process
     */
    public function compile()
    {
        $filesToCompile = $this->fileLoader->loadFiles();
        $this->compiler->runCompiler($filesToCompile);
    }
}