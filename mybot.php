<?php
//create a simple telegram bot with php by AFTUS from atarud.ir
//In the first step, you need a token that you can get by @BotFather telegram robot.
//please note that you must upload php robot file to a server with a SSL certificate to get started.
//upload php bot file in your server.
//you need to set webhook, for set webhook :
//enter below url in your browser :
//https://api.telegram.org/bot<EnterYourTokenHere>/setWebhook?url=<EnterYourBotFileUrlHere>
//for example : https://api.telegram.org/botXXXX/setWebhook?url=https://www.example.com/mybot.php
//Ok, let's start now
//define the token variable to get the token from botfather
$token ='XXXX'; // Enter your token inside '' , for example XXXX is your token
//define the input variables from the telegram
$json = file_get_contents('php://input'); // for get contents by json
$update = json_decode(file_get_contents('php://input')); // for decode json
//also we need this variables
$message=$update->message->text;
$message_id=$update->message->message_id;
$chatid=$update->message->chat->id;
//define the variables that we need
$text_one="Help"; 
$text_two="start";
$text_three="Information";
$text_four="Shop";
$amazon_url="https://www.amazon.com";
$start_command="/start";
//in this step, we use the below code to create a telegram keyboard
//for menu keyboard
$reply_markup=json_encode(["keyboard"=>
    [
        [["text"=>$text_one],["text"=>$text_two]], // two menu keyboard together
        [["text"=>$text_three]] // one single menu keyboard
    ],"resize_keyboard"=>true]); // enable the keyboard responsive ability
//for inline keyboard or glass keyboard
$reply_markup_two=json_encode(
[
		'inline_keyboard'=>[
		[['text'=>$text_four,'url'=>$amazon_url]]
    ]
    ]);
//to define telegram commands, we can use conditional command
if ($message==$start_command) {  //this code mean if the message received from the user is equal to the /start
    $rep=json_decode(file_get_contents("https://api.telegram.org/bot".$token."/SendMessage?chat_id=".$chatid."&reply_markup=".$reply_markup."&text=".urlencode("hello and welcome")));
}
//for start button
elseif ($message==$text_two) {
	$rep=json_decode(file_get_contents("https://api.telegram.org/bot".$token."/SendMessage?chat_id=".$chatid."&reply_markup=".$reply_markup."&text=".urlencode("this is test message from start button")));
}
//for help button
elseif ($message==$text_one) {
	$rep=json_decode(file_get_contents("https://api.telegram.org/bot".$token."/SendMessage?chat_id=".$chatid."&reply_markup=".$reply_markup."&text=".urlencode("this is test message from help button")));
}
//for display the inline keyboard
elseif ($message==$text_three) {
	$rep=json_decode(file_get_contents("https://api.telegram.org/bot".$token."/SendMessage?chat_id=".$chatid."&reply_markup=".$reply_markup_two."&text=".urlencode("Amazon Shop")));
}
//in the same way, you can easily access the rest of the Telegram robot methods at https://core.telegram.org/bots/api#available-methods.
//You can call and use any method, such as methods for sending photos, sending videos, sending documents, erasing messages and other methods. Be sure to any method, you must apply the parameters that are required
