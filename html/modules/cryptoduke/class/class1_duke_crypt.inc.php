<?php

class Chiffrement {

	// Algorithme utilisé pour le cryptage des blocs
	private static $cipher  = MCRYPT_RIJNDAEL_256;

	// Clé de cryptage         
	private static $key = "def000006f289f278cjhdjhekf54486";

	// Mode opératoire (traitement des blocs)
	private static $mode    = 'cbc';
 
	public static function crypt($data, $keyData){
    	$keyHash = md5($keyData);
    	$keyData = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
    	$iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
 
    	$data = mcrypt_encrypt(self::$cipher, $keyData, $data, self::$mode, $iv);
    
    return base64_encode($data);
}
 
	public static function decrypt($data, $keyData){
    	$keyHash = md5($keyData);
    	$keyData = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
    	$iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );

    	$data = base64_decode($data);
    	$data = mcrypt_decrypt(self::$cipher, $keyData, $data, self::$mode, $iv);

    return rtrim($data);
}}

?>