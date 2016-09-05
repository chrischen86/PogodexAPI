<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

/**
 * Description of CloseMatchReader
 *
 * @author Christopher
 */
class CloseMatchReader implements \IDataReader {
    private $options;
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function readData($dataSource) {
        return array('text' => 'Did you mean *' . $this->options['ClosestPokemon'] . '*?');
    }
}
