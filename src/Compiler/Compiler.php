<?php


namespace GBPHP\Compiler;


class Compiler
{
    /**
     * Holds a config object
     *
     * @var Config
     */
    private $config;

    private $outputter;

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
        'in_array'          => 'does_the_array_contain',
        // Globals
        '_COOKIE'           => '_BISCUIT',
        '_POST'             => '_ROYAL_MAIL',
        '_SERVER'           => '_BUTLER',
        // Other
        'php'               => 'gbphp',
    ];

    /**
     * Compiler constructor
     *
     * @param $config
     *
     * @param $outputter
     */
    public function __construct(\GBPHP\Compiler\Config $config, \GBPHP\CommandLine\Outputter $outputter)
    {
        $this->config = $config;
        $this->outputter = $outputter;

        if ($this->config->getCompileMode() == 'decompile') {
            $this->replacements = array_flip($this->replacements);
        }
    }

    /**
     * Runs the compiler
     *
     * @param array $files
     *
     * @return $this
     */
    public function runCompiler(array $files)
    {
        foreach ($files as $file) {
            $this->compile($file);
        }
        return $this;
    }

    /**
     * Compiles individual files
     *
     * @param string $filepath
     *
     * @return $this
     */
    private function compile(string $filepath)
    {
        $inputInfo = pathinfo($filepath);

        if (substr($filepath, 0, 3) !== '../') {
            $outputPath = str_replace('./', '/', $inputInfo['dirname']) . DIRECTORY_SEPARATOR . $inputInfo['filename'] . '.' . $this->config->getOutputType();
        } else {
            $outputPath = $inputInfo['dirname'] . DIRECTORY_SEPARATOR . $inputInfo['filename'];
        }

        $outputPath = str_replace($this->config->getInputDir() . DIRECTORY_SEPARATOR, $this->config->getOutputDir() . DIRECTORY_SEPARATOR, $outputPath);

        $outputInfo = pathinfo($outputPath);

        $fileContents = htmlspecialchars(file_get_contents($filepath));

        $this->replace($fileContents);

        if (!is_dir($outputInfo['dirname'])) {
            mkdir($outputInfo['dirname']);
        }

        try {
            file_put_contents($outputPath, htmlspecialchars_decode($fileContents));
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

        $this->outputter->outputFileChange($filepath, $outputPath);

        return $this;
    }

    /**
     * Performance search and replaces on the input file contents based on the $replacements array
     *
     * @param string $fileContents
     *
     * @return $this
     */
    private function replace(string &$fileContents)
    {
        foreach ($this->replacements as $replacement => $search) {
            $fileContents = $this->stringReplaceOutsideQuotes($search, $replacement, $fileContents);
        }
        return $this;
    }

    /**
     * Wrapper function for str_replace to only replace strings outside of quote characters.
     *
     * @param string $search
     *
     * @param string $replace
     *
     * @param string $subject
     *
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