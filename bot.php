<?php
// Creat by geeksesi
//   Geeksesi.ir
//      @geeksesi_javad
//          @geeksesi
// 
// GNU GENERAL PUBLIC LICENSE
define('BOT_TOKEN', 'TOKEN_PLEASE');
function apiRequestWebhook($method, $parameters)
{
    //!!! $method must be a string !!!
    if (!is_string($method))
    {
        error_log("Method name must be a string\n");
        return false;
    }
    if (!$parameters) 
    {
        $parameters = array();
    }
    else if (!is_array($parameters)) 
    {
        error_log("Parameters must be an array\n");
        return false;
    }
    $parameters["method"] = $method;
    header("Content-Type: application/json");
    echo json_encode($parameters);
    return true;
}

$content = file_get_contents("php://input");
$update = json_decode($content, true);
//$update['message']['chat]['type'] ==> private or grope or channel !
if (!$update)
{
    exit;
}
// $me_id = '91416644' ;
$channel_id = 'YOUR_CHANNEL_ID';
if (isset($update["message"])) 
{
        // apiRequestWebhook("sendMessage", ["chat_id" => $update['message']['chat']['id'], "text" => $update]);
        // error_log($update['message']['chat']['id']);
    if (isset($update["message"]["text"]) && $update["message"]["text"] == "!sendgp" && isset($update["message"]["reply_to_message"])) 
    {
        apiRequestWebhook("forwardMessage", ["chat_id" => $channel_id, "from_chat_id" => $update['message']['chat']['id'], "message_id" => $update["message"]["reply_to_message"]["message_id"]]);
    }
}