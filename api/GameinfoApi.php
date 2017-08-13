<?php

namespace api;
use dal\models\Pokemon;

/**
 * Description of GameinfoApi
 *
 * @author chris
 */
class GameinfoApi
{
    private $MoveListUri = 'https://pokemon.gameinfo.io/en/pokemon/movesets';
    public function GetMoveListData(Pokemon $pokemon)
    {
        $uri = $this->MoveListUri . '?id=' . $pokemon->id;
        $response = \Httpful\Request::get($uri)
                ->send();
        
        return $response->body;
    }
}
