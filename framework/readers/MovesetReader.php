<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

/**
 * Description of OptimalMoveset
 *
 * @author Christopher
 */
class MovesetReader implements \IDataReader {
    private $options;
    public function setOptions($options)
    {
        $this->options = $options;
    }
    
    public function readData($dataSource) {
        $toReturn = array();
        
        $jsonData = json_decode($dataSource, true);
        $nameIndex = $this->getColumnIndex($jsonData, 'Name');
        $metricIndex = $this->getColumnIndex($jsonData, 'Atk Move %');
        $bAttackIndex = $this->getColumnIndex($jsonData, 'Basic Atk');
        $cAttackIndex = $this->getColumnIndex($jsonData, 'Charge Atk');
        
        if ($nameIndex == -1 
            || $metricIndex == -1
            || $bAttackIndex == -1
            || $cAttackIndex == -1)
        {
            return $toReturn;
        }
        $rows = $jsonData['table']['rows'];
        foreach ($rows as $row)
        {
            if ($row['c'][$nameIndex]['v'] === $this->options['Pokemon']
                && $row['c'][$metricIndex]['v'] === 1.0)
            {
                $toReturn['pokemon'] = $this->options['Pokemon'];
                $toReturn['battack'] = $row['c'][$bAttackIndex]['v'];
                $toReturn['cattack'] = $row['c'][$cAttackIndex]['v'];
                return $toReturn;
            }
        }
        return $toReturn;
    }
    
    private function getColumnIndex($jsonData, $columnName)
    {
        $columns = $jsonData['table']['cols'];
        for($i=0; $i<sizeof($columns); $i++)
        {
            if ($columns[$i]['label'] == $columnName)
            {
                return $i;
            }
        }
        return -1;
    }
}
