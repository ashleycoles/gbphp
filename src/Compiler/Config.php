<?php


namespace GBPHP\Compiler;

/**
 * Class Config contains all GBPHP compiler configuration
 *
 * @package GBPHP
 */
class Config
{
    /**
     * Holds the filepath to the gbphp config file.
     *
     * @var string
     */
    protected $configPath = 'gbphp-config.json';

    /**
     * Holds the compilation mode [compile|decompile]
     *
     * @var string
     */
    protected $compileMode;

    /**
     * Holds the input directory - location of files to be compiled
     *
     * @var string
     */
    protected $inputDir;

    /**
     * Holds the output directory - location of compiled files
     *
     * @var string
     */
    protected $outputDir;

    /**
     * File extension of the input files [php|gbphp]
     *
     * @var string
     */
    protected $inputType = 'gbphp';

    /**
     * File extension of the output files [php|gbphp]
     * @var string
     */
    protected $outputType = 'php';

    /**
     * Config constructor - allows config path to be overridden
     *
     * @param string $configPath
     */
    public function __construct(string $configPath = '')
    {
        if ($configPath) {
            $this->configPath = $configPath;
        }
        $this->loadConfig();
    }

    /**
     * @return string
     */
    public function getConfigPath(): string
    {
        return $this->configPath;
    }

    /**
     * @return string
     */
    public function getCompileMode(): string
    {
        return $this->compileMode;
    }

    /**
     * @return string
     */
    public function getInputDir(): string
    {
        return $this->inputDir;
    }

    /**
     * @return string
     */
    public function getOutputDir(): string
    {
        return $this->outputDir;
    }

    /**
     * @return string
     */
    public function getInputType(): string
    {
        return $this->inputType;
    }

    /**
     * @return string
     */
    public function getOutputType(): string
    {
        return $this->outputType;
    }


    /**
     * Loads config from specified config file
     *
     * @return $this
     */
    public function loadConfig()
    {
        if (!file_exists($this->configPath)) {
            throw new Exception("Error: Config file not found.");
        }

        $jsonString = file_get_contents($this->configPath);
        $config = json_decode($jsonString, true);

        $this->compileMode = $config['compile_mode'];
        $this->inputDir = $config[$config['compile_mode']]['input_dir'];
        $this->outputDir = $config[$config['compile_mode']]['output_dir'];

        $this->setFiletypes();

        return $this;
    }

    /**
     * Sets IO filetypes depending on compile mode
     *
     * @return $this
     */
    private function setFiletypes()
    {
        if ($this->compileMode == 'decompile') {
            $this->inputType = 'php';
            $this->outputType = 'gbphp';
        }
        return $this;
    }
}