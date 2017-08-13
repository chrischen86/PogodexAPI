<?php

namespace dal\models;

/**
 * Description of newPHPClass
 *
 * @author chris
 */
class Pokemon
{
    public $id;
    public $name;
    public $aliases;
    
    public function __construct($id, $name, $aliases=[])
    {
        $this->id = $id;
        $this->name = $name;
        $this->aliases = $aliases;
    }
    
    public function __toString()
    {
        return "$this->id:$this->name";
    }
}
