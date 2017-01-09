<?php
/**
* simple utility class for subscribing an emsvc member to a list via an autoform id and key
* email is always required - additional fields will be determined by the setup of the autoform
* on the emsvc application - any fields not declared in the autoform setup will not be validated
* and will not be stored
*/

class autoform_subscriber
{
	public $autoform_url	= 'https://enflyer.emsvc.net/autoform_display.php';
	public $post_query		= '';


	public function __construct()
	{

	}

	public function setAutoformUrl($arg_url)
	{
		$this->autoform_url 	= $arg_url;
	}

	public function setAutoformId($arg_autoform_id)
	{
		$this->fields['autoform_id'] 	= $arg_autoform_id;
	}

	public function setAutoformKey($arg_autoform_key)
	{
		$this->fields['af_key'] 		= $arg_autoform_key;
	}

	public function addField($arg_name, $arg_value)
	{
		$this->fields[$arg_name] = $arg_value;
	}

	public function subscribe()
	{
		$curl	= curl_init($this->autoform_url);
		$post_query = $this->buildQuery();

		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_query);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// If you experience SSL issues, perhaps due to an outdated SSL cert
  		// on your own server, try uncommenting the line below
 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($curl);
		curl_close($curl);
		sleep(2); //hitting the endpoint too frequently can result in an http ban on the server

	}

	private function buildQuery()
	{
		if( !isset($this->fields['autoform_id']) )
		{
			die('you must set an autoform id with function setAutoformId()');
		}

		if( !isset($this->fields['af_key']) )
		{
			die('you must set an autoform key with function setAutoformKey()');
		}

		if( !isset($this->fields['email']) )
		{
			die('all autoform subscription requests require at least an email field be set with the addField function');
		}

		$post_query = 'action=add&';
		foreach($this->fields as $key => $value)
		{
			$post_query .= 'fields[' . $key . ']=' . $value  . '&';
		}
		return $post_query;
	} 
}
?>
