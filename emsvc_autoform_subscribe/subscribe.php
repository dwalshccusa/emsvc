<?
/**
* example app for using the autoform_subscriber utility class
* use: subscribe.php --autoform_id 122345 --autoform_key jkh52jh8 --email someemail@somedomain.com
*/
INCLUDE_ONCE('lib.autoform_subscriber.php');

$shortopts = '';
$longopts = array(
			'autoform_id:',
			'autoform_key:',
			'email:'
);

$cli_args	= getopt($shortopts, $longopts);

$subscriber = new autoform_subscriber();
$subscriber->setAutoformUrl('https://enflyer.emsvc.net/autoform_display.php');
$subscriber->setAutoformId($cli_args['autoform_id']);
$subscriber->setAutoformKey($cli_args['autoform_key']);
$subscriber->addField('email', $cli_args['email']);
$subscriber->subscribe();
?>
