<?php

namespace App\traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

trait ChatGpT
{
    private Client $client;

    /**
     * Gère la réception du tableau de variables à traduire
     * @param array $itemsToTranslate
     * @param string $lang
     * @return array
     */
    public function requestChatGpt(array $itemsToTranslate, string $lang): array
    {
        $arrayT = array();

        foreach ($itemsToTranslate as $key => $content)
        {
            if($content != null) $arrayT [$key] =  $this->askChatGTP($content, $lang);
        }

        return $arrayT;
    }

    /**
     * Retourne la traduction de $content
     * @param string $content
     * @param string $lang
     * @return mixed
     */
    private function askChatGTP(string $content, string $lang): mixed
    {
        $messages = $this->setPrompt($content, $lang);

        $client = new Client();

        try {

            $response = $client->post('https://api.openai.com/v1/chat/completions',
                [
                    'timeout' => 3600,
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('openai.api_key'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => config('openai.model'),
                        "messages" => $messages,
                        "max_tokens" => 4000,
                        "temperature" => 0.8
                    ]
                ]);

            return json_decode( $response->getBody(), true)['choices'][0]['message']['content'];

        }catch (GuzzleException|ClientException|\Exception $exception){
            Log::error('chatgpt guzzle error :'.$exception->getMessage());
            return null;
        }
    }

    /**
     * set le prompt chatGpt pour lancer la traduction du fr -> vers -> $lang ('en' ou 'de')
     * @param string $content
     * @param string $lang
     * @return array[]
     */
    private function setPrompt(string $content, string $lang): array
    {
        return match ($lang){
            'en' => $messages = [
                [ 'role' => 'system', 'content' => 'You are a professional English translator from french, return only the translated word or sentence without any comment'],
                [ 'role' => 'user', 'content' => 'translate in english : '.$content]
            ],

            'de' => $messages = [
                [ 'role' => 'system', 'content' => 'You are a professional German translator from french, return only the translated word or sentence without any comment'],
                [ 'role' => 'user', 'content' => 'translate in german : '.$content]
            ],
        };
    }
}
