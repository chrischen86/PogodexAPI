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
    
    $messageProcessor = new \framework\MessageProcessor();
    $reader = $messageProcessor->process($request->get('text'));
    
    $loader = new framework\JsonLoader();
    $data = $loader->LoadJson(framework\JsonLoader::DefaultPath);
    
    $result = $reader->readData($data);
    if ($result == null)
    {
        return new Response('', 200);
    }
    
    if ($reader instanceof framework\CloseMatchReader)
    {
        return new Response(json_encode($result), 200);
    }
    
    $response = array(
        'text' => 'The optimal moveset for _' . $result['pokemon'] 
            . '_ is: \n*' . $result['battack'] . '* \n*' . $result['cattack'] . '*'
    );
    /*
    $response = array(
        'attachments' => array(
            'title' => 'Title',
            'pretext' => 'Pretext test',
            'text' => 'Testing the text',
            'mrkdwn_in' => array(
                'text',
                'pretext'
            )
        )
    );
    */
    $responseString = json_encode($response);
    $responseString = preg_replace('/\\\\\\\n/','\n', $responseString);
    return new Response($responseString, 200);
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