<?php


namespace App\Utils\API;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class JsonPlaceHolder
{

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function users()
    {
        $apiEndpoint = 'https://jsonplaceholder.typicode.com/users';

        try {
            $response = (new Client())->request('GET', $apiEndpoint);
        } catch (\Exception $e) {
            throw $e;
        } catch (GuzzleException $e) {
            throw $e;
        }

        return json_decode($response->getBody()->getContents(), false);
    }
}
