<?php
// $ Id: modinfo.php, v 1,12 2003/04/02 04:44:23 mvandam Exp $
// Modul Info
// Translated to danish by Michael Albertsen January 22-2009. Visit www.culex.dk

// Navnet på dette modul
define ( "_MI_NEWBBEX_NAME", "Forum");

// En kort beskrivelse af dette modul
define ( "_MI_NEWBBEX_DESC", "Forum modul for Xoops");

// Navn på blokerer for dette modul (Ikke alle modul har blokke)
define ( "_MI_NEWBBEX_BNAME1", "Seneste Emner");
define ( "_MI_NEWBBEX_BNAME2", "Mest læste emner");
define ( "_MI_NEWBBEX_BNAME3", "Mest aktive emner");
define ( "_MI_NEWBBEX_BNAME4", "Nyere Private Emner");
define ( "_MI_NEWBBEX_BNAME5", "Emner uden svar");
define ( "_MI_NEWBBEX_BNAME6", "Private Emner uden svar");
define ( "_MI_NEWBBEX_BNAME7", "Private og offentlige emner uden svar");
define ( "_MI_NEWBBEX_BNAME8", "Forum statistik");
define ( "_MI_NEWBBEX_BNAME9", "Nyere private og offentlige Emner");
define ( "_MI_NEWBBEX_BNAME10", "månedlig statistikker");
define ( "_MI_NEWBBEX_BNAME11", "Seneste offentlige og private stillinger, siden dit sidste besøg");

// Navn på admin menupunkter
define ( "_MI_NEWBBEX_ADMENU1", "Tilføj Forum");
define ( "_MI_NEWBBEX_ADMENU2", "Edit Forum");
define ( "_MI_NEWBBEX_ADMENU3", "Edit Priv. Forum");
define ( "_MI_NEWBBEX_ADMENU4", "Sync fora / emner");
define ( "_MI_NEWBBEX_ADMENU5", "Tilføj Kategori");
define ( "_MI_NEWBBEX_ADMENU6", "Rediger kategori");
define ( "_MI_NEWBBEX_ADMENU7", "Slet kategori");
define ( "_MI_NEWBBEX_ADMENU8", "Orden kategori");

// RMV-ANMELDE
// Anmeldelse begivenhed beskrivelser og mail-skabeloner

define ( '_MI_NEWBBEX_THREAD_NOTIFY', 'Tråd');
define ( '_MI_NEWBBEX_THREAD_NOTIFYDSC', 'Anmeldelse optioner, der gælder for den nuværende tråd.');

define ( '_MI_NEWBBEX_FORUM_NOTIFY', 'Forum');
define ( '_MI_NEWBBEX_FORUM_NOTIFYDSC', 'Anmeldelse optioner, der gælder for det aktuelle forum.');

define ( '_MI_NEWBBEX_GLOBAL_NOTIFY', 'Global');
define ( '_MI_NEWBBEX_GLOBAL_NOTIFYDSC', 'Global forum anmeldelse valgmuligheder.');

define ( '_MI_NEWBBEX_THREAD_NEWPOST_NOTIFY', 'Ny Post');
define ( '_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYCAP', 'Advisér mig om nye stillinger i de nuværende tråd.');
define ( '_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYDSC', 'få besked, når en ny besked er indsendt til den nuværende tråd.');
define ( '_MI_NEWBBEX_THREAD_NEWPOST_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Nyt indlæg i tråd');

define ( '_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFY', 'ny tråd');
define ( '_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYCAP', 'Advisér mig om nye emner i den aktuelle forum.');
define ( '_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYDSC', 'få besked, når en ny tråd er startet i det aktuelle forum.');
define ( '_MI_NEWBBEX_FORUM_NEWTHREAD_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Ny tråd i forum');

define ( '_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFY', 'Nyt Forum');
define ( '_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYCAP', 'Giv mig besked, når et nyt forum er oprettet.');
define ( '_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYDSC', 'få besked, når et nyt forum er oprettet.');
define ( '_MI_NEWBBEX_GLOBAL_NEWFORUM_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Nyt forum');

define ( '_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFY', 'Ny Post');
define ( '_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYCAP', 'Giv mig besked om eventuelle nye stillinger.');
define ( '_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYDSC', 'få besked, når en ny besked er sendt.');
define ( '_MI_NEWBBEX_GLOBAL_NEWPOST_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Nyt indlæg');

define ( '_MI_NEWBBEX_FORUM_NEWPOST_NOTIFY', 'Ny Post');
define ( '_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYCAP', 'Giv mig besked om eventuelle nye stillinger i de nuværende forum.');
define ( '_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYDSC', 'få besked, når en ny besked er udstationeret i det aktuelle forum.');
define ( '_MI_NEWBBEX_FORUM_NEWPOST_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Nyt indlæg i forum');

define ( '_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFY', 'Ny Post (Fuld Tekst)');
define ( '_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYCAP', 'Giv mig besked om eventuelle nye stillinger (omfatte fuld tekst i beskeden ).');
define ( '_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYDSC', 'Modtagelse fulde tekst meddelelse, når en ny besked er sendt.');
define ( '_MI_NEWBBEX_GLOBAL_NEWFULLPOST_NOTIFYSBJ ',' [(X_SITENAME)] (X_MODULE) auto-anmelder: Nyt indlæg (fuld tekst)');

define ( '_MI_NEWBBEX_SMNAME1', 'Advanceret Søg');
define ( '_MI_NEWBBEX_SHOWMSG', 'Vis private titler og fora?');
define ( '_MI_NEWBBEX_SHOWMSGDESC ',' Når den er sat til noget, kan brugerne se fora og stillinger de ikke har adgang til');

// Indsættes i version 1.5
define ( "_MI_NEWBBEX_ATTACH_FILES", "Mime-typer (vedhæfte filer eller billeder)");
define ( "_MI_NEWBBEX_ATTACH_HLP", "Skriv en mime type per linie");

define ( '_MI_NEWBBEX_UPLSIZE', "MAX Filstørrelse Upload (KB) 1048576 = 1 Meg");
define ( '_MI_NEWBBEX_UPLSIZE_DSC', "i byte");
?>