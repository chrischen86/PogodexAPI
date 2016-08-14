<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

const SlackToken = 'cc73a853226745e5bd47f0d05ba894e8';
const PokeToken = 'gwLdcEKEkienlms6t44yrNeI';

$app = new Silex\Application();
$app['debug'] = true;
// ... definitions

$app->get('', function() use ($app) {
    $output = '';
    
    $loader = new framework\JsonLoader();
    $output = $loader->LoadJson(framework\JsonLoader::DefaultPath);
    
    //return $app->json($output);
    return $output;
});

$app->post('/pokemon', function(Request $request){
    $username = $request->get('user_name');
    if ($username == 'slackbot')
    {
        return new Response('', 200);
    }
    
    $response = array(
        'text' => $username . ':' . $request->get('text')
    );
    
    return new Response(json_encode($response), 200);
    //return new Response('' . $data['user_name'] . ':' . $data['text'], 200);
});

$app->post('/slack/verify', function(Request $request){
    $data = json_decode($request->getContent(), true);
    if ($data['type'] != 'url_verification')
    {
        return new Response('Wrong type of request', 400);
    }
    if ($data['token'] != SlackToken)
    {
        return new Response('Invalid token', 400);
    }    
    return new Response($data['challenge'], 200);
});


$app->run();
?>