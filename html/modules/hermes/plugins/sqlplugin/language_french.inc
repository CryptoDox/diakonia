<?php



define ('_HERSQL_NAME',            'Hermes query SQL');
define ('_HERSQL_PLUGIN_DSC',     'Execution de requete directe pour insertion dans la lettre.');

define ('_HERSQL_HEADER',               'Ent�te de tableau');
define ('_HERSQL_FOOTER',               'Pied de tableau');
define ('_HERSQL_QUERY',               'Requ�te');
define ('_HERSQL_RUPTURE',               "Rupture su 'ORDER BY'");

define ('_HERSQL_HEADER_DSC',               'Afficher en ent�te de tableau dans la lettre');
define ('_HERSQL_FOOTER_DSC',               'Afficher en pied de tableau dans la lettre');
define ('_HERSQL_QUERY_DSC',               'Renvoi les donn�es qui composeront les donn�es du tableau ins�r� dans la lettre.<br>'
                                          .'Important : <b>pr�fixer les tables avec "@."</b>');

//define ('_HERSQL_RUPTURE_DSC',            "Doit correspondre � un (et un seul) champ  de la clause 'SELECT', la 'categorie' par exemple.<br>"
//                                          ."Attention ce sont les allias qu'il faut utiliser (clause 'AS' )<br>"
//                                          ."Si la rupture n'est pas dans la clause 'ORDER BY' elle sera automatiquement ajout�e.");
define ('_HERSQL_RUPTURE_DSC',            "Le premier champ de la clause 'ORDER BY' sera utilis� comme cat�gorie pour effecteur une rupture dans le tableau �sultant dans la lettre");

//---------------------------------------------------------

?>
