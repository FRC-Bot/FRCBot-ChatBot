<?php
  $evname = $_GET["eventname"];
  
  $json_string = file_get_contents("https://www.googleapis.com/customsearch/v1?q={$evname}&cx=**link to Google custom search***&siteSearch=thebluealliance.com&key=AIzaSyDAWhaM5K2OOVwJ5dxA2mp6s9ntqN3fjJw");
  $parsed_json = json_decode($json_string);
  
  $evid = $parsed_json->{'items'}[0]->{'link'};
  
  $answer = "error";
  
  if (strpos($evid, 'https://www.thebluealliance.com/event/') !== false) {
	  
	  $answer = str_replace('https://www.thebluealliance.com/event/', '', $evid);
	  
	}
  
  print($answer)
?>
