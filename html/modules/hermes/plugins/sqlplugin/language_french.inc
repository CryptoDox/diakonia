<?php



define ('_HERSQL_NAME',            'Hermes query SQL');
define ('_HERSQL_PLUGIN_DSC',     'Execution de requete directe pour insertion dans la lettre.');

define ('_HERSQL_HEADER',               'Entête de tableau');
define ('_HERSQL_FOOTER',               'Pied de tableau');
define ('_HERSQL_QUERY',               'Requête');
define ('_HERSQL_RUPTURE',               "Rupture su 'ORDER BY'");

define ('_HERSQL_HEADER_DSC',               'Afficher en entête de tableau dans la lettre');
define ('_HERSQL_FOOTER_DSC',               'Afficher en pied de tableau dans la lettre');
define ('_HERSQL_QUERY_DSC',               'Renvoi les données qui composeront les données du tableau inséré dans la lettre.<br>'
                                          .'Important : <b>préfixer les tables avec "@."</b>');

//define ('_HERSQL_RUPTURE_DSC',            "Doit correspondre à un (et un seul) champ  de la clause 'SELECT', la 'categorie' par exemple.<br>"
//                                          ."Attention ce sont les allias qu'il faut utiliser (clause 'AS' )<br>"
//                                          ."Si la rupture n'est pas dans la clause 'ORDER BY' elle sera automatiquement ajoutée.");
define ('_HERSQL_RUPTURE_DSC',            "Le premier champ de la clause 'ORDER BY' sera utilisé comme catégorie pour effecteur une rupture dans le tableau ésultant dans la lettre");

//---------------------------------------------------------

?>
