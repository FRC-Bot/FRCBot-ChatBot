<?php
// parameters
$accessToken = "***";
$hubVerifyToken = '***';
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$isteamvalid = ""; // this variable will indicate if a team exist. I found out that when you request the status of a team with the TBA nightbot http request, it tells you if the team exist or not.
// These lines are getting the name of the user
$userinfojs = file_get_contents("https://graph.facebook.com/v2.6/{$senderId}?fields=first_name&access_token={$accessToken}");
$userinfo = json_decode($userinfojs);
$susername = $userinfo->{'first_name'};
$answer = "I don't understand. Type 'help' for a list of commands!";
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
//Random crap
if(strpos(strtolower($messageText), 'shut up') !== false) {
	$answer = "...";
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'sender_action' => 'mark_seen'
];
}
if ((strpos(strtolower($messageText), 'ok') !== false) || (strpos(strtolower($messageText), "\xf0\x9f\x91\x8d") !== false)) {
$answer = "\xf0\x9f\x91\x8d"; // Thumbs Up Emoji
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}

if ((strpos(strtolower($messageText), 'water') !== false) && (strpos(strtolower($messageText), "game") !== false)) {
$answer = "Water Game"; 
	
	$wgimages = ['http://frcbot.com/chatbot/data/wg/1.jpg', 'http://frcbot.com/chatbot/data/wg/2.jpg', 'http://frcbot.com/chatbot/data/wg/3.jpg'];
    $wgurl = $wgimages[mt_rand(0, 2)];
	
	$response = array (
  'recipient' => 
  array (
    'id' => $senderId,
  ),
  'message' => 
  array (
    'attachment' => 
    array (
      'type' => 'image',
      'payload' => 
      array (
        'url' => $wgurl,
      ),
    ),
  ),
);
	
}

if (strpos(strtolower($messageText), 'bye') !== false) {
$answer = "Goodbye {$susername}! Ttyl :)";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if (strpos(strtolower($messageText), 'thank') !== false) {
$answer = "You're welcome {$susername}!";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if ((strpos(strtolower($messageText), 'why') !== false) || (strpos(strtolower($messageText), 'what') !== false)) {
$answer = "I don't know! Type 'help' for a list of commands!";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if ((strpos(strtolower($messageText), 'what up') !== false) || (strpos(strtolower($messageText), "what's up") !== false)) {
$answer = "Nothing much!";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if ((strpos(strtolower($messageText), 'what') !== false) && (strpos(strtolower($messageText), 'your') !== false) && (strpos(strtolower($messageText), "favorite") !== false)) {
	$answer = "I don't know! How about you?";
	
	$response = [
    	'recipient' => [ 'id' => $senderId ],
  	  'message' => [ 'text' => $answer ]
	];
	
	if (strpos(strtolower($messageText), 'team') !== false) {
		$answer = "";
	
	
		$response = [
    		'recipient' => [ 'id' => $senderId ],
  	 	 'message' => [ 'text' => $answer ]
		];
	}
	
	if (strpos(strtolower($messageText), 'website') !== false) {
		$answer = "My favorite websites are frcbot.com and thebluealliance.com !";
	
	
		$response = [
    		'recipient' => [ 'id' => $senderId ],
  	 	 'message' => [ 'text' => $answer ]
		];
	}
	
}
if (strpos(strtolower($messageText), 'teaser') !== false) {
$answer = "You can take a look at the 2017 FIRST STEAMWORKS Teaser here: https://www.youtube.com/watch?v=37GBEBLfhWA";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if (strpos(strtolower($messageText), 'date') !== false) {
$answer = "You can take a look at the FIRST calendar here: http://www.firstinspires.org/robotics/frc/calendar";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
// Bot commands
	
if ((strpos(strtolower($messageText), 'hi') !== false) || (strpos(strtolower($messageText), 'hello') !== false) || (strpos(strtolower($messageText), 'hey') !== false)) {
$answer = "Hello {$susername}! I'm the Facebook ChatBot for FRC__Bot! Type 'help' for a list of commands!";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if (strpos(strtolower($messageText), 'help') !== false) {
$response = array (
  'recipient' => 
  array (
    'id' => $senderId,
  ),
  'message' => 
  array (
    'attachment' => 
    array (
      'type' => 'image',
      'payload' => 
      array (
        'url' => 'https://frc-bot.github.io/FRCBot-images/messenger/frcbothelp.png',
      ),
    ),
  ),
);
	
}
if ((strpos(strtolower($messageText), 'social') !== false) || (strpos(strtolower($messageText), 'facebook') !== false) || (strpos(strtolower($messageText), 'twitter') !== false) || (strpos(strtolower($messageText), 'youtube') !== false)  || (strpos(strtolower($messageText), 'instagram') !== false)) {
$answer = "Right now, I can't give you the social medias of teams but my developers are working on that!";
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
}
if(strpos(strtolower($messageText), 'nextmatch') !== false) {
	
	$nmteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	$answer = file_get_contents("http://www.thebluealliance.com/_/nightbot/nextmatch/{$nmteam}");
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
if(strpos(strtolower($messageText), 'status') !== false) {
	
	$stteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	$answer = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$stteam}");
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
// This part is based on TheBlueAlliance API https://www.thebluealliance.com/apidocs
if(strpos(strtolower($messageText), 'website') !== false) { //get the website of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = "The website of team {$nbteam} is " . $parsed_json->{'website'};
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}
if(strpos(strtolower($messageText), 'location') !== false) { //get the location of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = "Team {$nbteam} is located in " . $parsed_json->{'location'};
	
		$response = array (
  'recipient' => 
  array (
    'id' => $senderId,
  ),
  'message' => 
  array (
    'attachment' => 
    array (
      'type' => 'template',
      'payload' => 
      array (
        'template_type' => 'button',
        'text' => $answer,
        'buttons' => 
        array (
          0 => 
          array (
            'type' => 'web_url',
            'url' => "https://www.google.com/maps/place/" . $parsed_json->{'location'},
            'title' => "View on Google Maps",
          ),
        ),
      ),
    ),
  ),
);
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}
if(strpos(strtolower($messageText), 'nickname') !== false) { //get the nickname of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = "Team {$nbteam}'s nickname is " . $parsed_json->{'nickname'};
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}
if((strpos(strtolower($messageText), 'sponsors') !== false) || (strpos(strtolower($messageText), 'partner') !== false)) { //get the sponsors of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = "Team {$nbteam}'s sponsors are " . $parsed_json->{'name'};
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}
// This part is used to open pages on TheBlueAlliance from a user request
if ((strpos(strtolower($messageText), 'team') !== false) && (strpos(strtolower($messageText), 'page') !== false)) {
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	$response = array (
  'recipient' => 
  array (
    'id' => $senderId,
  ),
  'message' => 
  array (
    'attachment' => 
    array (
      'type' => 'template',
      'payload' => 
      array (
        'template_type' => 'button',
        'text' => "Click to visit the team page of {$nbteam} on TBA",
        'buttons' => 
        array (
          0 => 
          array (
            'type' => 'web_url',
            'url' => "http://www.thebluealliance.com/team/{$nbteam}",
            'title' => "Team {$nbteam} on TBA",
          ),
        ),
      ),
    ),
  ),
);
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
	
}

if((strpos(strtolower($messageText), 'media') !== false) || (strpos(strtolower($messageText), 'picture') !== false)) { //get the pictures of a team
	
	$justnumbers = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT); // remove the text from the command and only keep numbers
	
	$mediayear = substr($justnumbers, 0, 4);
	$nbteam = str_replace($mediayear, '', $justnumbers);
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}/{$mediayear}/media?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$picturelink = "no link";
	
	if ((strpos(strtolower($json_string), 'cdphotothread') !== false) || (strpos(strtolower($json_string), 'imgur') !== false)) {
		$nbmedia = count($parsed_json);
		if (strpos(strtolower($json_string), 'cdphotothread') !== false) {
			for($i=0;$i<$nbmedia;$i++) { 
				if ($parsed_json[$i]->{'type'} == 'cdphotothread') {
					$picturelink = $parsed_json[$i]->{'details'}->{'image_partial'};
				}	
			}
			$answer = "http://www.chiefdelphi.com/media/img/{$picturelink}";
		}else{
			
			for($i=0;$i<$nbmedia;$i++) { 
				if ($parsed_json[$i]->{'type'} == 'imgur') {
					$picturelink = $parsed_json[$i]->{'foreign_key'};
				}	
			}
			$answer = "http://i.imgur.com/{$picturelink}h.jpg";
			
			}
			
$response = array (
  'recipient' => 
  array (
    'id' => $senderId,
  ),
  'message' => 
  array (
    'attachment' => 
    array (
      'type' => 'image',
      'payload' => 
      array (
        'url' => $answer,
      ),
    ),
  ),
);
	
	}else{
	$answer = "Team {$nbteam} didn't post any pictures in {$mediayear}";
		$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	}
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}

if(strpos(strtolower($messageText), 'rookie') !== false) { //get the rookie year of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = "Team {$nbteam} was created in " . $parsed_json->{'rookie_year'};
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}

if(strpos(strtolower($messageText), 'motto') !== false) { //get the motto of a team
	
	$nbteam = filter_var($messageText, FILTER_SANITIZE_NUMBER_INT);
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/team/frc{$nbteam}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);
	$answer = $parsed_json->{'motto'};
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
}
// events

if(strpos(strtolower($messageText), 'eventdate') !== false) { //get an event date
	
	$event = str_replace('eventdate', '', strtolower($messageText)); // remove eventdate to only keep the event key
	$event = str_replace(' ', '', $event); // remove spaces
	
	$json_string = file_get_contents("http://www.thebluealliance.com/api/v2/event/{$event}?X-TBA-App-Id=frcbot:messengerchatbot:1");
    $parsed_json = json_decode($json_string);

	$evname = $parsed_json->{'name'};
	$stdate = $parsed_json->{'start_date'};
	$enddate = $parsed_json->{'end_date'};
	
	$answer = "{$evname} will Start on {$stdate} and will end on {$enddate}";
	
	if (strpos($answer, 'will Start on  and will end on') !== false){ //if there is an error
		$answer = "Error: Invalid event key! Type 'event date EVENTKEY'";
	}
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}

//this check if the team exist and write an error if it does not exist
if (strpos(strtolower($isteamvalid), 'does not exist') !== false) {
	
	
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $isteamvalid ]
];
	
}
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_exec($ch);
curl_close($ch);
