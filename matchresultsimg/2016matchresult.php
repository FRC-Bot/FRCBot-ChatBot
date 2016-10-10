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
	
	$rabp = $parsed_json->{'score_breakdown'}->{'red'}->{'autoBoulderPoints'}; // Auto Boulder Points
	$rarp = $parsed_json->{'score_breakdown'}->{'red'}->{'autoReachPoints'}; // Auto Reach Points
	$racp = $parsed_json->{'score_breakdown'}->{'red'}->{'autoCrossingPoints'}; // Auto Crossing Points
	$ratotal = $parsed_json->{'score_breakdown'}->{'red'}->{'autoPoints'}; // Total Auto
	
	$rdef1 = "Low Bar"; // Defense 1
	$rdef2 = substr($parsed_json->{'score_breakdown'}->{'red'}->{'position2'}, 2); // Defense 2
	$rdef3 = substr($parsed_json->{'score_breakdown'}->{'red'}->{'position3'}, 2); // Defense 3
	$rdef4 = substr($parsed_json->{'score_breakdown'}->{'red'}->{'position4'}, 2); // Defense 4
	$rdef5 = substr($parsed_json->{'score_breakdown'}->{'red'}->{'position5'}, 2); // Defense 5
	
	$rdef1score = $parsed_json->{'score_breakdown'}->{'red'}->{'position1crossings'}; // Defense 1 Score
	$rdef2score = $parsed_json->{'score_breakdown'}->{'red'}->{'position2crossings'}; // Defense 2 Score
	$rdef3score = $parsed_json->{'score_breakdown'}->{'red'}->{'position3crossings'}; // Defense 3 Score
	$rdef4score = $parsed_json->{'score_breakdown'}->{'red'}->{'position4crossings'}; // Defense 4 Score
	$rdef5score = $parsed_json->{'score_breakdown'}->{'red'}->{'position5crossings'}; // Defense 5 Score
	
	$rtcp = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopCrossingPoints'}; // Teleop Crossing Points
	
	$rtbh = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopBouldersHigh'}; // Teleop Boulders High
	$rtbl = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopBouldersLow'}; // Teleop Boulders Low
	$rttotalb = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopBoulderPoints'}; // Total Telop Boulder
	
	$rtchp = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopChallengePoints'}; // Tower Challenge Points
	$rtscp = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopScalePoints'}; // Tower Scale Points
	
	$rttotal = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopPoints'}; // Total Teleop
	
	$rdb = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopDefensesBreached'}; // Defenses Breached
	$rtc = $parsed_json->{'score_breakdown'}->{'red'}->{'teleopTowerCaptured'}; // Tower Captured
	$rfouls = $parsed_json->{'score_breakdown'}->{'red'}->{'foulPoints'}; // Fouls
	$radj = $parsed_json->{'score_breakdown'}->{'red'}->{'adjustPoints'}; // Adjustments
	
	$rtotal = $parsed_json->{'alliances'}->{'red'}->{'score'}; // Total Score
	
	
	// Blue
	$bteam1 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[0]);
	$bteam2 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[1]);
	$bteam3 = str_replace('frc', '', $parsed_json->{'alliances'}->{'blue'}->{'teams'}[2]);
	$bscore = $parsed_json->{'alliances'}->{'blue'}->{'score'};
	
	$babp = $parsed_json->{'score_breakdown'}->{'blue'}->{'autoBoulderPoints'}; // Auto Boulder Points
	$barp = $parsed_json->{'score_breakdown'}->{'blue'}->{'autoReachPoints'}; // Auto Reach Points
	$bacp = $parsed_json->{'score_breakdown'}->{'blue'}->{'autoCrossingPoints'}; // Auto Crossing Points
	$batotal = $parsed_json->{'score_breakdown'}->{'blue'}->{'autoPoints'}; // Total Auto
	
	$bdef1 = "Low Bar"; // Defense 1
	$bdef2 = substr($parsed_json->{'score_breakdown'}->{'blue'}->{'position2'}, 2); // Defense 2
	$bdef3 = substr($parsed_json->{'score_breakdown'}->{'blue'}->{'position3'}, 2); // Defense 3
	$bdef4 = substr($parsed_json->{'score_breakdown'}->{'blue'}->{'position4'}, 2); // Defense 4
	$bdef5 = substr($parsed_json->{'score_breakdown'}->{'blue'}->{'position5'}, 2); // Defense 5
	
	$bdef1score = $parsed_json->{'score_breakdown'}->{'blue'}->{'position1crossings'}; // Defense 1 Score
	$bdef2score = $parsed_json->{'score_breakdown'}->{'blue'}->{'position2crossings'}; // Defense 2 Score
	$bdef3score = $parsed_json->{'score_breakdown'}->{'blue'}->{'position3crossings'}; // Defense 3 Score
	$bdef4score = $parsed_json->{'score_breakdown'}->{'blue'}->{'position4crossings'}; // Defense 4 Score
	$bdef5score = $parsed_json->{'score_breakdown'}->{'blue'}->{'position5crossings'}; // Defense 5 Score
	
	$btcp = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopCrossingPoints'}; // Teleop Crossing Points
	
	$btbh = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopBouldersHigh'}; // Teleop Boulders High
	$btbl = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopBouldersLow'}; // Teleop Boulders Low
	$bttotalb = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopBoulderPoints'}; // Total Telop Boulder
	
	$btchp = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopChallengePoints'}; // Tower Challenge Points
	$btscp = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopScalePoints'}; // Tower Scale Points
	
	$bttotal = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopPoints'}; // Total Teleop
	
	$bdb = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopDefensesBreached'}; // Defenses Breached
	$btc = $parsed_json->{'score_breakdown'}->{'blue'}->{'teleopTowerCaptured'}; // Tower Captured
	$bfouls = $parsed_json->{'score_breakdown'}->{'blue'}->{'foulPoints'}; // Fouls
	$badj = $parsed_json->{'score_breakdown'}->{'blue'}->{'adjustPoints'}; // Adjustments
	
	$btotal = $parsed_json->{'alliances'}->{'blue'}->{'score'}; // Total Score
	

  // Create Image From Existing File
  $png_image = imagecreatefrompng ('https://frc-bot.github.io/FRCBot-images/messenger/MatchResultsTemplates/2016/template.png');
  
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

//Red
imagestring($png_image,5,92,118,$rabp,$cor); // Auto Boulder Points
imagestring($png_image,5,92,149,$rarp,$cor); // Auto Reach Points
imagestring($png_image,5,92,180,$racp,$cor); // Auto Crossing Points
imagestring($png_image,5,92,211,$ratotal,$cor); // Total Auto

imagestring($png_image,5,2,242,$rdef1,$cor); // Defense 1
imagestring($png_image,5,2,273,$rdef2,$cor); // Defense 2
imagestring($png_image,5,2,304,$rdef3,$cor); // Defense 3
imagestring($png_image,5,2,335,$rdef4,$cor); // Defense 4
imagestring($png_image,5,2,366,$rdef5,$cor); // Defense 5

imagestring($png_image,5,125,242,"{$rdef1score}x Cross",$cor); // Defense 1 Score
imagestring($png_image,5,125,273,"{$rdef2score}x Cross",$cor); // Defense 2 Score
imagestring($png_image,5,125,304,"{$rdef3score}x Cross",$cor); // Defense 3 Score
imagestring($png_image,5,125,335,"{$rdef4score}x Cross",$cor); // Defense 4 Score
imagestring($png_image,5,125,366,"{$rdef5score}x Cross",$cor); // Defense 5 Score

imagestring($png_image,5,92,396,$rtcp,$cor); // Teleop Crossing Points

imagestring($png_image,5,2,427,"{$rtbh} x 5 points",$cor); // Teleop Boulders High
imagestring($png_image,5,2,458,"{$rtbl} x 2 points",$cor); // Teleop Boulders Low
imagestring($png_image,5,92,489,$rttotalb,$cor); // Total Telop Boulder

imagestring($png_image,5,92,520,$rtchp,$cor); // Tower Challenge Points
imagestring($png_image,5,92,551,$rtscp,$cor); // Tower Scale Points

imagestring($png_image,5,92,582,$rttotal,$cor); // Total Telop

if($rdb == true){
	imagestring($png_image,5,92,613,'Yes',$cor); // Defenses Breached
	}else{
	imagestring($png_image,5,92,613,'No',$cor); // Defenses Breached	
	}
if($rtc == true){
	imagestring($png_image,5,92,644,'Yes',$cor); // Tower Captured
	}else{
	imagestring($png_image,5,92,644,'No',$cor); // Tower Captured
	}

imagestring($png_image,5,92,675,"+{$rfouls}",$cor); // Fouls
imagestring($png_image,5,92,706,$radj,$cor); // Adjustments

imagestring($png_image,5,92,737,$rtotal,$cor); // Total Score

// Blue
imagestring($png_image,5,461,118,$babp,$cor); // Auto Boulder Points
imagestring($png_image,5,461,149,$barp,$cor); // Auto Reach Points
imagestring($png_image,5,461,180,$bacp,$cor); // Auto Crossing Points
imagestring($png_image,5,461,211,$batotal,$cor); // Total Auto

imagestring($png_image,5,444,242,$bdef1,$cor); // Defense 1
imagestring($png_image,5,444,273,$bdef2,$cor); // Defense 2
imagestring($png_image,5,444,304,$bdef3,$cor); // Defense 3
imagestring($png_image,5,444,335,$bdef4,$cor); // Defense 4
imagestring($png_image,5,444,366,$bdef5,$cor); // Defense 5

imagestring($png_image,5,370,242,"{$bdef1score}x Cross",$cor); // Defense 1 Score
imagestring($png_image,5,370,273,"{$bdef2score}x Cross",$cor); // Defense 2 Score
imagestring($png_image,5,370,304,"{$bdef3score}x Cross",$cor); // Defense 3 Score
imagestring($png_image,5,370,335,"{$bdef4score}x Cross",$cor); // Defense 4 Score
imagestring($png_image,5,370,366,"{$bdef5score}x Cross",$cor); // Defense 5 Score

imagestring($png_image,5,461,396,$btcp,$cor); // Teleop Crossing Points

imagestring($png_image,5,372,427,"{$btbh} x 5 points",$cor); // Teleop Boulders High
imagestring($png_image,5,372,458,"{$btbl} x 2 points",$cor); // Teleop Boulders Low
imagestring($png_image,5,461,489,$bttotalb,$cor); // Total Telop Boulder

imagestring($png_image,5,461,520,$btchp,$cor); // Tower Challenge Points
imagestring($png_image,5,461,551,$btscp,$cor); // Tower Scale Points

imagestring($png_image,5,461,582,$bttotal,$cor); // Total Telop

if($bdb == true){
	imagestring($png_image,5,461,613,'Yes',$cor); // Defenses Breached
	}else{
	imagestring($png_image,5,461,613,'No',$cor); // Defenses Breached	
	}
if($btc == true){
	imagestring($png_image,5,461,644,'Yes',$cor); // Tower Captured
	}else{
	imagestring($png_image,5,461,644,'No',$cor); // Tower Captured
	}
	
imagestring($png_image,5,461,675,"+{$bfouls}",$cor); // Fouls
imagestring($png_image,5,461,706,$badj,$cor); // Adjustments

imagestring($png_image,5,461,737,$btotal,$cor); // Total Score

  // Send Image to Browser
  imagepng($png_image);

  // Clear Memory
  imagedestroy($png_image);
?>
