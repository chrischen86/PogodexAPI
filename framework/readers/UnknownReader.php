<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

/**
 * Description of UnknownQuery
 *
 * @author Christopher
 */
class UnknownReader implements \IDataReader{
    public function readData($dataSource) {
        return null;
    }

    public function setOptions($options) {        
    }
}
