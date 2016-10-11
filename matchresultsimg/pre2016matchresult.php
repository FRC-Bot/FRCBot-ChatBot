<?php
  //Set the Content Type
  header('Content-type: image/jpeg');
  
  $matchid = $_GET["matchid"];
  
	//variables
  	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/match/{$matchid}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	// Red
	$rteam1 = str_replace('frc', '', $parsed_json->{'alliances'}->{'red'}->{'teams'}[0]);
	$rteam2 = str_replace('frc', '', $parsed_json->{'alliances'}->{'red'}->{'teams'}[1]);
	$rteam3 = str_replace('frc', '', $parsed_json->{'alliances'}->{'red'}->{'teams'}[2]);
	$rscore = $parsed_json->{'alliances'}->{'red'}->{'score'};
	
	
	// Blue
	$bteam1 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[0]);
	$bteam2 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[1]);
	$bteam3 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[2]);
	$bscore = $parsed_json->{'alliances'}->{'blue'}->{'score'};
	

  // Create Image From Existing File
  $png_image = imagecreatefrompng ('https://frc-bot.github.io/FRCBot-images/messenger/MatchResultsTemplates/pre2016/template.png');
  
  $cor = imagecolorallocate($rImg, 0, 0, 0);

  // Print Text On Image
  //Red teams
imagestring($png_image,5,41,41,$rteam1,$cor);
imagestring($png_image,5,180,41,$rteam2,$cor);
imagestring($png_image,5,310,41,$rteam3,$cor);
imagestring($png_image,5,463,41,$rscore,$cor);

//Blue teams
imagestring($png_image,5,41,71,$bteam1,$cor);
imagestring($png_image,5,180,71,$bteam2,$cor);
imagestring($png_image,5,310,71,$bteam3,$cor);
imagestring($png_image,5,463,71,$bscore,$cor);


  // Send Image to Browser
  imagepng($png_image);

  // Clear Memory
  imagedestroy($png_image);
?>
