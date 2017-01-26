<?php
$command = $_GET["command"];
$senderId = $_GET["uid"];

$team = $_GET["team"];
$year = $_GET["year"];

if ($year = '') {
  $apistatus = file_get_contents("https://www.thebluealliance.com/api/v3/status");
  $year = $teamInfo->{"current_season"}; // Get the current year via the API
}

$teamInfojs = file_get_contents("https://www.thebluealliance.com/api/v3/team/frc{$team}"); // Get some basic infos about the team in Json
$teamInfo = json_decode($teamInfojs);

$response = '';

if (strpos($teamInfo->{"key"}, 'frc') !== false) { // Make sure the team exist by checking if it has a team key

  if ($command == "motto") {
    $answer = $teamInfo->{"nickname"};

    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  }

  if ($command == "nickname") {
    $answer = "Team {$team}'s nickname is " . $teamInfo->{'nickname'};

    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  }

  if ($command == "rookie") {
    $answer = "Team {$team} was created in " . $teamInfo->{'rookie_year'};

    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  }

  if ($command == "website") {
    $answer = "Team {$team}'s website is " . $teamInfo->{'website'};

    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  }

  if ($command == "championship") {
    $champs = $teamInfo->{'home_championship'};
    $answer = "In {$year}, the home championship of {$team} will be in " . $champs->{$year};

    $response = [
      'recipient' => [ 'id' => $senderId ],
      'message' => [ 'text' => $answer ]
  ];
  }

  if ($command == "location") {
    $answer = "Team {$team} is located in " . $teamInfo->{"address"};

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
              'url' => $teamInfo->{"gmaps_url"},
              'title' => "View on Google Maps",
            ),
          ),
        ),
      ),
    ),
);
  }

  //team history
//  if ($command == "robotname") {
//    $robotInfojs = file_get_contents("https://www.thebluealliance.com/api/v3/team/frc{$team}/robots"); // Get some basic infos about the team in Json
//    $robotInfo = json_decode($robotInfojs);

//    $answer = "In {$year}, their robot name was " . $robotInfo->{"{$year}"};

//    $response = [
//      'recipient' => [ 'id' => $senderId ],
//      'message' => [ 'text' => $answer ]
//  ];
//  }
}else {
  $answer = "This team doesn't exist!";

  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
print(json_encode($response));
 ?>
