<?php
namespace Rickyxstar;

use GuzzleHttp\Client;
use Rickyxstar\UserStats;

class PubgStats {

    //base api url
    const BASE_URI = 'https://api.pubgtracker.com/v2/';

    //api key
    //https://pubgtracker.com/site-api
    protected $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getBaseUri() {
        return static::BASE_URI;
    }

    public function getProfile(string $nickname, array $options = null) {
        $client = new Client(['base_uri' => $this->getBaseUri()]);

        $response = $client->request('GET', 'profile/pc/'.$nickname, array(
            'headers' => [
                'TRN-Api-Key' => $this->apiKey
            ],
            'query' => $options
        ));

        if($response->getStatusCode() == 200) {
            return new UserProfile($response);
        } else {
            throw new Exception("Error: Response code ".$response->getStatusCode());
        }
        
    }

    public function getProfileBySteamID(string $steamID) {
        $client = new Client(['base_uri' => $this->getBaseUri()]);
        
        $response = $client->request('GET', 'search/steam', array(
            'headers' => [
                'TRN-Api-Key' => $this->apiKey
            ],
            'query' => ["steamId" => $steamID]
        ));

        if($response->getStatusCode() == 200) {
            return new UserProfile($response);
        } else {
            throw new Exception("Error: Response code ".$response->getStatusCode());
        }
    }

    public function getMatchHistory(string $accountID) {
        $client = new Client(['base_uri' => $this->getBaseUri()]);
        
        $response = $client->request('GET', 'matches/pc/'.$accountID, array(
            'headers' => [
                'TRN-Api-Key' => $this->apiKey
            ]
        ));

        if($response->getStatusCode() == 200) {
            $json = $response->getBody()->getContents();
            $data = json_decode($json);
            return $data;
        } else {
            throw new Exception("Error: Response code ".$response->getStatusCode());
        }
    }

}