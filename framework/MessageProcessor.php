<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

/**
 * Description of CommandProcessor
 *
 * @author Christopher
 */
class MessageProcessor {
    private $mappings = array();
    
    function __construct() {
        $this->mappings = array(
            'moveset'   =>  array('/moveset|move set/i', new MovesetReader())
        );
    }
    
    public function process($message)
    {
        foreach($this->mappings as $values)
        {
            $pattern = $values[0];
            if (preg_match($pattern, $message) === 1)
            {
                $reader = $values[1];
                $arguments = $this->buildArguments($message);
                if ($arguments['FindClosest'] && $arguments['Pokemon'] == null)
                {
                    $reader = new CloseMatchReader();
                }
                $reader->setOptions($arguments);
                return $reader;
            }
            
            return new UnknownReader();
        }
    }
    
    private function buildArguments($message)
    {
        $arguments = array();
        $arr = explode(" ", $message);
        $findClosest = sizeof($arr) == 2 && preg_match('/moveset|move set/i', $arr[0]) === 1;
        $shortest = -1;
        $arguments['FindClosest'] = $findClosest;
        
        foreach (Pokemon::getNames() as $name)
        {
            if (stripos($message, $name) !== FALSE)
            {
                $arguments['Pokemon'] = $name;
                break;
            }
            if (!$findClosest)
            {
                continue;
            }

            $lev = levenshtein($arr[1], $name);
            if ($lev <= $shortest || $shortest < 0) 
            {
                $closest  = $name;
                $shortest = $lev;
            }
        }
        $arguments['ClosestPokemon'] = $closest;
        return $arguments;
    }
}
