<?php


// include composer autoload
require_once 'vendor/autoload.php';

// การตั้งเกี่ยวกับ bot
require_once 'Api_Setting.php';



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
$content = file_get_contents('php://input');


 date_default_timezone_set("Asia/Bangkok");
$date = date("Y-m-d");
$time = date("H:i:s");

$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";

$name = $_REQUEST['name'];
$member_type = $_REQUEST['member_type'];
$id = $_REQUEST['userid'];

 $connect=mysqli_connect($serverName,$userName,$userPassword,$dbName)or die("connecterror");


 mysqli_set_charset($connect,"utf8");
 $sql = "select member_uid from member where member_uid='$id' group by member_id";
 $result = mysqli_query($connect,$sql) or die ("error1");
 $count_row = mysqli_num_rows($result);
 if($count_row < 1){

 $query = "INSERT INTO member(member_uid,member_name,member_type,member_date) VALUE ('$id', '$name','$member_type',NOW())";
 $resource = mysqli_query($connect,$query) or die ("error2");
 $query2 = "INSERT INTO ble_base(ble_base_member_uid,ble_base_0,ble_base_1,ble_base_2,ble_base_3,ble_base_4,ble_base_5,ble_base_6,ble_base_7) VALUE ('$id','0','0','0','0','0','0','0','0')";
 $resource2 = mysqli_query($connect,$query2) or die ("error2");


 echo "<br/><br/>";
 echo '<h1 align="center"><font color="red">*** ยินดีด้วยครับ คุณลงทะเบียนสำเร็จแล้ว ***</font></h1>';
 echo '<h1 align=”center"><font color="red"> กดที่เครื่องหมาย X มุมขวาบนเพื่อปิดหน้าต่างนี้</font></h1>';
 }else{
    echo '<h1 align="center"><font color="red">*** ขอโทษด้วยครับ คุณเคยลงทะเบียนแล้ว ***</font></h1>';
    echo '<h1 align=”center"><font color="red"> กดที่เครื่องหมาย X มุมขวาบนเพื่อปิดหน้าต่างนี้</font></h1>';
 }
?>
