<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

use FluentDOM;

/**
 * Description of CommandProcessor
 *
 * @author Christopher
 */
class MessageProcessor
{
    private $Regex = '/moveset|move set/i';

    public function Process($message)
    {
        if (preg_match($this->Regex, $message) !== 1)
        {
            return null;
        }

        $arr = explode(" ", $message);
        $pokemonRepository = new \dal\PokemonRepository();
        $pokemon = $pokemonRepository->GetPokemon($arr[1]);
        if ($pokemon == null)
        {
            return null;
        }

        $api = new \api\GameinfoApi();
        $rawData = $api->GetMoveListData($pokemon);

        $document = FluentDOM::load($rawData, 'text/html');
        $quick = str_replace(chr(194) . chr(160), '', $document
                        ->find("//div[@class='movesets-table'] //div[@class='moves'] //a")
                        ->first()
                        ->text()
        );
        $charge = str_replace(chr(194) . chr(160), '', $document->find("//div[@class='movesets-table'] //div[@class='moves'] //a")
                        ->first()
                        ->next()
                        ->text()
        );

        return array('quick' => trim($quick), 'charge' => trim($charge), 'pokemon' => $pokemon->name);
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
                $closest = $name;
                $shortest = $lev;
            }
        }
        $arguments['ClosestPokemon'] = $closest;
        return $arguments;
    }

}
