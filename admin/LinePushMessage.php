<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// include composer autoload
require_once '../vendor/autoload.php';

// การตั้งเกี่ยวกับ bot
require_once '../Api_Setting.php';

// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;



 
$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));

$redirect = $_POST["member_id"];

$member_name = $_POST["member_name"];
$member_uid = $_POST["member_uid"];

$messagesent = $_POST["message"];
$date = date('Y-m-d H:i:s');
// $adminsent = $_SESSION["admin_name"];

$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";
  $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
  mysqli_set_charset($conn,"utf8");
  $sql = "INSERT INTO line_push (line_push_message,line_push_sent_to,line_push_sent_by,line_push_time)
          VALUE ('$messagesent','$member_uid','".$_SESSION["admin_id"]."','$date')
           ";
  $query = mysqli_query($conn,$sql);



  if($query){
    $userId = $member_uid;
    // ทดสอบส่ง push ข้อความอย่างง่าย
    $textPushMessage = $messagesent;                
    $messageData = new TextMessageBuilder($textPushMessage);        
                 
    $response = $bot->pushMessage($userId,$messageData);
    if ($response->isSucceeded()) {
        echo 'Succeeded!';
        header( "refresh:1;url=../admin/checkmemberinfo.php?member_id=".$redirect );
    }
  }else{
      echo "error";
  }
// userId 

 
// Failed
// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>