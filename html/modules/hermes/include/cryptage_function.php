<?php

/**************************************************************************
 *
 **************************************************************************/
 function getKeyCryptage(){
  return 'Ceci est une tr�s longue cl� de chiffrement, et m�me trop longue';
 }

/**************************************************************************
 *
 **************************************************************************/
 function getRequestOut($url, $mode){
 //mode = 0 = cryptage
 //mode = 1 = decryptage
  if (strpos ($url, '?') === false) return $url;
  $u = explode('?', $url);
  $t = explode ('&', $u[1]);  
  //----------------------------------------------------
   /* Donn�es */
  $key = getKeyCryptage;
  $plain_text = $u[1];
  
  /* Ouvre le module et cr�e un VI */ 
  $td = mcrypt_module_open('des', '', 'ecb', '');
  $key = substr($key, 0, mcrypt_enc_get_key_size($td));
  $iv_size = mcrypt_enc_get_iv_size($td);
  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
 
  /* Initialise le module de chiffrement */
  if (mcrypt_generic_init($td, $key, $iv) != -1) {
  
      /* Chiffre les donn�es */
      $c_t = mcrypt_generic($td, $plain_text);
      mcrypt_generic_deinit($td);
      mcrypt_module_close($td);
  }
  
  //--------------------------------------------------- 
  $newUrl = $u[0].'?'.'hermes='.$c_t;
  return $newUrl;
 }
/**************************************************************************
 *
 **************************************************************************/
 function getRequestIn($param){
  //----------------------------------------------------
 /* Donn�es */
  $key = getKeyCryptage;

  //------------------------------------------------------
  /* Ouvre le module et cr�e un VI */ 
  $td = mcrypt_module_open('des', '', 'ecb', '');
  $key = substr($key, 0, mcrypt_enc_get_key_size($td));
  $iv_size = mcrypt_enc_get_iv_size($td);
  $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
  
  
  /* Initialise le module de chiffrement */
  if (mcrypt_generic_init($td, $key, $iv) != -1) {
      $p_t = mdecrypt_generic($td, $param);

      /* Nettoye */
      mcrypt_generic_deinit($td);
      mcrypt_module_close($td);
  }
  //--------------------------------------------------- 
  $p = explode ('&', $c_t);
  return $p;
 
  
}
 
 
?>