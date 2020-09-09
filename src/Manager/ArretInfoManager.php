<?php

namespace App\Manager;

use GuzzleHttp\Client;

class ArretInfoManager
{
    public function getData(string $nomArret, int $sens, int $rowsNumber = 10)
    {
        $client = new Client();

        $response = $client->get('https://data.explore.star.fr/api/records/1.0/search/?dataset=tco-metro-circulation-passages-tr&q=&rows=' . $rowsNumber . '&lang=fr&facet=nomcourtligne&facet=sens&facet=destination&facet=nomarret&timezone=Europe%2FParis&facet=precision&refine.precision=Temps+réel&refine.nomarret=' . $nomArret . '&refine.sens=' . $sens);

        return json_decode($response->getBody());
    }
}