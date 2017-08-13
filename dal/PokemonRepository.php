<?php

namespace dal;

/**
 * Description of PokemonRepository
 *
 * @author chris
 */
class PokemonRepository
{
    private $pokemonListByName;
    private $pokemonListById;

    public function __construct()
    {
        $pokemon = PokemonInitializer::InitializePokemon();
        
        foreach ($pokemon as $value)
        {
            $this->pokemonListByName[strtolower($value->name)] = $value;
            $this->pokemonListById[$value->id] = $value;
        }
    }

    public function GetPokemon($name)
    {
        if (is_numeric($name))
        {
            return $this->GetPokemonById($name);
        }
        if (!array_key_exists(strtolower($name), $this->pokemonListByName))
        {
            return null;
        }
        return $this->pokemonListByName[strtolower($name)];
    }

    public function GetPokemonById($id)
    {
        if (!array_key_exists($id, $this->pokemonListById))
        {
            return null;
        }
        return $this->pokemonListById[$id];
    }

}
