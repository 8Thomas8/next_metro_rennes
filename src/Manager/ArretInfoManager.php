<?php
namespace App\Manager;

use GuzzleHttp\Client;

class ArretInfoManager
{
    public function getData(string $nomArret, int $sens)
    {
        $client = new Client();

        $response = $client->get('https://data.explore.star.fr/api/records/1.0/search/?dataset=tco-metro-circulation-passages-tr&q=&lang=fr&facet=nomcourtligne&facet=sens&facet=destination&facet=nomarret&facet=precision&refine.nomarret=' . $nomArret . '&refine.sens=' . $sens);

        return json_decode($response->getBody());
    }
}