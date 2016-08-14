<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace framework;

/**
 * Description of Pokemons
 *
 * @author Christopher
 */
class Pokemon {
    private static $names = null;
    
    public static function getNames()
    {
        if (self::$names == null)
        {
            self::$names = array(
                "Bulbasaur","Ivysaur","Venusaur",
                "Charmander","Charmeleon","Charizard",
                "Squirtle","Wartortle","Blastoise",
                "Caterpie","Metapod","Butterfree",
                "Weedle","Kakuna","Beedrill",
                "Pidgey","Pidgeotto","Pidgeot",
                "Rattata","Raticate",
                "Spearow","Fearow",
                "Ekans","Arbok",
                "Pikachu","Raichu",
                "Sandshrew","Sandslash",
                "Nidoran F","Nidorina","Nidoqueen",
                "Nidoran M","Nidorino","Nidoking",
                "Clefairy","Clefable",
                "Vulpix","Ninetales",
                "Jigglypuff","Wigglytuff",
                "Zubat","Golbat",
                "Oddish","Gloom","Vileplume",
                "Paras","Parasect",
                "Venonat","Venomoth",
                "Diglett","Dugtrio",
                "Meowth","Persian",
                "Psyduck","Golduck",
                "Mankey","Primeape",
                "Growlithe","Arcanine",
                "Poliwag","Poliwhirl","Poliwrath",
                "Abra","Kadabra","Alakazam",
                "Machop","Machoke","Machamp",
                "Bellsprout","Weepinbell","Victreebel",
                "Tentacool","Tentacruel",
                "Geodude","Graveler","Golem",
                "Ponyta","Rapidash",
                "Slowpoke","Slowbro",
                "Magnemite","Magneton",
                "Farfetch'd",
                "Doduo","Dodrio",
                "Seel","Dewgong",
                "Grimer","Muk",
                "Shellder","Cloyster",
                "Gastly","Haunter","Gengar",
                "Onix",
                "Drowzee","Hypno",
                "Krabby","Kingler",
                "Voltorb","Electrode",
                "Exeggcute","Exeggutor",
                "Cubone","Marowak",
                "Hitmonlee","Hitmonchan",
                "Lickitung",
                "Koffing","Weezing",
                "Rhyhorn","Rhydon",
                "Chansey","Tangela","Kangaskhan",
                "Horsea","Seadra",
                "Goldeen","Seaking",
                "Staryu","Starmie",
                "Mr. Mime","Scyther","Jynx","Electabuzz","Magmar","Pinsir","Tauros",
                "Magikarp","Gyarados",
                "Lapras","Ditto",
                "Eevee","Vaporeon","Jolteon","Flareon",
                "Porygon",
                "Omanyte","Omastar",
                "Kabuto","Kabutops",
                "Aerodactyl","Snorlax",
                "Articuno","Zapdos","Moltres",
                "Dratini","Dragonair","Dragonite",
                "Mewtwo","Mew");
        }
        return self::$names;
    }
}
