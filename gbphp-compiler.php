<?php

$config = loadConfig();

runCompile($config);

/**
 * Runs the compiler
 *
 * @param $config
 */
function runCompile($config) {
    if (!$config) {
        echo 'No config provided';
        exit;
    }
    $files = loadFiles($config);

    foreach ($files as $file) {
        compile($file, $config);
    }
}

/**
 * Compile a given file
 *
 * @param $filepath
 */
function compile($filepath, $config) {
    $inputFileInfo = pathinfo($filepath);
    $outputFilePath = str_replace('./', '/', $inputFileInfo['dirname']) . DIRECTORY_SEPARATOR . $inputFileInfo['filename'] . '.php';
    $outputFilePath = str_replace($config->input_dir, $config->output_dir, $outputFilePath);

    $outputFileInfo = pathinfo($outputFilePath);

    $fileContents = htmlspecialchars(file_get_contents($filepath));

    replace($fileContents);

    if (!is_dir($outputFileInfo['dirname'])) {
       mkdir($outputFileInfo['dirname']);
    }

    file_put_contents($outputFilePath, htmlspecialchars_decode($fileContents));
}

/**
 * Replace GBPHP with filthy vanilla PHP
 *
 * @param $ephpContents
 */
function replace(&$ephpContents) {
    $replacements = [
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
        'for each'           => 'merry_go_round',
        // OO
        'class'             => 'upper_class',
        'public'            => 'state',
        'private'           => 'private',
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
        'setcookie'        => 'serve_biscuit',
        // Globals
        '_COOKIE'           => '_BISCUIT',
        '_POST'             => '_ROYAL_MAIL',
        '_SERVER'           => '_BUTLER',
        // Other
        'php'               => 'gbphp',
    ];

    foreach ($replacements as $replacement => $search) {
        $ephpContents = str_replace_outside_quotes($search, $replacement, $ephpContents);
    }
}

/**
 * Load all gbphp files in the input directory
 *
 * @param $config
 * @return array
 */
function loadFiles($config) {
    $iterator = new RecursiveDirectoryIterator($config->input_dir);
    $files = [];
    foreach (new RecursiveIteratorIterator($iterator) as $file)
    {
        $file_bits = explode('.', $file);
        if (in_array(strtolower(array_pop($file_bits)), ['gbphp'])) {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

/**
 * Wrapper for str_replace() to only replace outside of single or double quotes
 *
 * @param $replace
 * @param $with
 * @param $string
 * @return string
 */
function str_replace_outside_quotes($replace, $with, $string){
    $result = "";
    $outside = preg_split('/("[^"]*"|\'[^\']*\')/',$string,-1,PREG_SPLIT_DELIM_CAPTURE);
    while ($outside)
        $result .= str_replace($replace,$with,array_shift($outside)).array_shift($outside);
    return $result;
}

/**
 * Loads GBPHP config from json file
 *
 * @return JSON Object
 */
function loadConfig() {
    $configName = 'gbphp-config.json';

    if (!file_exists($configName)) {
        return false;
    }

    $jsonString = file_get_contents($configName);
    $config = json_decode($jsonString);
    return $config;
}