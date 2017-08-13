<?php

require_once __DIR__ . '/framework' . '/JsonLoader.php';
require_once __DIR__ . '/framework' . '/MessageProcessor.php';
require_once __DIR__ . '/framework' . '/Pokemon.php';

require_once __DIR__ . '/framework/contracts' . '/IDataReader.php';
require_once __DIR__ . '/framework/readers' . '/MovesetReader.php';
require_once __DIR__ . '/framework/readers' . '/UnknownReader.php';
require_once __DIR__ . '/framework/readers' . '/CloseMatchReader.php';

require_once __DIR__ . '/dal/models' . '/Pokemon.php';
require_once __DIR__ . '/dal' . '/PokemonInitializer.php';
require_once __DIR__ . '/dal' . '/PokemonRepository.php';

require_once __DIR__ . '/api' . '/GameinfoApi.php';