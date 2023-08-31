<?php

include __DIR__."/../functions/functions.php";

$update = json_decode(file_get_contents("php://input"));

$chat_id = $update->message->chat->id;

$userId = $update->message->from->id;

$firstname = $update->message->from->first_name;

$lastname = $update->message->from->last_name;

$username = $update->message->from->username;

$chattype = $update->message->chat->type;

$message = $update->message->text;

$message_id = $update->message->message_id;

$replytomessageis = $update->message->reply_to_message->text;

$data = $update->callback_query->data;

$callbackfname = $update->callback_query->from->first_name;

$callbacklname = $update->callback_query->from->last_name;

$callbackusername = $update->callback_query->from->username;

$callbackchatid = $update->callback_query->message->chat->id;

$callbackuserid = $update->callback_query->message->reply_to_message->from->id;

$callbackmessageid = $update->callback_query->message->message_id;

$botToken = '';

$mail = 'wilson'.random_strings(5).'';

$lname = ''.random_name(6).'';

$sk = 'PHnKzbJjoxYnW1WRs7Cm8hZIm0X5PcPRNZBsKZnE82DDNEhu1FcnKHB6Eu7sPGdXi00muv3yjM9';

$owner = 'undefy';
$coowner = '.';

?>
