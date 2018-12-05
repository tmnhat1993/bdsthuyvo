<?php

get_template_part("TwitterAPIExchange.php");

$settings = array(
    'oauth_access_token' => "2649180637-r7jYndVjkIZotN66ywFMGFMVULEo9AeCw8qkMe0",
    'oauth_access_token_secret' => "s4UXEc4yDQBFAgZW8CMCV9uDU52RxCGUuyi8gWFeKubnw",
    'consumer_key' => "Op5mzuOj0wdxbDaQ1ETMARpNn",
    'consumer_secret' => "etxeFf2UmxTpf4UQw1ZvRdawwlCfnQF9hwWIKstJomCnXdxlWP"
);



$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?q=#jwthemeltd'; // Change it

$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
                    
//var_dump(json_decode($response)); /* Here you will get all info from user timeline */

$valid_data = json_decode($response); //JSON data to PHP.

print "<ul>";
foreach ($valid_data as $key=>$value) {
  print "<li>";
  print $value->text;
  print "</li>";
}
print "</ul>";
?>
