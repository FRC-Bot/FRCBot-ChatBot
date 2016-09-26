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
$answer = "I don't understand. Type 'help' for a list of commands!";
	$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
	
if ((strpos(strtolower($messageText), 'hi') !== false) || (strpos(strtolower($messageText), 'hello') !== false)) {
$answer = "Hello! I'm the Facebook ChatBot for FRC__Bot! Type 'help' for a list of commands!";
	
	
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
        'url' => 'https://douce-vie.ca/technonerdz/frcbot/frcbothelp.png',
      ),
    ),
  ),
);
	
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
if(strpos(strtolower($messageText), 'sponsors') !== false) { //get the sponsors of a team
	
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
);;
$isteamvalid = file_get_contents("http://www.thebluealliance.com/_/nightbot/status/{$nbteam}"); // this line check if the team exist with a http request to the status nightbot command
	
}
//Random crap
if(strpos(strtolower($messageText), 'shut up') !== false) {
	
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
if (strpos(strtolower($messageText), 'bye') !== false) {
$answer = "Goodbye! Ttyl :)";
	
	
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
