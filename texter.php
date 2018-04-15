<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC7fde773f5362bf4d4f4a61314f93dd02';
$token = 'YOUR API KEY HERE';
$client = new Client($sid, $token);

// Creating a list of updates found from database

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    '+15558675309',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+15017250604',
        // the body of the text message you'd like to send
        // 'body' => 'Hey Jenny! Good luck on the bar exam!'

        // Loop through changes and print them out. Then say whether or not the
        // want to log in by providing a link to official website.
        'body' => 'Hi, the following information was updated'
    )
);
