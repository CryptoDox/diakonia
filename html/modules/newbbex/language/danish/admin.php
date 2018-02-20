<?php
// $ Id: admin.php, mod 1,7 2003/03/05 05:56:22 w4z004 Exp $
// %%%%%% Filnavn index.php %%%%%
// Translated to danish by Michael Albertsen January 22-2009. Visit www.culex.dk

define("_MDEX_A_FORUMCONF", "Forum Configuration");
define("_MDEX_A_ADDAFORUM", "Tilføj et forum");
define("_MDEX_A_LINK2ADDFORUM", "Dette link vil føre dig til en side, hvor du kan tilføje et forum til databasen.");
define("_MDEX_A_EDITAFORUM", "Rediger et forum");
define("_MDEX_A_LINK2EDITFORUM", "Dette link vil give dig mulighed for at redigere et eksisterende forum.");
define("_MDEX_A_SETPRIVFORUM", "Set Private Forum Tilladelser");
define("_MDEX_A_LINK2SETPRIV", "Dette link vil give dig mulighed for at indstille adgang til en eksisterende private forum.");
define("_MDEX_A_SYNCFORUM", "Sync forum / emne index");
define("_MDEX_A_LINK2SYNC", "Dette link vil give dig mulighed for at synkronisere den forum og emne indekserer at fastsætte eventuelle uoverensstemmelser, der måtte opstå");
define("_MDEX_A_ADDACAT", "Tilføj en kategori");
define("_MDEX_A_LINK2ADDCAT", "Dette link vil give dig mulighed for at tilføje en ny kategori til at sætte fora ind.");
define("_MDEX_A_EDITCATTTL", "Redigér en Kategori Titel");
define("_MDEX_A_LINK2EDITCAT", "Dette link vil give dig mulighed for at redigere titlen på en kategori.");
define("_MDEX_A_RMVACAT", "Fjern en kategori");
define("_MDEX_A_LINK2RMVCAT", "Dette link giver dig mulighed for at fjerne alle kategorier fra databasen");
define("_MDEX_A_REORDERCAT", "Re-Order Kategorier");
define("_MDEX_A_LINK2ORDERCAT", "Dette link vil give dig mulighed for at ændre den rækkefølge, som dine kategorier displayet på indeks side");

// %%%%%% Filnavn admin_forums.php %%%%%
define("_MDEX_A_FORUMUPDATED", "Forum Opdateret");
define("_MDEX_A_HTSMHNBRBITHBTWNLBAMOTF", "Men de valgte moderator(e) er ikke fjernet, fordi hvis de havde været det ville der ikke længere være nogen moderatorer på dette forum.");
define("_MDEX_A_FORUMREMOVED", "Forum Fjernet.");
define("_MDEX_A_FRFDAWAIP", "Forum fjernet fra databasen sammen med alle sine stillinger.");
define("_MDEX_A_NOSUCHFORUM", "Intet sådant forum");
define("_MDEX_A_EDITTHISFORUM", "Edit Dette forum");
define("_MDEX_A_DTFTWARAPITF", "Slet dette forum (Dette vil også fjerne alle indlæg i dette forum !)");
define("_MDEX_A_FORUMNAME", "Forum navn:");
define("_MDEX_A_FORUMDESCRIPTION", "Forum Beskrivelse:");

define("_MDEX_A_MODERATOR", "Moderator(e):");
define("_MDEX_A_REMOVE", "Fjern");
define("_MDEX_A_NOMODERATORASSIGNED", "Ingen Moderatorer Tildelte");
define("_MDEX_A_NONE", "Ingen");
define("_MDEX_A_CATEGORY", "Kategori:");
define("_MDEX_A_ANONYMOUSPOST", "Anonym postering");
define("_MDEX_A_REGISTERUSERONLY", "Registrerede brugere");
define("_MDEX_A_MODERATORANDADMINONLY", "Moderatorer / Kun administratorer");
define("_MDEX_A_TYPE", "Type:");
define("_MDEX_A_PUBLIC", "Offentlig");
define("_MDEX_A_PRIVATE", "Privat");
define("_MDEX_A_SELECTFORUMEDIT", "Vælg et forum til Edite");
define("_MDEX_A_NOFORUMINDATABASE", "Nej Forum i Database");
define("_MDEX_A_DATABASEERROR", "Database Error");
define("_MDEX_A_EDIT", "Rediger");
define("_MDEX_A_CATEGORYUPDATED", "Kategori opdateret.");
define("_MDEX_A_EDITCATEGORY", "Redigere Kategori:");
define("_MDEX_A_CATEGORYTITLE", "Kategori Titel:");
define("_MDEX_A_SELECTACATEGORYEDIT", "Vælg en kategori til Edit");
define("_MDEX_A_CATEGORYCREATED", "Kategori oprettet.");
define("_MDEX_A_NTWNRTFUTCYMDTVTEFS", "Note: Dette vil ikke fjerne fora under den kategori, skal du gøre det via Edit Forum sektion.");
define("_MDEX_A_REMOVECATEGORY", "Fjern kategori");
define("_MDEX_A_CREATENEWCATEGORY", "Opret en ny kategori");
define("_MDEX_A_YDNFOATPOTFDYAA", "Du har ikke udfylde alle de dele af skemaet. <br> Har du tildele mindst en moderator? venligst gå tilbage og rette form.");
define("_MDEX_A_FORUMCREATED", "Forum oprettet.");
define("_MDEX_A_VTFYJC", "Se det forum du lige har oprettet.");
define("_MDEX_A_EYMAACBYAF", "Fejl, skal du tilføje en kategori, før du tilføjer fora");
define("_MDEX_A_CREATENEWFORUM", "Opret et nyt forum");
define("_MDEX_A_ACCESSLEVEL", "Access Level:");
define("_MDEX_A_CATEGORYMOVEUP", "Kategori Flyttet Up");
define("_MDEX_A_TCIATHU", "Det er i forvejen den højeste kategori.");
define("_MDEX_A_CATEGORYMOVEDOWN", "Kategori Flyttet Ned");
define("_MDEX_A_TCIATLD", "Det er i forvejen den laveste kategori.");
define("_MDEX_A_SETCATEGORYORDER", "Set Kategori Bestil");
define("_MDEX_A_TODHITOTCWDOTIP", "Den rækkefølge vises her er den rækkefølge, de kategorier vil blive vist på indekset siden. Du kan flytte en kategori op på bestilling Klik på Flyt op for at flytte den ned Klik Flyt ned.");
define("_MDEX_A_ECWMTCPUODITO", "Hvert klik vil flytte kategori 1 plads op eller ned i rækkefølgen.");
define("_MDEX_A_CATEGORY1", "Kategori");
define("_MDEX_A_MOVEUP", "Move Up");
define("_MDEX_A_MOVEDOWN", "Flyt ned");
define("_MDEX_A_FORUMUPDATE", "Forum Indstillinger Opdateret");
define("_MDEX_A_RETURNTOADMINPANEL", "Retur til administrationen Panel.");
define("_MDEX_A_RETURNTOFORUMINDEX", "Vend tilbage til forum indeks");
define("_MDEX_A_ALLOWHTML", "Allow HTML:");
define("_MDEX_A_YES", "Ja");
define("_MDEX_A_NO", "Nej");
define("_MDEX_A_ALLOWSIGNATURES", "Tillad signaturer:");
define("_MDEX_A_HOTTOPICTHRESHOLD", "Hot Topic grænse:");
define("_MDEX_A_POSTPERPAGE", "Poster per side:");
define("_MDEX_A_TITNOPPTTWBDPPOT", "(Det er det antal stillinger pr emne, der vil blive vist per side af et emne)");
define("_MDEX_A_TOPICPERFORUM", "Emner pr Forum:");
define("_MDEX_A_TITNOTPFTWBDPPOAF", "(Det er det antal emner per forum, som vil blive vist per side af et forum)");
define("_MDEX_A_SAVECHANGES", "Gem ændringer");
define("_MDEX_A_CLEAR", "Clear");
define("_MDEX_A_CLICKBELOWSYNC", "Hvis du klikker på knappen nedenfor vil synkronisere dine fora og emner sider med de korrekte data fra databasen. Brug dette afsnit, når du opdager fejl i de emner og fora lister.");
define("_MDEX_A_SYNCHING", "Synkronisering forum indeks og emner (Dette kan tage et stykke tid)");
define("_MDEX_A_DONESYNC", "Gjort!");
define("_MDEX_A_CATEGORYDELETED", "Kategori slettet.");

// %%%%%% Filnavn admin_priv_forums.php %%%%%

define("_MDEX_A_SAFTE", "Vælg et forum til Edit");
define("_MDEX_A_NFID", "Nej Forum i Database");
define("_MDEX_A_EFPF", "Redigere Forum Tilladelser til: <b>%s</ b>");
define("_MDEX_A_UWA", "Brugere med adgang:");
define("_MDEX_A_UWOA", "Brugere uden adgang:");
define("_MDEX_A_ADDUSERS", "Tilføj Brugere -->");
define("_MDEX_A_CLEARALLUSERS", "Ryd alle brugere");
define("_MDEX_A_REVOKEPOSTING", "tilbagekald postering");
define("_MDEX_A_GRANTPOSTING", "tillad postering");

// Ajouts Hervé
define("_MDEX_A_SHOWNAME", "Erstat brugernavnet med rigtige navn");
define("_MDEX_A_SHOWICONSPANEL", "Vis ikonpanel");
define("_MDEX_A_SHOWSMILIESPANEL", "Vis smiliespanel");
define("_MDEX_A_EDITPERMS", "tilladelser");
define("_MDEX_A_CURRENT", "Valgt");
define("_MDEX_A_ADD", "Tilføj");
define("_MDEX_A_SHOWMSGPAGINATION", "Vis meddelelsers sidetal på blokke");
define("_MDEX_A_CANPOST", "Må poste");
define("_MDEX_A_CANTPOST", "Må ikke poste");

// Ajout 1.5
define("_MDEX_A_ALLOW_UPLOAD", "Tillad filer for upload");
?>