<?php
$pro = file_get_contents('fun/group.txt');
$auchats = explode("\n", $pro);

$pro = file_get_contents('fun/pre.txt');
$pros = explode("\n", $pro);
if (in_array($chat_id, $pros)) {
$plan = 'premium';
}

if($userId == '1058653930'){
    $usertype = "<a href='tg://user?id= 1058653930'>undefy</a>[OWNER]";
  $plan = 'OWNER';
}
elseif(in_array($userId,$pros)){
    $usertype = '@'.$username.'[𝗣𝗿𝗲𝗺𝗶𝘂𝗺✨]';
    $plan = 'premium';
}
else {
    $usertype = '@'.$username.'[𝗙𝗿𝗲𝗲]';
    $plan = 'free';
}

$filename = 'fun/users.txt';
$toturs = count(file($filename));


$filename1 = 'fun/pm.txt';
$treurs = count(file($filename1));

$tgroups = 'fun/groups.txt';
$tgroup = count(file($tgroups));


?>
