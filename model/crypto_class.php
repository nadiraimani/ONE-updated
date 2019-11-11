<?php
class Crypto 
{
	public function __Construct()
	{	  }
	
	public function string_encrypt($data_input)	
	{   
		$key = "onewarisalam";
		$td = mcrypt_module_open('rijndael-256', '', MCRYPT_MODE_ECB, '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$encrypted_data = mcrypt_generic($td, $data_input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$encoded_64=base64_encode($encrypted_data);
		return $encoded_64;	}   
		
	public function string_decrypt($encoded_64)
	{
		$encoded_64 = str_replace(' ','+',$encoded_64);
		$key = "onewarisalam";
		$td = mcrypt_module_open('rijndael-256', '', MCRYPT_MODE_ECB, '');
		$iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$decoded_64=base64_decode($encoded_64);
		$decrypted_data = mdecrypt_generic($td,$decoded_64);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return $decrypted_data; }
	
	public function combination_encrypt($code) // parameter is in unencrypted mode
	{
		$magic_irmis = "p@sswd01"; 
		$magic_com = $magic_irmis.$code;
		$encrypt_magic_com = $this->string_encrypt($magic_com);				
		return $encrypt_magic_com;	
	}
	
	public function combination_decrypt($code) // parameter is in encrypted mode
	{
		$decrypt_magic_com = $this->string_decrypt($code);
		$magic_xplode = explode('p@sswd01',$decrypt_magic_com,2);		
		return $magic_xplode[1];	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
