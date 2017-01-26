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

}else {
  $answer = "This team doesn't exist!";

  $response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
}
print(json_encode($response));
 ?>
