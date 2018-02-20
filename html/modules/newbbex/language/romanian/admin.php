<?php
// $Id: admin.php,v 1.7 2003/03/05 05:56:22 w4z004 Exp $
//%%%%%%	File Name  index.php   	%%%%%
define("_MDEX_A_FORUMCONF","Configurare Forum");
define("_MDEX_A_ADDAFORUM","Adauga un Forum");
define("_MDEX_A_LINK2ADDFORUM","Aceasta legatura web te va directiona catre o pagina ce iti permite sa adaugi un forum in baza de date.");
define("_MDEX_A_EDITAFORUM","Editeaza un Forum");
define("_MDEX_A_LINK2EDITFORUM","Aceasta legatura web iti permite sa editezi un forum existent.");
define("_MDEX_A_SETPRIVFORUM","Seteaza Permisiuni Forum Privat");
define("_MDEX_A_LINK2SETPRIV","Aceasta legatura web iti permite sa setezi accesul unui forum privat existent.");
define("_MDEX_A_SYNCFORUM","Sincronizeaza forum/topic index");
define("_MDEX_A_LINK2SYNC","Aceasta legatura iti permite sa sincronizezi indexul de forumuri si topicuri pentru a inlatura orice discrepanta ce poate aparea");
define("_MDEX_A_ADDACAT","Adauga o Categorie");
define("_MDEX_A_LINK2ADDCAT","Aceasta legatura web iti permite sa adaugi o categorie noua de forumuri.");
define("_MDEX_A_EDITCATTTL","Editeaza un Titlu de Categorie");
define("_MDEX_A_LINK2EDITCAT","Aceasta legatura web iti permite sa editezi numele unei categorii.");
define("_MDEX_A_RMVACAT","Sterge o Categorie");
define("_MDEX_A_LINK2RMVCAT","Aceasta legatura web iti permite sa stergi orice categorie din baza de date");
define("_MDEX_A_REORDERCAT","Re-Ordoneaza Categorii");
define("_MDEX_A_LINK2ORDERCAT","Aceasta legatura web iti permite sa schimbi ordinea de afisare a categoriilor pe pagina de index a acestora");

//%%%%%%	File Name  admin_forums.php   	%%%%%
define("_MDEX_A_FORUMUPDATED","Forum Actualizat");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF","Cu toate acestea moderator(ii) selectat(i) pentru ca daca acestia erau acolo nu ar mai fi fost moderatori in acest forum.");
define("_MDEX_A_FORUMREMOVED","Forum Sters.");
define("_MDEX_A_FRFDAWAIP","Forumul a fost sters din baza de date impreuna cu postarile continute de acesta.");
define("_MDEX_A_NOSUCHFORUM","Forum Inexistent");
define("_MDEX_A_EDITTHISFORUM","Editeaza Acest Forum");
define("_MDEX_A_DTFTWARAPITF","Sterge acest forum (Aceasta actiune va inlatura deasemenea si postarile continute de acesta!)");
define("_MDEX_A_FORUMNAME","Nume Forum:");
define("_MDEX_A_FORUMDESCRIPTION","Descriere Forum:");
define("_MDEX_A_MODERATOR","Moderator(i):");
define("_MDEX_A_REMOVE","Sterge");
define("_MDEX_A_NOMODERATORASSIGNED","Nici un Moderator Desemnat");
define("_MDEX_A_NONE","Nici unul");
define("_MDEX_A_CATEGORY","Categorie:");
define("_MDEX_A_ANONYMOUSPOST","Postare Anonima");
define("_MDEX_A_REGISTERUSERONLY","Doar Utilizatori inregistrati");
define("_MDEX_A_MODERATORANDADMINONLY","Doar Moderatori/Administratori");
define("_MDEX_A_TYPE","Tip:");
define("_MDEX_A_PUBLIC","Public");
define("_MDEX_A_PRIVATE","Privat");
define("_MDEX_A_SELECTFORUMEDIT","Selecteaza Forumul pentru Editare");
define("_MDEX_A_NOFORUMINDATABASE","Nu sunt Forumuri in Baza de Date");
define("_MDEX_A_DATABASEERROR","Eroare de Baza de Date");
define("_MDEX_A_EDIT","Editeaza");
define("_MDEX_A_CATEGORYUPDATED","Categorie Actualizata.");
define("_MDEX_A_EDITCATEGORY","Editare Categorie:");
define("_MDEX_A_CATEGORYTITLE","Titlu Categorie:");
define("_MDEX_A_SELECTACATEGORYEDIT","Selecteaza o Categorie pentru Editare");
define("_MDEX_A_CATEGORYCREATED","Categorie Creata.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS","Nota: Aceasta actiune NU va inlatura forumurile continute de aceasta, acest lucru trebuie facut din sectiunea de Editare Forum.");
define("_MDEX_A_REMOVECATEGORY","Sterge Categorie");
define("_MDEX_A_CREATENEWCATEGORY","Creaza o Categorie Noua");
define("_MDEX_A_YDNFOATPOTFDYAA","Nu ai completat toate partile formularului.<br>Ai desemnat cel putin un moderator? Te rugam sa mergi inapoi si sa corectezi formularul.");
define("_MDEX_A_FORUMCREATED","Forum Creat.");
define("_MDEX_A_VTFYJC","Viziteaza forumul pe care tocmai l`ai creat.");
define("_MDEX_A_EYMAACBYAF","Eroare, trebuie sa adaugi o categorie inainte de a incerca sa adaugi un forum nou");
define("_MDEX_A_CREATENEWFORUM","Creaza un Forum Nou");
define("_MDEX_A_ACCESSLEVEL","Nivel Acces:");
define("_MDEX_A_CATEGORYMOVEUP","Categorie Mutata Deasupra");
define("_MDEX_A_TCIATHU","Aceasta este deja cea mai inalta categorie.");
define("_MDEX_A_CATEGORYMOVEDOWN","Categorie Mutata Dedesupt");
define("_MDEX_A_TCIATLD","Aceasta este deja cea mai joasa categorie.");
define("_MDEX_A_SETCATEGORYORDER","Seteaza Ordine Categorie");
define("_MDEX_A_TODHITOTCWDOTIP","Ordinea afisata aici este ordinea categoriilor in care sunt afisate pe pagina de index a acestora. Pentru a muta o categorie mai sus apasa Muta Sus pentru a o muta jos apasa Muta Jos.");
define("_MDEX_A_ECWMTCPUODITO","Fiecare apasare va muta categoria in sus sau in jos cu cate un nivel.");
define("_MDEX_A_CATEGORY1","Categorie");
define("_MDEX_A_MOVEUP","Muta Sus");
define("_MDEX_A_MOVEDOWN","Muta Jos");


define("_MDEX_A_FORUMUPDATE","Setari Forum Actualizate");
define("_MDEX_A_RETURNTOADMINPANEL","Revino la Panoul de Administrare.");
define("_MDEX_A_RETURNTOFORUMINDEX","Revino la pagina de index a forumurilor");
define("_MDEX_A_ALLOWHTML","Permiti HTML:");
define("_MDEX_A_YES","Da");
define("_MDEX_A_NO","Nu");
define("_MDEX_A_ALLOWSIGNATURES","Permiti Semnaturi:");
define("_MDEX_A_HOTTOPICTHRESHOLD","Hot Topic Threshold:");
define("_MDEX_A_POSTPERPAGE","Postari per Pagina:");
define("_MDEX_A_TITNOPPTTWBDPPOT","(Acesta este numarul de postari per topic ce va fi afisat per pagina intr`un topic)");
define("_MDEX_A_TOPICPERFORUM","Topicuri per Forum:");
define("_MDEX_A_TITNOTPFTWBDPPOAF","(Acesta este numarul de topicuri per forum ce va fi afisat per pagina intr`un forum)");
define("_MDEX_A_SAVECHANGES","Salveaza Modificari");
define("_MDEX_A_CLEAR","Anuleaza");
define("_MDEX_A_CLICKBELOWSYNC","Apasand butonul de mai jos se va proceda cu sincronizarea pginilor de forumuri si topicuri pentru corectarea eventualelor discrepante. Foloseste aceasta sectiune cand sesizezi unele erori de afisare in listarea de forumuri si topicuri.");
define("_MDEX_A_SYNCHING","Se efectueaza Sincronizarea de forumuri si topicuri (Aceasta actiune poate dura mult timp)");
define("_MDEX_A_DONESYNC","Efectuat!");
define("_MDEX_A_CATEGORYDELETED","Categorie stearsa.");

//%%%%%%	File Name  admin_priv_forums.php   	%%%%%

define("_MDEX_A_SAFTE","Selecteaza un Forum pentru Editare");
define("_MDEX_A_NFID","Nu sunt Forumuri in Baza de Date");
define("_MDEX_A_EFPF","Editare Permisiuni Forumuri pentru: <b>%s</b>");
define("_MDEX_A_UWA","Utilizatori cu Acces:");
define("_MDEX_A_UWOA","Utilizatori fara Acces:");
define("_MDEX_A_ADDUSERS","Adauga Utilizatori -->");
define("_MDEX_A_CLEARALLUSERS","Anuleaza toti utilizatorii");
define("_MDEX_A_REVOKEPOSTING","revoca postare");
define("_MDEX_A_GRANTPOSTING","asigura postare");

// Ajouts Hervé
define("_MDEX_A_SHOWNAME","Inlocuieste numele de utilizator cu numele real");
define("_MDEX_A_SHOWICONSPANEL","Afisare panou icoane");
define("_MDEX_A_SHOWSMILIESPANEL","Afisare panou smilies");
define("_MDEX_A_EDITPERMS","Permisiuni");
define("_MDEX_A_CURRENT","Curent");
define("_MDEX_A_ADD","Adauga");
define("_MDEX_A_SHOWMSGPAGINATION","afiseaza mesaje de paginare in blocuri");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Allow files to be uploaded");
?>