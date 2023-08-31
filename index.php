<?php
include __DIR__."/config/variables.php";
include __DIR__."/config/users.php";
include __DIR__."/functions/bot.php";
include_once __DIR__."/functions/functions.php";


////Modules
include __DIR__."/Modules/Others/sk.php";
include __DIR__."/Modules/Others/id.php";
include __DIR__."/Modules/Others/bin.php";


include __DIR__."/Modules/Gates/bad.php";
include __DIR__."/Modules/Gates/cvv.php";
include __DIR__."/Modules/Gates/ccn.php";
include __DIR__."/Modules/Gates/chk.php";
include __DIR__."/Modules/Gates/chh.php";
include __DIR__."/Modules/Gates/shk.php";
include __DIR__."/Modules/Gates/mchk.php";


//////////////===[START]===//////////////

if(strpos($message, "/start") === 0){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Hi, @$username [ $userId ] type /register to use me</b>",
	'parse_mode'=>'html',
	'reply_to_message_id'=> $message_id,
    ]);
}

if(strpos($message, "/register") === 0 || strpos($message, "!register") === 0 || strpos($message, ".register") === 0){
$user = file_get_contents('fun/users.txt');
$users = explode("\n", $user);
if (in_array($chat_id, $users)) {
sendMessage($chat_id, "❌ You are already registered. type /cmds to check my camands", $messageId);
}
else {
    fwrite(fopen('fun/users.txt', 'a'), $userId."\r\n");
  sendMessage($chat_id, "✅ You are now registered. type /cmds to check my camands", $messageId);
}
}
//////////////===[Plan]===/////////////
$filename = 'fun/users.txt';
$toturs = count(file($filename));


$filename1 = 'fun/pm.txt';
$treurs = count(file($filename1));

$tgroups = 'fun/groups.txt';
$tgroup = count(file($tgroups));


if(strpos($message, "/status") === 0 || strpos($message, "!status") === 0 || strpos($message, ".status") === 0)
  {
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>------------------+------------
       TOTAL USERS✅ : $toturs
       PREMIUM USERS ✅: $treurs 
       TOTAL GROUPS ✅: $tgroup
       ------------------+------------</b>",
	'parse_mode'=>'html',
	'reply_to_message_id'=> $message_id,
    ]);
  }
  



if(strpos($message, "/pre") === 0 || strpos($message, "!pre") === 0 || strpos($message, ".pre") === 0){
  if($plan != "OWNER")
  {
    sendMessage($chat_id,"You are Not ADMIN ! ",$messageId);
  }
  else
  {
$uid = substr($message,4);
fwrite(fopen('fun/pm.txt', 'a'), $uid."\r\n");
sendMessage($chat_id,"DONE $uid is premium user now ✅",$messageId);
sendMessage($uid,"NOW YOU ARE A PREMIUM USER✅",$messageId);
}
}
if(strpos($message, "/add") === 0 || strpos($message, "!add") === 0 || strpos($message, ".add") === 0){
  if($plan != "OWNER")
  {
    sendMessage($chat_id,"You are Not ADMIN ! ",$messageId);
  }
  else
  {
$uid = substr($message,4);
fwrite(fopen('fun/groups.txt', 'a'), $uid."\r\n");

sendMessage($chat_id,"DONE NOW $uid is premium user✅",$messageId);
sendMessage($uid,"CHAT IS APPROVED NOW✅",$messageId);
}
}



if(strpos($message, "/cmds") === 0 || strpos($message, "!cmds") === 0 || strpos($message, ".cmds") === 0){

  
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Which commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"GATES",'callback_data'=>"checkergates"],['text'=>"TOOLS",'callback_data'=>"othercmds"],['text'=>"OWNER",'url' => "https://t.me/balenottere"]],
    ],'resize_keyboard'=>true])
    ]);
  
  
  }
  
  if($data == "back"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"<b>Which commands would you like to check?</b>",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"GATES",'callback_data'=>"checkergates"],['text'=>"TOOLS",'callback_data'=>"othercmds"],['text'=>"OWNER",'url' => "https://t.me/balenottere"]],
    ],'resize_keyboard'=>true])
    ]);
  }
  
  if($data == "checkergates"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"━━𝗖𝗖 𝗖𝗵𝗲𝗰𝗸𝗲𝗿 𝗚𝗮𝘁𝗲𝘀━━

⏣/chk Stripe charge $1 [✅]

⏣/bad stripe charge $5 [✅]

⏣/cvv for cvv chargr $1 [✅]

⏣/ccn for ccn charge $1 [✅]

⏣/au stripe auth  [✅]


𝗝𝗢𝗜𝗡 <a href='https://t.me/undefychatchk'>𝗛𝗘𝗥𝗘</a>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }
  
  
  if($data == "othercmds"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"━━𝗢𝘁𝗵𝗲𝗿 𝗖𝗼𝗺𝗺𝗮𝗻𝗱𝘀━━
    
⏣/sk. /sk sk_livexxxx [✅]

⏣/bin /bin 53146200 [✅]

⏣/id for check id [✅]

𝗝𝗢𝗜𝗡 <a href='https://t.me/undefychatchk'>𝗛𝗘𝗥𝗘</a>",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
  [['text'=>"Return",'callback_data'=>"back"]]
  ],'resize_keyboard'=>true])
  ]);
  }

?>
    
?>
