<?php

namespace App\Manager;

class ArretInfoManager
{
    public function getData(string $nomArret, int $sens, int $rowsNumber = 10)
    {
        $url = 'https://data.explore.star.fr/api/records/1.0/search/?dataset=tco-metro-circulation-passages-tr&q=&rows=' . $rowsNumber . '&lang=fr&facet=nomcourtligne&facet=sens&facet=destination&facet=nomarret&timezone=Europe%2FParis&facet=precision&refine.precision=Temps+réel&refine.nomarret=' . $nomArret . '&refine.sens=' . $sens;
        $ch = curl_init();

        // Récupérer le contenu de la page
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //Saisir l'URL et la transmettre à la variable.
        curl_setopt($ch, CURLOPT_URL, $url);
        //Exécutez et retourner la requête
        return json_decode(curl_exec($ch));
    }
}