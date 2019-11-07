<?php


namespace GBPHP\FileSystem;


class FileLoader
{
    /**
     * Holds a config object
     *
     * @var Config
     */
    private $config;

    /**
     * Holds an array of files due to be compiled
     *
     * @var array
     */
    private $filesToCompile = [];

    /**
     * FileLoader constructor
     *
     * @param $config
     */
    public function __construct(\GBPHP\Compiler\Config $config)
    {
        $this->config = $config;
    }

    /**
     * Loads a list of files due to be compiled
     *
     * @return array
     */
    public function loadFiles()
    {
        $iterator = new \RecursiveDirectoryIterator($this->config->getInputDir());

        foreach (new \RecursiveIteratorIterator($iterator) as $file)
        {
            $file_bits = explode('.', $file);
            if (in_array(strtolower(array_pop($file_bits)), [$this->config->getInputType()])) {
                $this->filesToCompile[] = $file->getPathname();
            }
        }
        return $this->filesToCompile;
    }
}