<?php

try {
    $GBPHPCompiler = new GBPHPCompiler();
    $GBPHPCompiler->runCompiler();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

class GBPHPCompiler {
    /**
     * Object holding compiler configuration options.
     *
     * @var JSON Object
     */
    protected $config;

    /**
     * Holds the filepath to the gbphp config file.
     *
     * @var string
     */
    protected $configPath = 'gbphp-config.json';

    /**
     * Holds the array of files due to be compiled.
     *
     * @var Array
     */
    protected $filesToCompile;

    /**
     * Array of searches and replacements
     *
     * @var array
     */
    protected $replacements = [
        '$'                 => '£',
        'echo'              => 'announce',
        'if'                => 'perchance',
        'else'              => 'otherwise',
        'switch'            => 'what_about',
        'case'              => 'perhaps',
        'default'           => 'on_the_off_chance',
        'break'             => 'splendid',
        'try'               => 'would_you_mind',
        'catch'             => 'actually_i_do_mind',
        'die'               => 'perish',
        'exit'              => 'brexit',
        'Exception'         => 'Wobbly',
        'foreach'           => 'merry_go_round',
        // OO
        'class'             => 'upper_class',
        'public'            => 'state',
        'protected'         => 'hereditary',
        // Built in functions
        'str_replace'       => 'string_replace',
        'is_int'            => 'is_integer',
        'var_dump'          => 'variable_dump',
        'preg_match'        => 'perl_regular_expression_match',
        'json_encode'       => 'javascript_object_notation_encode',
        'json_decode'       => 'javascript_object_notation_decode',
        'mysql_connect'     => 'my_structured_query_language_connect',
        'mysqli_connect'    => 'my_structured_query_language_improved_connect',
        'setcookie'         => 'serve_biscuit',
        // Globals
        '_COOKIE'           => '_BISCUIT',
        '_POST'             => '_ROYAL_MAIL',
        '_SERVER'           => '_BUTLER',
        // Other
        'php'               => 'gbphp',
    ];

    /**
     * GBPHPCompiler constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     * Runs the GBPHP compiler
     */
    public function runCompiler()
    {
        $this->loadFiles();

        foreach ($this->filesToCompile as $file) {
            $this->compile($file);
        }
    }

    /**
     * Loads the compiler config file
     *
     * @throws Exception
     */
    protected function loadConfig()
    {
        if (!file_exists($this->configPath)) {
            throw new Exception("Error: Config file not found.");
        }

        $jsonString = file_get_contents($this->configPath);
        $config = json_decode($jsonString, true);

        $compileMode = $config['compile_mode'];


        $this->config['compile_mode'] = $compileMode;
        $this->config['input_dir'] = $config[$config['compile_mode']]['input_dir'];
        $this->config['output_dir'] = $config[$config['compile_mode']]['output_dir'];

        return $this;
    }

    /**
     * Recurisve glob through specified input_dir to generate an array of .gbphp files to be compiled
     *
     * @throws Exception
     */
    protected function loadFiles()
    {
        if (!$this->config) {
            throw new Exception('Error: Config not loaded.');
        }
        $iterator = new RecursiveDirectoryIterator($this->config['input_dir']);
        foreach (new RecursiveIteratorIterator($iterator) as $file)
        {
            $file_bits = explode('.', $file);
            if (in_array(strtolower(array_pop($file_bits)), ['gbphp'])) {
                $this->filesToCompile[] = $file->getPathname();
            }
        }
        return $this;
    }

    /**
     * Run the compiler
     *
     * @param $filepath string pointing to the .gbphp file due to be compiled.
     */
    protected function compile($filepath)
    {
        $inputFileInfo = pathinfo($filepath);

        if (substr($filepath, 0, 3) !== '../') {
            $outputFilePath = str_replace('./', '/', $inputFileInfo['dirname']) . DIRECTORY_SEPARATOR . $inputFileInfo['filename'] . '.php';
        } else {
            $outputFilePath = $inputFileInfo['dirname'] . DIRECTORY_SEPARATOR . $inputFileInfo['filename'] . '.php';
        }

        $outputFilePath = str_replace($this->config['input_dir'], $this->config['output_dir'], $outputFilePath);

        $outputFileInfo = pathinfo($outputFilePath);

        $fileContents = htmlspecialchars(file_get_contents($filepath));

        $this->replace($fileContents);

        if (!is_dir($outputFileInfo['dirname'])) {
            mkdir($outputFileInfo['dirname']);
        }

        file_put_contents($outputFilePath, htmlspecialchars_decode($fileContents));
    }

    /**
     * Runs search and replaces against a .gbphp to 'compile' raw PHP
     *
     * @param string $gbphpContents contents of a .gbphp file for compilation
     * @return $this
     */
    protected function replace(string &$gbphpContents)
    {
        foreach ($this->replacements as $replacement => $search) {
            $gbphpContents = $this->stringReplaceOutsideQuotes($search, $replacement, $gbphpContents);
        }
        return $this;
    }

    /**
     * Wrapper function for str_replace to only replace strings outside of quote characters.
     *
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    protected function stringReplaceOutsideQuotes(string $search,string $replace,string $subject): string
    {
        $result = "";
        $outside = preg_split('/("[^"]*"|\'[^\']*\')/', $subject, -1, PREG_SPLIT_DELIM_CAPTURE);
        while ($outside) {
            $result .= str_replace($search,$replace,array_shift($outside)) . array_shift($outside);
        }
        return $result;
    }
}