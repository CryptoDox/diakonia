<?php
// Oracle Forex Taux Change Devises

// Variables

    $dir = 'cache'; // Repertoire cache local JSON
    $find = '';
	$devise_usd = 'USD';
	$devise_eur = 'EUR';
	// URL de l'API Forex; On précise la devise de référence USD (fichier JSON)
	$url_usd = 'https://api.fixer.io/latest?base=USD'; // path to your JSON file
	// URL de l'API Forex; Référence EUR par défaut (fichier JSON)
	$url_eur = 'https://api.fixer.io/latest'; // path to your JSON file

// Fonction ClearString
function cleanString($string) {
    // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", " ", $string);
    return $string;
}

// UrlEncode Devise de référence pour nomer le cache JSON
$deviseRef = urlencode(cleanString($devise_usd));

// Teste la présence d'un cache
 foreach(glob($dir.'/*.json') as $fichier) {
        if(basename($fichier, '.json') == $deviseRef) {
        $find = $fichier;
    }
}

// embranchement cache ou non
 if($find != '' && (time()-filemtime($find) < 60)) {
	 	// on récupère les données brute dans la variable $raw
        $data = file_get_contents($find);
	 	// variable qui lit et formate les données en objets
        $devises = json_decode($data); // decode the JSON feed
	 
    }else {
        $url = $url_usd;
        $data = file_get_contents($url);
        file_put_contents($dir . '/' . $deviseRef . '.json', $data);
        $devises = json_decode($data);
    }

// URL de l'API Forex; On précise la devise de référence USD (fichier JSON)
// $url = 'https://api.fixer.io/latest?base=USD'; // path to your JSON file

// variable qui récupère les données brute dans une variable
// $data = file_get_contents($url); // put the contents of the file into a variable

// echo $data; // on dé-comente pour tester en affichant le contenu de la variable

// variable qui lit et formate les données en objets
// $devises = json_decode($data); // decode the JSON feed

// On affiche l'objet "base" (devise de référence)
echo $devises->base;
echo "<br />";
// On affiche la date. TODO formater la date en JJ/MM/AAAA
echo $devises->date;
echo "<br />";
// On affiche le taux de la devise
echo $devises->rates->EUR;
echo "<br />";




$deviseRef = urlencode(cleanString($devise_eur));

// Teste la présence d'un cache
 foreach(glob($dir.'/*.json') as $fichier) {
        if(basename($fichier, '.json') == $deviseRef) {
        $find = $fichier;
    }
}

// embranchement cache ou non
 if($find != '' && (time()-filemtime($find) < 60)) {
	 	// on récupère les données brute dans la variable $raw
        $data = file_get_contents($find);
	 	// variable qui lit et formate les données en objets
        $devises = json_decode($data); // decode the JSON feed
	 
    }else {
        $url = $url_eur;
        $data = file_get_contents($url);
        file_put_contents($dir . '/' . $deviseRef . '.json', $data);
        $devises = json_decode($data);
    }

// URL de l'API Forex; Référence EUR par défaut (fichier JSON)
// $url = 'https://api.fixer.io/latest'; // path to your JSON file

// variable qui récupère les données brute dans une variable
// $data = file_get_contents($url); // put the contents of the file into a variable

// echo $data; // on dé-comente pour tester en affichant le contenu de la variable

// variable qui lit et formate les données en objets
// $devises = json_decode($data); // decode the JSON feed
echo "<br />";
// On affiche l'objet "base" (devise de référence)
echo $devises->base;
echo "<br />";
// On affiche la date. TODO formater la date en JJ/MM/AAAA
echo $devises->date;
echo "<br />";
// On affiche le taux de la devise
echo $devises->rates->USD;
echo "<br />";

// ini_set("allow_url_fopen", 1);

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, 'http://diakonia.ddns.net/blockchain/data.json');
// $result = curl_exec($ch);
// curl_close($ch);

// $json = file_get_contents("https://api.fixer.io/latest?base=USD");

// var_dump(json_decode($json));

// $parsed_json = json_decode($json);
// $date_jour = $parsed_json->{"date"};
// $cours_dollar = $parsed_json->{"rates"}->{"EUR"};

// echo "Le ${date_jour} , la cotation de EUR en USD est de ${cours_dollar} %n";

// TEST
// $url = 'http://diakonia.ddns.net/blockchain/data.json'; // path to your JSON file
// $data = file_get_contents($url); // put the contents of the file into a variable
// echo $data;
// $characters = json_decode($data); // decode the JSON feed


// echo "<br />";
// echo $characters[0]->name;
// echo "<br />";
// foreach ($characters as $character) {
// 	echo $character->name . '<br>';
// }

// $url1 = 'http://diakonia.ddns.net/'; // path to your JSON file
// $data1 = file_get_contents($url1); // put the contents of the file into a variable
// echo $data1;

?>