<?php
// $Id: main.php,v 1.10 2003/05/02 18:19:43 okazu Exp $
//%%%%%%		Module Name phpBB  		%%%%%
//functions.php
define("_MDEX_ERROR","Eroare");
define("_MDEX_NOPOSTS","Fara Postari");
define("_MDEX_GO","Mergi");

//index.php
define("_MDEX_FORUM","Forum");
define("_MDEX_WELCOME","Bine ai venit pe Forumul %s .");
define("_MDEX_TOPICS","Topicuri");
define("_MDEX_POSTS","Postari");
define("_MDEX_LASTPOST","Ultima Postare");
define("_MDEX_MODERATOR","Moderator");
define("_MDEX_NEWPOSTS","Postari Noi");
define("_MDEX_NONEWPOSTS","Nu sunt postari noi");
define("_MDEX_PRIVATEFORUM","Forum Privat");
define("_MDEX_BY","de"); // Postat de
define("_MDEX_TOSTART","Pentru a viziona mesajele, selecteaza forumul pe care vrei sa`l vizitezi din selectia de mai jos.");
define("_MDEX_TOTALTOPICSC","Total Topicuri: ");
define("_MDEX_TOTALPOSTSC","Total Postari: ");
define("_MDEX_TIMENOW","Data si ora acum %s");
define("_MDEX_LASTVISIT","Ultima ta vizita a fost la: %s");
define("_MDEX_ADVSEARCH","Cautare Avansata");
define("_MDEX_POSTEDON","Postat la: ");
define("_MDEX_SUBJECT","Subiect");

//page_header.php
define("_MDEX_MODERATEDBY","Moderat de");
define("_MDEX_SEARCH","Cautare");
define("_MDEX_SEARCHRESULTS","Rezultatele Cautarii");
define("_MDEX_FORUMINDEX","%s Forum Index");
define("_MDEX_POSTNEW","Postare Mesaj Nou");
define("_MDEX_REGTOPOST","Creaza Cont pentru a Posta");

//search.php
define("_MDEX_KEYWORDS","Cuvinte Cheie:");
define("_MDEX_SEARCHANY","Cautare dupa ORICARE din termeni (Standard)");
define("_MDEX_SEARCHALL","Cautare dupa TOTI termenii");
define("_MDEX_SEARCHALLFORUMS","Cautare in Toare Forumurile");
define("_MDEX_FORUMC","Forum");
define("_MDEX_SORTBY","Sortare dupa");
define("_MDEX_DATE","Data");
define("_MDEX_TOPIC","Topic");
define("_MDEX_USERNAME","Utilizator");
define("_MDEX_SEARCHIN","Cauta in");
define("_MDEX_BODY","Corp");
define("_MDEX_NOMATCH","Nu a fost gasit nimic care sa se potriveasca criteriilor alese de tine.");
define("_MDEX_POSTTIME","Data Postare");

//viewforum.php
define("_MDEX_REPLIES","Raspunsuri");
define("_MDEX_POSTER","Postat de:");
define("_MDEX_VIEWS","Vizite");
define("_MDEX_MORETHAN","Postari Noi [ Popular ]");
define("_MDEX_MORETHAN2","Fara Postari Noi [ Popular ]");
define("_MDEX_TOPICSTICKY","Topic setat Sticky");
define("_MDEX_TOPICLOCKED","Topic Inchis");
define("_MDEX_LEGEND","Legenda");
define("_MDEX_NEXTPAGE","Pagina Urmatoare");
define("_MDEX_SORTEDBY","Sortare dupa");
define("_MDEX_TOPICTITLE","titlu topic");
define("_MDEX_NUMBERREPLIES","numar de raspunsuri");
define("_MDEX_TOPICPOSTER","autor topic");
define("_MDEX_LASTPOSTTIME","data ultimei postari");
define("_MDEX_ASCENDING","Ordine Crescatoare");
define("_MDEX_DESCENDING","Ordine Descrescatoare");
define("_MDEX_FROMLASTDAYS","Din ultimile %s zile");
define("_MDEX_THELASTYEAR","Din ultimul an");
define("_MDEX_BEGINNING","De la inceput");

//viewtopic.php
define("_MDEX_AUTHOR","Autor");
define("_MDEX_LOCKTOPIC","Inchide acest topic");
define("_MDEX_UNLOCKTOPIC","Deschide acest topic");
define("_MDEX_STICKYTOPIC","Seteaza acest topic Sticky");
define("_MDEX_UNSTICKYTOPIC","Seteaza acest topic UnSticky");
define("_MDEX_MOVETOPIC","Muta acest topic");
define("_MDEX_DELETETOPIC","Sterge acest topic");
define("_MDEX_TOP","Top");
define("_MDEX_PARENT","Parent");
define("_MDEX_PREVTOPIC","Topic Precedent");
define("_MDEX_NEXTTOPIC","Urmatorul Topic");

//forumform.inc
define("_MDEX_ABOUTPOST","Despre Postare");
define("_MDEX_ANONCANPOST","Utilizatorii <b>Anonimi</b> pot posta topicuri noi si raspunde in acest forum");
define("_MDEX_PRIVATE","Acesta este un forum <b>Privat</b> .<br />Doar Utilizatorii cu acces special pot posta topicuri noi si raspunde in acest forum");define("_MD_REGCANPOST","Toti utilizatorii <b>Inregistrati</b> pot posta topicuri noi si raspunde in acest forum");
define("_MDEX_MODSCANPOST","Doar <B>Moderatorii si Administratorii</b> pot posta topicuri noi si raspunde in acest forum");
define("_MDEX_PREVPAGE","Pagina Precedenta");
define("_MDEX_QUOTE","Citat");

// ERROR messages
define("_MDEX_ERRORFORUM","EROARE: Forumul nu a fost selectat!");
define("_MDEX_ERRORPOST","EROARE: Postarea nu a fost selectata!");
define("_MDEX_NORIGHTTOPOST","Nu ai dreptul sa postezi in acest forum.");
define("_MDEX_NORIGHTTOACCESS","Nu ai dreptul sa accesezi acest forum.");
define("_MDEX_ERRORTOPIC","EROARE: Topicul nu a fost selectat!");
define("_MDEX_ERRORCONNECT","EROARE: Nu a fost posibila conectarea la baza de date a forumurilor.");
define("_MDEX_ERROREXIST","EROARE: Forumul pe care l`ai selectat nu exista. Te rugam sa incerci din nou.");
define("_MDEX_ERROROCCURED","A Intervenit o Eroare");
define("_MDEX_COULDNOTQUERY","Nu a fost posibila chestionarea bazei de date.");
define("_MDEX_FORUMNOEXIST","Eroare - Forumul/topicul selectat de tine nu exista. Te rugam sa incerci din nou.");
define("_MDEX_USERNOEXIST","Acest utilizator nu exista.  Te rugam sa incerci din nou.");
define("_MDEX_COULDNOTREMOVE","Eroare - Nu a fost posibila stergerea postarilor in baza de date!");
define("_MDEX_COULDNOTREMOVETXT","Eroare - Nu a fost posibila inlaturarea textelor din postari!");

//reply.php
define("_MDEX_ON","la data de"); //Posted on
define("_MDEX_USERWROTE","%s a scris:"); // %s reprezinta username

//post.php
define("_MDEX_EDITNOTALLOWED","Nu ai dreptul sa editezi aceasta postare!");
define("_MDEX_EDITEDBY","Editat de");
define("_MDEX_ANONNOTALLOWED","Utilizatorii Neinregistrati nu au permisiunea de a posta.<br>Te rugam sa te inregistrezi.");
define("_MDEX_THANKSSUBMIT","Multumim pentru contributie!");
define("_MDEX_REPLYPOSTED","A fost postat un raspuns in topicul inceput de tine.");
define("_MDEX_HELLO","Salutare %s,");
define("_MDEX_URRECEIVING","Primesti acest mesaj pentru ca un mesaj postat de tine pe forumul %s a primit un raspuns."); // %s is your site name
define("_MDEX_CLICKBELOW","Apasa legatura web de mai jos pentru a vedea aceasta legatura:");

//forumform.inc
define("_MDEX_YOURNAME","Numele Tau:");
define("_MDEX_LOGOUT","Logout");
define("_MDEX_REGISTER","Creaza Cont");
define("_MDEX_SUBJECTC","Subiect:");
define("_MDEX_MESSAGEICON","Icoana Mesaj:");
define("_MDEX_MESSAGEC","Mesaj:");
define("_MDEX_ALLOWEDHTML","HTML Permis:");
define("_MDEX_OPTIONS","Optiuni:");
define("_MDEX_POSTANONLY","Postare Anonima");
define("_MDEX_DISABLESMILEY","Dezactiveaza Smiley");
define("_MDEX_DISABLEHTML","Dezactiveaza html");
define("_MDEX_NEWPOSTNOTIFY", "Notifica`ma la postari noi in aceasta legatura");
define("_MDEX_ATTACHSIG","Ataseaza Semnatura");
define("_MDEX_POST","Posteaza");
define("_MDEX_SUBMIT","Trimite");
define("_MDEX_CANCELPOST","Anuleaza Postare");

// forumuserpost.php
define("_MDEX_ADD","Adauga");
define("_MDEX_REPLY","Raspunde");

// topicmanager.php
define("_MDEX_YANTMOTFTYCPTF","Nu esti un moderator in acest forum astfel ca nu potzi efectua aceasta actiune.");
define("_MDEX_TTHBRFTD","Acest topic a fost sters din baza de date.");
define("_MDEX_RETURNTOTHEFORUM","Revino pe forum");
define("_MDEX_RTTFI","Revino pe indexul de forum");
define("_MDEX_EPGBATA","Eroare - Te rugam sa incerci din nou.");
define("_MDEX_TTHBM","Topicul a fost mutat.");
define("_MDEX_VTUT","Viziteaza topicul actualizat");
define("_MDEX_TTHBL","Topicul a fost inchis.");
define("_MDEX_TTHBS","Topicul a fost setat Sticky.");
define("_MDEX_TTHBUS","Topicul a fost setat unSticky.");
define("_MDEX_VIEWTHETOPIC","Viziteaza topic");
define("_MDEX_TTHBU","Topicul a fost deschis.");
define("_MDEX_OYPTDBATBOTFTTY","Odata apasat butonul de stergere de la baza acestui forumular, topicul selectat, si toate postarile legate de acesta, vor fi <b>permanent</b> sterse.");
define("_MDEX_OYPTMBATBOTFTTY","Odata apasat butonul de mutare de la baza acestui formular ,topicul selectat, si toate postarile legate de acesta, vor fi mutate in topicul selectat.");
define("_MDEX_OYPTLBATBOTFTTY","Odata apasat butonul de inchidere de la baza acestui formular, topicul selectat va fi inchis. Il poti redeschide oricand doresti.");
define("_MDEX_OYPTUBATBOTFTTY","Odata apasat butonul de deschidere de la baza acestui formular, topicul selectat va fi deschis. Il poti inchide oricand doresti.");
define("_MDEX_OYPTSBATBOTFTTY","Odata apasat butonul de Sticky de la baza acestui formular, topicul selectat va fi setat Sticky. Il poti seta unSticky oricand doresti.");
define("_MDEX_OYPTTBATBOTFTTY","Odata apasat butonul de unSticky de la baza acestui formular, topicul selectat va fi setat unStickyed. Il poti seta Sticky oricand doresti.");
define("_MDEX_MOVETOPICTO","Muta Topic in:");
define("_MDEX_NOFORUMINDB","Nu exista Forumuri in Baza de Date");
define("_MDEX_DATABASEERROR","Eroare de Baza de Date");
define("_MDEX_DELTOPIC","Sterge Topic");

// delete.php
define("_MDEX_DELNOTALLOWED","Daca vezi acest mesaj, inseamna ca nu ai dreptul sa stergi aceasta postare.");
define("_MDEX_AREUSUREDEL","Esti sigur ca vrei sa stergi aceasta postare impreuna cu toate postarile derivate din aceasta?");
define("_MDEX_POSTSDELETED","Postarea selectata si toate postarile derivate au fost sterse.");

// definitions moved from global.
define("_MDEX_THREAD","Legatura");
define("_MDEX_FROM","Din");
define("_MDEX_JOINED","Inregistrat la");
define("_MDEX_ONLINE","Online");
define("_MDEX_BOTTOM","Jos");

// ajout Hervé
define("_MDEX_POSTWITHOUTANSWER","Vezi postare fara raspuns");

// Added version 1.5
define("_MDEX_ATTACH_FILE","Attach File");
define("_MDEX_ATTACHED_FILES","Attached File(s)");
define("_MDEX_UPLOAD_DBERROR_SAVE","Error while attaching file to the story");
define('_MDEX_UPLOAD_ERROR',"Error while uploading the file");
?>