<?php
/** Request */
class Request
{
    /** Costructor */
    private $ip, $request;
    function __construct($ip)
    {
        $this->request = curl_init();
        $this->ip = $ip;
    }
    /** @inheritdoc Curl request */
    private function Curl_request(){
        curl_setopt_array($this->request, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => 'https://mcapi.us/server/status?ip='.$this->ip
        ]);
        return curl_exec($this->request);
    }
    /** @inheritdoc Json decode */
    public function Getall($json = false) {
        if($json == true) {
            return json_decode($this->Curl_request(), true);
        }else{
            self::jsonSave($this->Curl_request());
            return $this->Curl_request();
        }
    }
    /** @inheritdoc GetResource */
    public function getResource($type){
        $r = json_decode(self::Getall(false), true);
        switch ($type){
            case 'player':
                return $r['players']['now'];
                break;
            case 'player_max':
                return $r['players']['max'];
                break;
            case 'server_name':
                return $r['server']['name'];
                break;
            case 'status':
                return $r['online'];
                break;
            case 'motd':
                return $r['motd'];
                break;
            default:
                return null;
                break;
        }
    }
    /** @inheritdoc Text logger */
    public function Logger($text) {
        if(!file_exists("minecraftapi.log")){
            file_put_contents("minecraftapi.log", $text);
        }else {
            file_put_contents("minecraftapi.log", "\n".$text, FILE_APPEND);
        }
    }
    /** @inheritdoc Save json results */
    private function jsonSave($results){
        file_put_contents("data.json", $results);
    }
}
