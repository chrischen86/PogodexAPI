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
            'moveset'   =>  array('/moveset/i', new MovesetReader())
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
                $reader->setOptions($arguments);
                return $reader;
            }
            
            return new UnknownReader();
        }
    }
    
    private function buildArguments($message)
    {
        $arguments = array();
        foreach (Pokemon::getNames() as $name)
        {
            if (stripos($message, $name) !== FALSE)
            {
                $arguments['Pokemon'] = $name;
                break;
            }
        }
        return $arguments;
    }
}
