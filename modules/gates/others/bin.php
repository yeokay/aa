<?php 
include __DIR__."/../config/variables.php";
include __DIR__."/../config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";








if ((strpos($message, "/bin") === 0)||(strpos($message, "!bin") === 0)||(strpos($message, ".bin") === 0)){
    

$bin = substr($message, 5);
$messageidtoedit1 = bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Wait for Result...</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);

$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

if (!empty($bin)) {
$ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
};
bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"✅ <b>Valid Bin</b>
➥ <b>Bank</b> -» $bank
➥ <b>Country</b> -» $name 
➥ <b>Brand</b> -» $brand
➥ <b>Card</b> -» $scheme 
➥ <b>Type</b> -» $type 
<b>Checked By</b> ➔ $user",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
}
else {
bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"<b>❌ Invalid Bin
Format - /bin xxxxxx</b>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
}
}


?>
