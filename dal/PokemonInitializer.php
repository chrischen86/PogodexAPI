<?php

namespace dal;
use dal\models\Pokemon;
/**
 * Description of PokemonInitializer
 *
 * @author chris
 */
class PokemonInitializer
{
    const DefaultPath = "/../data/pokemonList.json";
    
    private static function LoadJson($path)
    {
        $fileContents = file_get_contents(__DIR__ . $path);
        return json_decode($fileContents, true);
    }
    
    public static function InitializePokemon()
    {
        $pokemonList = [];
        $rawData = PokemonInitializer::LoadJson(PokemonInitializer::DefaultPath);
        foreach ($rawData as $key => $value)
        {
            if (!array_key_exists("Number", $value))
            {
                continue;
            }
            array_push($pokemonList, new Pokemon(intval($value["Number"]), $value["Name"]));
        }
        
        return $pokemonList;
    }
}
