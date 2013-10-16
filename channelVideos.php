<?php 
//channelVideos.php
//query for the channels details aka videos. 
//TODO: Add the Moderators and owners in and refactor this method. 
//This is only for initial proof of concept of restfull API for synctune

// Allow all domains and origin
header('Access-Control-Allow-Origin: *');

// request types
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// X-Requested-With header allows jQuery requests to go through
header('Access-Control-Allow-Headers: X-Requested-With');

// set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');

//The Request
$channelInfo = $_GET['id'];

//Do NOT use GET var inside SQL Query lol. 
$query = "SELECT * FROM  `videos` LIMIT 0 , 300";
$connection = mysqli_connect('localhost', 'root', '', 'synctune_channel');

$channelDetails = array();
//Form the  channel array 
if ($result = $connection->query($query)) {
	while ($row = mysqli_fetch_assoc($result)) {
		if($row['channel_id'] == $channelInfo)
	    $channelDetails['videos'][] = array(
	        'url' => $row['url'],
	        'channel_id' => $row['channel_id'],
	        'title' => $row['title']
	    );
	}
}
	echo json_encode($channelDetails);
;?>
