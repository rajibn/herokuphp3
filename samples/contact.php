<?php
require_once ('../soapclient/SforcePartnerClient.php');
require_once ('../soapclient/SforceHeaderOptions.php');

try {
  	$mySforceConnection = new SforcePartnerClient();
  	$mySoapClient = $mySforceConnection->createConnection('../soapclient/partner.wsdl.xml');
  	$mylogin = $mySforceConnection->login("username@yourdomaincom", "changeme");

	$query = "SELECT c.Id, c.FirstName, c.LastName, a.Name
			 from Contact c, c.Account a WHERE c.Id ='".$sfid."'"; 

	$result = self::$mySforceConnection->query($query);
	$sObject = new SObject($result->records[0]);
	var_dump($sObject);

	echo "<br />First:".$sObject->fields->FirstName;
	echo "<br />Last:".$sObject->fields->LastName;
	echo "<br />Company:".$sObject->sobjects[0]->fields->Name;

	print_r($result);

} catch (Exception $e) {
  	echo $mySforceConnection->getLastRequest();
  	print_r($e);
}
?>
