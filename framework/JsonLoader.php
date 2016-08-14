<?php
namespace framework;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JsonLoader
 *
 * @author Christopher
 */
class JsonLoader {
    const DefaultPath = "../data/json.txt";
    
    public function LoadJson($path)
    {
        $fileContents = file_get_contents($path, FILE_USE_INCLUDE_PATH);
        return $this->TrimJson($fileContents);
    }
    
    private function TrimJson($jsonString)
    {
        $start = strpos($jsonString, '{');
        $originalLength = strlen($jsonString);
        $length = $originalLength - $start - 2;
        return substr($jsonString, $start, $length);
    }
}
