


var count     = 0;
var idCession = 0;
var idLettre  = 0;
var sUrl      = ""; 
var etape     = 0;
var etapeName = "Etape";
var borneMax  = 0;
var toDo      = -1;
var nbFaits   = 0;
var resultat  = "???";
var sep = ":";

var h = 0
var etape_initCession    = h++;
var etape_registry_info  = h++;
var etape_registry       = h++;
var etape_complementaire = h++;
var etape_send_info      = h++;
var etape_send           = h++;
var etape_end            = h++;
var etape_endBatch       = h++;

var delai  = 100;
var delai1 = 100;
var delai2 = 200;



/*

  case 'getInfoEtape_userRegistry':
     $message = etape_registry.";".getUserRegistry();
     
  case 'build_userRegistry':
*/
/***********************************************************************
 *
************************************************************************/
function startProgressBar(sHrefRoot, lDelai1, lDelai2) {

  delai1 = lDelai1;
  delai2 = lDelai2;
  delai  = delai1;

  //if (sHrefRoot <> "") {sUrl = sHrefRoot;} 
  

   //alert ("obBtn : " + obBtn.name + " - " + obBtn.width);
   //obTxt = document.getElementById("txtProgress");  
   //alert ("obTxt : " + obTxt.name + " - " + obTxt.width);
  etape = 0;
  sUrl = sHrefRoot;
  
  obBtn = document.getElementById("btnBrogress");
  obBtn.style.visibility = 'hidden';  
  
  ProgressBar();
}

/***********************************************************************
 *
************************************************************************/
function stopProgressBar(sTitle) {
  etape = 99;
  etapeName = sTitle;

}

/***********************************************************************
 *
************************************************************************/

function ProgressBar() {
var   obBtn = document.getElementById("btnBrogress");
var   obPic0 = document.getElementById("picBrogress0");
var   obPic1 = document.getElementById("picBrogress1");   
var   obTxt = document.getElementById("txtProgress"); 
var   obIdLettre = document.getElementById("idLettre");     


   count=count+1;
//alert ("la");   
   idLettre = obIdLettre.value;
   
   //obPic.width = 2 * count;
   //lw = Math.round(360 / 100 * count);
   //lw = 360; // 
   //obTd = document.getElementById("tdBrogress");   
   lw = obPic0.width + obPic1.width;
   
   fait = borneMax-toDo
   if (fait > borneMax) fait = borneMax ;
   count =  Math.round(fait / borneMax * 100);   
   obPic0.width = lw * count /100 //obTxt.width / 100 * count; 
   obPic1.width = lw - obPic0.width;   

   //obBtn.value=resultat;        
   
   
   obTxt.value = etape + "-" + etapeName + ' : ' + count + '%' 
               + " - " + fait + "/" + borneMax;
   
  //---------------------------------------------------------  
  switch (etape){
    
    case etape_initCession:
      nbFaits = 0;
      //alert (sUrl);
      idCession = initCession(idLettre);
      //alert ("idCession = " + idCession);
      etape++ ;
      toDo = -1;
      
      break;
    //------------------------------------------------------      
    case etape_registry_info:
      getInfoEtape_userRegistry();
      etape++ ;
      toDo = -1;
      
      //alert("etape " + etapeName + " = " + etape + " | borneMax = " + borneMax);

      break;
    //------------------------------------------------------      
    case etape_registry:
       if (toDo == 0) {
          etape++ ;  
          toDo = -1;                
      }else{
           build_userRegistry(idCession);       
      }
      //etape = etape_end;    
      break;
   
    //------------------------------------------------------
    case etape_complementaire:
      //alert("etape_complementaire");
      if (toDo == 0) {
          etape++ ;  
          toDo = -1;                
      }else{
           buildListeComplementaire(idCession);       
      }
      break;
    //------------------------------------------------------
    case etape_send_info:
      totalMails(idCession);
      nbFaits = 0;
      etape++ ;  
      toDo = -1;
      delai = delai2;
      break;          
    //------------------------------------------------------    
    case etape_send:
    
    /*

      alert("etape_send : toDo = " + toDo 
            + " - nbFaits = " + nbFaits 
            + " - borneMax = " + borneMax);      
    */
      if (toDo == 0) {
      //alert("etape_send : Fin");      
          etape++ ;     
          toDo = -1;  
          //alert ("delai = " + delai);           
      }else{
      /*
      */
           sendLetter(idCession);       
      }
      //-------------------------------------------
       //if (nbFaits >= borneMax){
       /*

       if (toDo <= 0){        
       //alert ("blabla");
        toDo = -1;      
        nbFaits = borneMax;
          etape++ ;        
       }
       */      
      break;
    
    //------------------------------------------------------    
    case etape_end:
       //alert('Traitement presque terminé');
       options = geResult ("getInfoEtape_end", "", false);        
       etapeName = options[0];
       etape++ ;    
      break;
      
    //------------------------------------------------------    
    case etape_endBatch:
       //alert('Traitement terminé');
       //etapeName = "********** END **********";
       options = geResult ("Etape_endBatch", "", false);   
       obTxt.value = options[0];  
       //etapeName = options[0];  
       obBtn.style.visibility = 'hidden';
       //obPic0.style.visibility = 'hidden';
       etape++ ;    
      break;
      
  }

  if (etape <= etape_endBatch) {setTimeout('ProgressBar()', delai);}
}


/***********************************************************************
 *
************************************************************************/
function initCession(idLettre) {

  //sHref = sUrl + "?op=initCession" + "&idLettre=" + idLettre;
  options = geResult ("initCession", "", false); 

      etapeName  = options[0]; 
      lidCession = options[1];   
      borneMax   = options[2];         
      return lidCession;

}

/***********************************************************************
 *
************************************************************************/
function getInfoEtape_userRegistry(idCession) {

  //sHref = sUrl + "?op=getInfoEtape_userRegistry" + "&idCession=" + idCession;

  options = geResult ("getInfoEtape_userRegistry", "", false);
  borneMax  = options[1];
  etapeName = options[0];
  
  //alert ("getInfoEtape_userRegistry : nbUser = " + borneMax);  
  
//toDo = 0;
  //alert("etape = " + etape);
}


/***********************************************************************
 *
************************************************************************/
function build_userRegistry(idCession) {
  //alert("build_userRegistry : nbFaits = " + 999);
  //sHref = sUrl + "?op=getInfoEtape_userRegistry" + "&idCession=" + idCession;
  //alert (sHref);
  
  
   params  = "&first=" + nbFaits + "&lot=0";
   options = geResult ("build_userRegistry", params, false);
   nbFaits    = 1 * options[1];
   borneMax = 1 * borneMax;

/*   
  alert("build_userRegistry : nbFaits = " + nbFaits 
      + " - bornemax = " + borneMax 
      + " - options = " +  options[1]);   

*/      
   if (nbFaits > borneMax){nbFaits = borneMax;}
   toDo = borneMax - nbFaits;

  //etapeName = options[0];
  //alert("build_userRegistry : nbFaits = " + nbFaits + " - bornemax = " + borneMax);
}





/***********************************************************************
 *
************************************************************************/
function buildListeComplementaire(lidCession) {

  //sHref = sUrl + "?op=buildList2" + "&idCession=" + idCession;
  //alert (sHref);
  options = geResult ("buildList2", "", false);
  
  etapeName = options[0];
  toDo      = options[1];  
  borneMax  = options[2];

//toDo = 0;
  //alert("etape = " + etape);
}

/***********************************************************************
 *
************************************************************************/
function totalMails(lidCession) {
  //alert("etape = " + etape);
  
  //sHref = sUrl + "?op=totalMails" + "&idCession=" + idCession;
  options = geResult ("totalMails", "", false);
  etapeName = options[0];  
  borneMax  = options[2];
  toDo      = options[2];
  
  //idCession      = options[1];  
  //alert("totalMails = " + borneMax + "-" + options[0] + "-" +  options[1] );  


}
/***********************************************************************
 *
************************************************************************/
function sendLetter(lidCession) {
//obName: checkBox composer d'un prefixe et d'un idenfiant (idSeealso) ex: chk_999
//isToChange: idTerme de 'expression representee par la checkBox
//sHref: adresse de la page … r‚aficher
  //alert("etape = " + etape);  
  //sHref = sUrl + "?op=sendLot" + "&idCession=" + lidCession; 

  options = geResult ("sendLot", "&first=" + nbFaits, false); 
      //if (idCession == 0) idCession = options[0];
      nbFaits  = 1 * options[1];
      borneMax = 1 * borneMax;
      
      if (nbFaits >= borneMax){
        toDo = 0;      
        nbFaits = borneMax;
      }else{
        toDo = borneMax - nbFaits;      
      }


  //alert ("sendLetter : first = " + nbFaits + " - toDo = "  + toDo);
  
   //obTxt = document.getElementById("txtProgress");      
   //obTxt.value=resultat;
      //document.write(resultat) ;     

}

/***********************************************************************
 *
************************************************************************/
function geResult (op, sParams, showResult) {
  sHref = sUrl + "?idCession=" + idCession 
               + "&idLettre=" + idLettre
               + "&op=" + op
               + sParams;
  
  if (showResult) alert ("geResult : URL -> " + sHref);
  xhr_object = get_xhr();   
  if (xhr_object == null) return;
  //------------------------------------------------------------------
  //alert ("toto");
  xhr_object.open("GET", sHref , false);   
  xhr_object.send(null);   
  //alert ("toto"); 
  
 if(xhr_object.readyState == 4) {
      var retour = xhr_object.responseText; 
      //alert("xhr_object = " + retour);
      var h = retour.indexOf("|", 0);
      var i = retour.indexOf("|", h+1);
      var j = retour.indexOf("|", i+1);
      resultat = retour.substr(h+1, i-h-1);
      if (showResult) alert("geResult : options  -> " + resultat, false);      
      options = resultat.split(sep);
      return options;
  }
}

/*******************************************************************

*********************************************************************/
function parserRetour(retour) {
      
      var h = retour.indexOf("|", 0);
      var i = retour.indexOf("|", h+1);
      var j = retour.indexOf("|", i+1);
      resultat = retour.substr(h+1, i-h-1);
      //alert (retour);      
      
      /*
      */
      options = resultat.split(";");
      lidCession = options[0];    
      return options;
}


