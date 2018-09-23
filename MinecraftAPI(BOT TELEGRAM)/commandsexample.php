<?php
/**
 * @author zGiuly
 */
include 'Request.php';
$msg = null;
if(stripos($msg, "/scan")===0){
    $e = explode(" ", $msg, 3);
    $ip = $e[1];
    if(!empty($ip)){
        $Request = new Request($ip);
        $status = $Request->getResource("status");
        if ($status == true) {
            $motd = $Request->getResource("motd");
            $player = $Request->getResource("player");
            $player_max = $Request->getResource("player_max");
            $server_name = $Request->getResource("server_name");
            echo "Motd: " . $motd . "\n Player: " . $player . "\n Player max: $player_max" . "\n Server name: $server_name";
            $Request->Logger($Request->getAll(false));
        }
    }else{

    }
}