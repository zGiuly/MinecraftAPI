<?php
/**
 * @author zGiuly_
 * Test minecraft scanner
 */
include 'Request.php';
include 'settings.php';
if($settings['enable_secure_key']) {
    $Request = new Request($_GET['ip'], $settings['secure_key'], $_GET['key']);
}else{
    $Request = new Request($_GET['ip'], $settings['secure_key'], $settings['secure_key']);
}
if(!$Request->KeyValidator()){
    die("Key not valid");
}else {
    $status = $Request->getResource("status");
    if ($status == true) {
    $motd = $Request->getResource("motd");
    $player = $Request->getResource("player");
    $player_max = $Request->getResource("player_max");
    $server_name = $Request->getResource("server_name");
    echo "Motd: " . $motd . "\n Player: " . $player . "\n Player max: $player_max" . "\n Server name: $server_name";
    }else{
        $Request->Logger("Server offline");
        die("Server offline");
    }
}