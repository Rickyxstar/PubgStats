<?php
namespace Rickyxstar;

use GuzzleHttp\Psr7\Response;

class UserProfile {

    public function __construct(Response $response) {
        $json = $response->getBody()->getContents();
        $data = json_decode($json);

        foreach($data as $key => $value) {
            if($key == "stats") {
                $this->raw_stats = $value;
                continue;
            }
            $this->$key = $value;
        }
        
        if(isset($data->stats)) {
            foreach($data->stats as $statsArray) {
                $this->stats[$statsArray->region][$statsArray->season][$statsArray->mode] = new \stdClass;         
                
                foreach($statsArray->stats as $stat) {
                    $this->stats[$statsArray->region][$statsArray->season][$statsArray->mode]->{$stat->field} = $stat->value;
                }

            }
        }
    }

    

}