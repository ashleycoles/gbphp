<?php


namespace GBPHP\CommandLine;


class Outputter
{
    public function outputFileChange(string $inputName, string $outputName)
    {
        $message = "Compiled: " . $inputName . ' --> ' . $outputName . PHP_EOL;
        echo $message;
        return $this;
    }
}