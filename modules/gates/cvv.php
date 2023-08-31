<?php
include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";


if ((strpos($message, "/cvv") === 0)||(strpos($message, "!cvv") === 0)||(strpos($message, ".cvv") === 0)){
if(!in_array($chat_id, $auchats)){
    if($usertype == 'free'){
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>you are not a premium user </b>",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
            ]);
        return;
    }
}



$message = substr($message, 5);
$messageidtoedit1 = bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"<b>Wait for Result...</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);

$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

$cc = multiexplode(array(":", "/", " ", "|"), $message)[0];
$mes = multiexplode(array(":", "/", " ", "|"), $message)[1];
$ano = multiexplode(array(":", "/", " ", "|"), $message)[2];
$cvv = multiexplode(array(":", "/", " ", "|"), $message)[3];
$amt = multiexplode(array(":", "/", " ", "|"), $message)[4];
if(empty($amt)){
    $amt = '10';
}

if(empty($cc)||empty($cvv)||empty($mes)||empty($ano)){
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"Invalid details \nFormat -> cc|mm|yy|cvv",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    return;
};
if(strlen($ano) == '4'){
    $an = substr($ano, 2);
}
else{
  $an = $ano;
}
    $amount = $amt * 100;
//------------Card info------------//
$lista = ''.$cc.'|'.$mes.'|'.$an.'|'.$cvv.'';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Host: lookup.binlist.net',
        'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*//*;q=0.8'));
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


//------------Card info------------//
  
# -------------------- [1 REQ] -------------------#
$x = 0;  


    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&billing_details[address][line1]=36&billing_details[address][line2]=Regent Street&billing_details[address][city]=Jamestown&billing_details[address][postal_code]=14701&billing_details[address][state]=New York&billing_details[address][country]=US&billing_details[email]='.$mail.'@gmail.com&billing_details[name]=@badboychx');
    $result1 = curl_exec($ch);
    $tok1 = Getstr($result1,'"id": "','"');
    $msg1 = Getstr($result1,'"message": "','"');



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$amount.'&currency=usd&payment_method_types[]=card&description=Dark_sol Donation&payment_method='.$tok1.'&confirm=true&off_session=true');
    $result2 = curl_exec($ch);
    $msg2 = Getstr($result2,'"message": "','"');
    $rcp = trim(strip_tags(GetStr($result2,'"receipt_url": "','"')));

      
  ////////--[Responses]--////////

    if(strpos($result2, '"seller_message": "Payment complete."' )) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» LIVE✅
✮ƦESPONSE -» CHARGED✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2, "insufficient_funds" )) {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» insufficient_funds✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "card_error_authentication_required")) || (strpos($result2, "card_error_authentication_required"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» LIVE✅
✮ƦESPONSE -» card_error_authentication_required✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2,'"cvc_check": "pass"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» LIVE ✅
✮ƦESPONSE -» CHARGED✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result2,'"code": "incorrect_cvc"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card’s security code is incorrect✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅
❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif(strpos($result1,'"code": "incorrect_cvc"')){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card’s security code is incorrect✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "transaction_not_allowed")) || (strpos($result2, "transaction_not_allowed"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» transaction Not allowed✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "fraudulent")) || (strpos($result2, "fraudulent"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» fraudulent
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "expired_card")) || (strpos($result2, "expired_card"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» expired card
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, "generic_declined")) || (strpos($result2, "generic_declined"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» Your card was declined
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, "do_not_honor")) || (strpos($result2, "do_not_honor"))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» do_not_honor
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, 'rate_limit')) || (strpos($result2, 'rate_limit'))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» RATE LIMITED
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    elseif ((strpos($result1, "Your card was declined.")) || (strpos($result2, "Your card was declined."))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» Your card was declined
✮GATEWAY -» Stripe Charge $2

❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        elseif ((strpos($result1, ' "message": "Your card number is incorrect."')) || (strpos($result2, ' "message": "Your card number is incorrect."'))){
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» DEAD❌
✮ƦESPONSE -» Your card number is incorrect.
✮GATEWAY -» Stripe Charge $2
❆═══»undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/@undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
    else {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"<b><u><i>Unknown Error. $msg1 - $msg2</i></u></b>",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    };
}

?>
