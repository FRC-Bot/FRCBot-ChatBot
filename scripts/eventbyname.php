<?php
  $evname = $_GET["eventname"];
  $evname = str_replace(filter_var($evname, FILTER_SANITIZE_NUMBER_INT), '', $evname);

  $json_string = file_get_contents("https://www.googleapis.com/customsearch/v1?q={$evname}&cx=**Google custom search engine key***&siteSearch=thebluealliance.com&key=AIzaSyDAWhaM5K2OOVwJ5dxA2mp6s9ntqN3fjJw");
  $parsed_json = json_decode($json_string);
  
  $evid = $parsed_json->{'items'}[0]->{'link'};
  
  $answer = "error";
  
  if (strpos($evid, 'https://www.thebluealliance.com/event/') !== false) {
	  
	  $answer = str_replace('https://www.thebluealliance.com/event/', '', $evid);
	  $answer = str_replace(filter_var($answer, FILTER_SANITIZE_NUMBER_INT), '', $answer); //remove year from event id
	  
	}
  
  print($answer)
?>
