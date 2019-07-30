<?php
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
header('Content-Type: text/html; charset=utf-8');
//beaccon-----------------------------------------------//
// ---------------------message 1 ----------------------//

//test----------------params- ยังบัค อยู่-----//

$serverName = "localhost";
$userName = "root";
$userPassword = "P@ssw0rd";
$dbName = "beacon_maejo";

$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($conn,"utf8");
$sql = "SELECT * FROM beacon ";

$query = mysqli_query($conn, $sql);

$result0 = mysqli_fetch_array($query, MYSQLI_ASSOC)

//--------------------------------------------------//

?>


<td><?php echo $result0["beacon_msg"];





    ?>

    <?php
    $wsdl = 'http://www.pttplc.com/webservice/pttinfo.asmx?wsdl';

    $client = new SoapClient($wsdl);

    $methodName = 'CurrentOilPrice';

    $params = array('Language' => 'TH');

    $soapAction = 'http://www.pttplc.com/ptt_webservice/CurrentOilPrice';

    $objectResult = $client->__soapCall($methodName, array('parameters' => $params), array('soapaction' => $soapAction));




    $xmlstring = $objectResult->CurrentOilPriceResult;



    $xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);



    echo $json;


    $obj = json_decode($json);
    foreach ($obj as $val) {
        echo $val->{'DataAccess'} . "<br>";
    }




    ?>



    <?php


    //


    // include composer autoload
    require_once 'vendor/autoload.php';

    // การตั้งเกี่ยวกับ bot
    require_once 'Api_Setting.php';
    require 'LINETypeMessage.php';

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
    use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder;
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

    // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
    $content = file_get_contents('php://input');
    file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
    $jsonData = json_decode($content,true);

    $eventtype = $jsonData["events"][0]["type"];
    $replyToken = $jsonData["events"][0]["replyToken"];
    // เก็บ userID
    $userID = $jsonData["events"][0]["source"]["userId"];
    // เก็บ text
    $text = $jsonData["events"][0]["message"]["text"];
    // เก็บ Timestamp
    $timestamp = $jsonData["events"][0]["timestamp"];

    $beacontype = $jsonData["events"][0]["beacon"]["type"];

    $beaconhwid = $jsonData["events"][0]["beacon"]["hwid"];

    $log = "INSERT INTO log (log_userid,log_event,log_text,log_beacon_type,log_beacon_hwid,log_timestamp) 
		VALUES ('$userID','$eventtype','$text','$beacontype','$beaconhwid','$timestamp')";

	$query = mysqli_query($conn,$log);

    
    // กำหนดค่า signature สำหรับตรวจสอบข้อมูลที่ส่งมาว่าเป็นข้อมูลจาก LINE
    $hash = hash_hmac('sha256', $content, LINE_MESSAGE_CHANNEL_SECRET, true);
    $signature = base64_encode($hash);

    // แปลงค่าข้อมูลที่ได้รับจาก LINE เป็น array ของ Event Object
    $events = $bot->parseEventRequest($content, $signature);
    $eventObj = $events[0]; // Event Object ของ array แรก
    $eventObj1 = $events[1];

    // ดึงค่าประเภทของ Event มาไว้ในตัวแปร มีทั้งหมด 7 event
    $eventType = $eventObj->getType();

    // สร้างตัวแปร ไว้เก็บ sourceId ของแต่ละประเภท
    $userId = NULL;
    $groupId = NULL;
    $roomId = NULL;
    // สร้างตัวแปร replyToken สำหรับกรณีใช้ตอบกลับข้อความ
    $replyToken = NULL;
    // สร้างตัวแปร ไว้เก็บค่าว่าเป้น Event ประเภทไหน
    $eventMessage = NULL;
    $eventPostback = NULL;
    $eventJoin = NULL;
    $eventLeave = NULL;
    $eventFollow = NULL;
    $eventUnfollow = NULL;
    $eventBeacon = NULL;

    //ตัวแปรเก็บ Beacon
    $beaconuserId = NULL;
    $beaconhw = NULL;
    $beacondm = NULL;

    // เงื่อนไขการกำหนดประเภท Event
    switch ($eventType) {
        case 'message':
            $eventMessage = true;
            break;
        case 'postback':
            $eventPostback = true;
            break;
        case 'join':
            $eventJoin = true;
            break;
        case 'leave':
            $eventLeave = true;
            break;
        case 'follow':
            $eventFollow = true;
            break;
        case 'unfollow':
            $eventUnfollow = true;
            break;
        case 'beacon':
            $eventBeacon = true;
            break;
    }
    // ------------------ greeting message --------------//


    if (!is_null($eventFollow)) {
        $userId = $eventObj->getUserId();
        $response = $bot->getProfile($userId);
        $userData = $response->getJSONDecodedBody(); // return array

        $textReplyMessage = 'hi';
        $replyData = new TextMessageBuilder($textReplyMessage);
    }
    // ------------------ greeting message --------------//
    //LINE BEACON --
    //if(!is_null($eventBeacon)){
    //$typeBeacon = $eventObj->getBeaconType();
    //if($typeBeacon=='enter'){
    //     $beaonhwid = $eventObj->getHwid(); // เก็บค่าข้อความที่ผู้ใช้พิมพ์
    //     $textReplyMessage = 'hi'.$beaonhwid ;
    //     $replyData = new TextMessageBuilder($textReplyMessage);

    //}
    //----------------------------------------------------------//

    //---------------------------------------------------------//


    if (!is_null($eventBeacon)) {

        $serverName = "localhost";
        $userName = "root";
        $userPassword = "P@ssw0rd";
        $dbName = "beacon_maejo";

        $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
        $date = date("Y-m-d H:i:s");

        $beaconhw = $eventObj->getHwId();
        $beaconuid = $eventObj->getUserId();

         //-----------------------config---------------------------website--//

         $web1 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='1' ";
         $queryweb1 = mysqli_query($conn, $web1);
         mysqli_set_charset($conn,"utf8");
         $resweb1 = mysqli_fetch_array($queryweb1);

         $web2 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='2' ";
         $queryweb2 = mysqli_query($conn, $web2);
         mysqli_set_charset($conn,"utf8");
         $resweb2 = mysqli_fetch_array($queryweb2);

         $web3 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='3' ";
         $queryweb3 = mysqli_query($conn, $web3);
         mysqli_set_charset($conn,"utf8");
         $resweb3 = mysqli_fetch_array($queryweb3);


         $web4 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='4' ";
         $queryweb4 = mysqli_query($conn, $web4);
         mysqli_set_charset($conn,"utf8");
         $resweb4 = mysqli_fetch_array($queryweb4);


         $web5 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='5' ";
         $queryweb5 = mysqli_query($conn, $web5);
         mysqli_set_charset($conn,"utf8");
         $resweb5 = mysqli_fetch_array($queryweb5);


         $web6 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='6' ";
         $queryweb6 = mysqli_query($conn, $web6);
         mysqli_set_charset($conn,"utf8");
         $resweb6 = mysqli_fetch_array($queryweb6);

         $web7 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='7' ";
         $queryweb7 = mysqli_query($conn, $web7);
         mysqli_set_charset($conn,"utf8");
         $resweb7 = mysqli_fetch_array($queryweb7);

         $web8 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='8' ";
         $queryweb8 = mysqli_query($conn, $web8);
         mysqli_set_charset($conn,"utf8");
         $resweb8 = mysqli_fetch_array($queryweb8);


         //--------------config header -----//


         

         //----sub header --//


        if ($beaconhw == "01265d5c2a") {

         
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_0 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon1 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='1' ";
            $querybeacon1 = mysqli_query($conn,$beacon1);
            mysqli_set_charset($conn,"utf8");
            $resbeacon1 = mysqli_fetch_array($querybeacon1);

            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 1 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb1["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon1["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon1["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 1 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

        } else if ($beaconhw == "01265fcfaf") {
           
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_1 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon2 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='2' ";
            $querybeacon2 = mysqli_query($conn,$beacon2);
            mysqli_set_charset($conn,"utf8");
            $resbeacon2 = mysqli_fetch_array($querybeacon2);

            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 2 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb2["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon2["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon2["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 1 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
        } else if ($beaconhw == "012d56174b") {
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_2 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon3 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='3' ";
            $querybeacon3 = mysqli_query($conn,$beacon3);
            mysqli_set_charset($conn,"utf8");
            $resbeacon3 = mysqli_fetch_array($querybeacon3);

            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 3 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb3["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon3["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon3["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 1 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        } else if ($beaconhw == "012db75b67") {
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_3 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon4 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='4' ";
            $querybeacon4 = mysqli_query($conn,$beacon4);
            mysqli_set_charset($conn,"utf8");
            $resbeacon4 = mysqli_fetch_array($querybeacon4);

            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 4 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb4["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon4["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon4["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 4 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        }else if ($beaconhw == "012db84e44") {
          
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_4 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon5 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='5' ";
            $querybeacon5 = mysqli_query($conn,$beacon5);
            mysqli_set_charset($conn,"utf8");
            $resbeacon5 = mysqli_fetch_array($querybeacon5);


            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 5 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb5["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon5["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon5["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 5 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
  


            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        }else if ($beaconhw == "012db8ebda") {
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_5 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon6 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='6' ";
            $querybeacon6 = mysqli_query($conn,$beacon6);
            mysqli_set_charset($conn,"utf8");
            $resbeacon6 = mysqli_fetch_array($querybeacon6);


            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 6 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb6["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon6["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon6["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 1 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        }else if ($beaconhw == "012dbae387") {
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_6 = '1' WHERE ble_base_member_uid = '$beaconuid'");

            $beacon7 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='7' ";
            $querybeacon7 = mysqli_query($conn,$beacon7);
            mysqli_set_charset($conn,"utf8");
            $resbeacon7 = mysqli_fetch_array($querybeacon7);



            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 7 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb7["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon7["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon7["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 1 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        }else if ($beaconhw == "012dbbc5d6") {
            $sql = mysqli_query($conn, " UPDATE ble_base SET  ble_base_7 = '1' WHERE ble_base_member_uid = '$beaconuid'");
            $beacon8 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='8' ";
            $querybeacon8 = mysqli_query($conn,$beacon8);
            mysqli_set_charset($conn,"utf8");
            $resbeacon8 = mysqli_fetch_array($querybeacon8);



            // กำหนด action 4 ปุ่ม 4 ประเภท
            $actionBuilder = array(
                new MessageTemplateActionBuilder(
                    'ศูนย์การเรียนรู้ที่ 8 ', // ข้อความแสดงในปุ่ม
                    'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                ),
                new UriTemplateActionBuilder(
                    'ข้อมูลเพื่มเติม', // ข้อความแสดงในปุ่ม
                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb8["beacon_has_websiteinfo_websiteinfo_id"]
                ),
               
            );
            $imageUrl = $resbeacon8["beacon_img_active"];
            $replyData = new TemplateMessageBuilder(
                'Button Template',
                new ButtonTemplateBuilder(
                    ''.$resbeacon8["beacon_header"], // ข้อความแสดงในปุ่ม // กำหนดหัวเรื่อง
                    'ศูนย์การเรียนรู้ที่ 8 ยินดีต้อนรับครับ', // กำหนดรายละเอียด
                    $imageUrl, // กำหนด url รุปภาพ
                    $actionBuilder  // กำหนด action object
                )

                
            );
            

            // $textReplyMessage = 'THIS IS number เครื่องสาม '.$beaconhw;
            // //$sql = mysqli_query($conn, "INSERT INTO beacon VALUES (NULL, '$beaconuid', '$beaconhw','$date')");
            // $replyData = new TextMessageBuilder($textReplyMessage);
        }else {
            $textReplyMessage = 'err';
            $replyData = new TextMessageBuilder($textReplyMessage);
        }
    }
    // สร้างตัวแปรเก็บค่า groupId กรณีเป็น Event ที่เกิดขึ้นใน GROUP
    if ($eventObj->isGroupEvent()) {
        $groupId = $eventObj->getGroupId();
    }
    // สร้างตัวแปรเก็บค่า roomId กรณีเป็น Event ที่เกิดขึ้นใน ROOM
    if ($eventObj->isRoomEvent()) {
        $roomId = $eventObj->getRoomId();
    }
    // ดึงค่า replyToken มาไว้ใช้งาน ทุกๆ Event ที่ไม่ใช่ Leave และ Unfollow Event
    if (is_null($eventLeave) && is_null($eventUnfollow)) {
        $replyToken = $eventObj->getReplyToken();
    }
    // ดึงค่า userId มาไว้ใช้งาน ทุกๆ Event ที่ไม่ใช่ Leave Event
    if (is_null($eventLeave)) {
        $userId = $eventObj->getUserId();
    }
    // ตรวจสอบถ้าเป็น Join Event ให้ bot ส่งข้อความใน GROUP ว่าเข้าร่วม GROUP แล้ว
    if (!is_null($eventJoin)) {
        $textReplyMessage = "ขอเข้ากลุ่มด้วยน่ะ GROUP ID:: " . $groupId;
        $replyData = new TextMessageBuilder($textReplyMessage);
    }
    // ตรวจสอบถ้าเป็น Leave Event เมื่อ bot ออกจากกลุ่ม





    // ตรวจสอบถ้าเป้น Message Event และกำหนดค่าตัวแปรต่างๆ
    if (!is_null($eventMessage)) {
        // สร้างตัวแปรเก็ยค่าประเภทของ Message จากทั้งหมด 8 ประเภท
        $typeMessage = $eventObj->getMessageType();
        //  text | image | sticker | location | audio | video | imagemap | template
        // ถ้าเป็นข้อความ
        if ($typeMessage == 'text') {
            $userMessage = $eventObj->getText(); // เก็บค่าข้อความที่ผู้ใช้พิมพ์
        }
        // ถ้าเป็น sticker
        if ($typeMessage == 'sticker') {
            $packageId = $eventObj->getPackageId();
            $stickerId = $eventObj->getStickerId();
        }
        // ถ้าเป็น location
        if ($typeMessage == 'location') {
            $locationTitle = $eventObj->getTitle();
            $locationAddress = $eventObj->getAddress();
            $locationLatitude = $eventObj->getLatitude();
            $locationLongitude = $eventObj->getLongitude();
        }
        // เก็บค่า id ของข้อความ
        $idMessage = $eventObj->getMessageId();
    }

    // ส่วนของการทำงาน
    if (!is_null($events)) {
        // ถ้าเป็น Postback Event
        if (!is_null($eventPostback)) {
            $dataPostback = NULL;
            $paramPostback = NULL;
            // แปลงข้อมูลจาก Postback Data เป็น array
            parse_str($eventObj->getPostbackData(), $dataPostback);
            // ดึงค่า params กรณีมีค่า params
            $paramPostback = $eventObj->getPostbackParams();
            // ทดสอบแสดงข้อความที่เกิดจาก Postaback Event
            $textReplyMessage = "ข้อความจาก Postback Event Data = ";
            $textReplyMessage .= json_encode($dataPostback);
            $textReplyMessage .= json_encode($paramPostback);
            $replyData = new TextMessageBuilder($textReplyMessage);
        }
        // ถ้าเป้น Message Event
        if (!is_null($eventMessage)) {
            switch ($typeMessage) { // กำหนดเงื่อนไขการทำงานจาก ประเภทของ message
                case 'text':  // ถ้าเป็นข้อความ
                    switch ($userMessage) {


                        case "Register":

                            $textReplyMessage = 'line://app/1649146443-56Z77P';
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;



                        case "-add":

                            $textReplyMessage = '####BOT NOK ####' . "\xA"  . 'เพื่มข้อมูลง่ายๆ พิมพ์ add และตามด้วย -เลขโน๊ต -หัวข้อ -เนื้อหา -วันที่ -เวลา -สถานที่  ' . "\xA"  . 'เช่นตัวอย่าง: ' . "\xA" . 'add,1,ชั้น17ไม่เรียบร้อย,PMเสร็จแต่ไม่ได้เก็บของกลับมาเช่นปริ้นเตอร์,19960101,09:30,BA';
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;


                        case "t_b":
                            // กำหนด action 4 ปุ่ม 4 ประเภท
                            $actionBuilder = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันจันทร์', // ข้อความแสดงในปุ่ม
                                    'เกิดวันจันทร์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new MessageTemplateActionBuilder(
                                    'เกิดวันอังคาร', // ข้อความแสดงในปุ่ม
                                    'เกิดวันอังคาร' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new MessageTemplateActionBuilder(
                                    'เกิดวันพุธ', // ข้อความแสดงในปุ่ม
                                    'เกิดวันพุธ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new MessageTemplateActionBuilder(
                                    'เกิดวันเสาร์', // ข้อความแสดงในปุ่ม
                                    'เกิดวันเสาร์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                            );
                            $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                            $replyData = new TemplateMessageBuilder(
                                'Button Template',
                                new ButtonTemplateBuilder(
                                    'button template builder', // กำหนดหัวเรื่อง
                                    'Please select', // กำหนดรายละเอียด
                                    $imageUrl, // กำหนด url รุปภาพ
                                    $actionBuilder  // กำหนด action object
                                )
                            );
                            break;

                        case "t_ic":

                            $actionBuilder = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันจันทร์ ', // ข้อความแสดงในปุ่ม
                                    'เกิดวันจันทร์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'รายละเอียดเพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_1.html'
                                ),

                            );
                            $actionBuilder2 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันอังคาร ', // ข้อความแสดงในปุ่ม
                                    'เกิดวันอังคาร' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_2.html'
                                ),
                            );

                            $actionBuilder3 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันพุธ', // ข้อความแสดงในปุ่ม
                                    'เกิดวันพุธ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_3.html'
                                ),
                            );
                            $actionBuilder4 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันพฤหัสฯ', // ข้อความแสดงในปุ่ม
                                    'เกิดวันพฤหัสฯ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_3.html'
                                ),
                            );
                            $actionBuilder5 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันศุกร์', // ข้อความแสดงในปุ่ม
                                    'เกิดวันศุกร์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_3.html'
                                ),
                            );
                            $actionBuilder6 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันเสาร์', // ข้อความแสดงในปุ่ม
                                    'เกิดวันเสาร์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_3.html'
                                ),
                            );
                            $actionBuilder7 = array(
                                new MessageTemplateActionBuilder(
                                    'เกิดวันอาทิตย์', // ข้อความแสดงในปุ่ม
                                    'เกิดวันอาทิตย์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/base_3.html'
                                ),
                            );
                            $replyData = new TemplateMessageBuilder(
                                'Carousel',
                                new CarouselTemplateBuilder(
                                    array(
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',

                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/1.jpg',
                                            $actionBuilder
                                        ),
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/5.jpg',
                                            $actionBuilder2
                                        ),

                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/3.jpg',
                                            $actionBuilder3
                                        ),
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/2.jpg',
                                            $actionBuilder4
                                        ),
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/4.jpg',
                                            $actionBuilder5
                                        ),
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/7.jpg',
                                            $actionBuilder6
                                        ),
                                        new CarouselColumnTemplateBuilder(
                                            'เช็คดวงชะตาของคุณ',
                                            'กดปุ่มเพื่อตรวจดวงชะตา',
                                            'https://www.pnall.co.th/apps/line/beacon_maejo/img/a/6.jpg',
                                            $actionBuilder7
                                        ),
                                    )
                                )
                            );
                            break;


                        case "checkbase":


                            $serverName = "localhost";
                            $userName = "root";
                            $userPassword = "P@ssw0rd";
                            $dbName = "beacon_maejo";
                            $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
                            $beaconuid = $eventObj->getUserId();

                            if (!is_null($groupId) || !is_null($roomId)) {
                                if ($eventObj->isGroupEvent()) {
                                    $response = $bot->getGroupMemberProfile($groupId, $userId);
                                }
                                if ($eventObj->isRoomEvent()) {
                                    $response = $bot->getRoomMemberProfile($roomId, $userId);
                                }
                            } else {
                                $response = $bot->getProfile($userId);
                            }
                            if ($response->isSucceeded()) {
                                $userData = $response->getJSONDecodedBody(); // return array
                                // $userData['userId']
                                // $userData['displayName']
                                // $userData['pictureUrl']
                                $user_beacon_check = "";
                                $user_beacon_check = $userData['userId'];




                                $sql = "SELECT * FROM ble_base WHERE ble_base_member_uid='$user_beacon_check'";
                                $query = mysqli_query($conn, $sql);
                                $res = mysqli_fetch_array($query);



                                $textReplyMessage = 'สวัสดีครับ คุณ ' . $userData['displayName'] . "\xA"  . '  คุณได้ผ่านฐานที่ 1 = ' . $res['ble_base_0']  . "\xA"  . '  คุณได้ผ่านฐานที่ 2 = ' . $res['ble_base_1'] . "\xA"  . '  คุณได้ผ่านฐานที่ 3 = ' . $res['ble_base_2'];
                            } else {
                                $textReplyMessage = 'สวัสดีครับ คุณคือใคร';
                            }
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;



                            case "p":
                                      

                                                                
                            if(!is_null($groupId) || !is_null($roomId)){
                                if($eventObj->isGroupEvent()){
                                    $response = $bot->getGroupMemberProfile($groupId, $userId);
                                }
                                if($eventObj->isRoomEvent()){
                                    $response = $bot->getRoomMemberProfile($roomId, $userId);    
                                }
                            }else{
                                $response = $bot->getProfile($userId);
                            }
                            if ($response->isSucceeded()) {
                                $userData = $response->getJSONDecodedBody(); // return array     
                                // $userData['userId']
                                // $userData['displayName']
                                // $userData['pictureUrl']
                                // $userData['statusMessage']

                                    //-------------------------------------------------//
                                                              
                                include('admin/phpqrcode/qrlib.php'); 

                                // how to save PNG codes to server 
                                
                                $tempDir = 'qrcode/'; 
                                
                                $codeContents = $userData['userId']; 
                                
                                // we need to generate filename somehow,  
                                // with md5 or with database ID used to obtains $codeContents... 
                                $fileName = '005_file_'.md5($codeContents).'.png'; 
                                
                                $pngAbsoluteFilePath = 'qrcode/'.$tempDir.$fileName; 
                                $urlRelativeFilePath = 'qrcode/'.$fileName; 
                                
                                // generating 
                                if (!file_exists($pngAbsoluteFilePath)) { 
                                    QRcode::png($codeContents, $pngAbsoluteFilePath); 
                                    echo 'File generated!'; 
                                    echo '<hr />'; 
                                } else { 
                                    echo 'File already generated! We can use this cached file to speed up site on common codes!'; 
                                    echo '<hr />'; 
                                } 
                                
                                echo 'Server PNG File: '.$pngAbsoluteFilePath; 
                                echo '<hr />'; 
                                
                                // displaying 
                                echo '<img src="qrcode/'.$urlRelativeFilePath.'" />'; 
                             
                                $picFullSize = 'https://www.pnall.co.th/apps/line/beacon_maejo/qrcode/'.$urlRelativeFilePath;
                                $picThumbnail = 'https://www.pnall.co.th/apps/line/beacon_maejo/qrcode/'.$urlRelativeFilePath;
                                $replyData = new ImageMessageBuilder($picFullSize,$picThumbnail);
                            
                            }else{
                                $textReplyMessage = "nope";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                                break;
                            }
                        break;                          


                        case "ราคาน้ำมัน":
                            $textReplyMessage = $json;
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันอาทิตย์":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันอาทิตย์ ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: การเจรจา การตัดสินใจจะประสบความสำเร็จ ประสบความโชคดี ประสบความก้าวหน้าที่ดี\n\nการเงิน: ประสบความล่าช้าทางด้านการเงิน แต่สุดท้ายก็จะสามารถหาเข้ามาได้เพิ่มเติมเพิ่มมากขึ้น\n\nความรัก: โดยภาพรวม ความสัมพันธ์ด้านความรักก็ถือว่าลงตัว อยู่ในเกณฑ์ที่ดี\n\nอัญมณีมงคล: ไข่มุก\n\nสีมงคล: ขาว\n\nเลขนำโชค: 2,5,7,9";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันจันทร์":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันจันทร์ ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: การติดต่อ การประสานงานต่างๆ จะประสบความสำเร็จอยู่ในเกณฑ์ที่ดี\n\nการเงิน: หามาได้ก็เก็บเงินไม่อยู่ หามาได้ก็ต้องใช้จ่ายออกไป เป็นการหมุนเงินให้ผ่านพ้นไปได้\n\nความรัก: สุขสมหวังด้านความรัก มีโอกาสพัฒนาความสัมพันธ์  ความรักอยู่ในเกณฑ์ที่ดีมากๆ\n\nอัญมณีมงคล: พลอยสีชมพู\n\nสีมงคล: ชมพู\n\nเลขนำโชค: 1,5,6";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันอังคาร":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันอังคาร ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: ประสบความสำเร็จทางด้านการงานดีขึ้น การเจรจาต่อรองประสบความสำเร็จได้ดีขึ้นไปอีก\n\nการเงิน: หามาได้มากก็จะใช้จ่ายออกไปมาก ในช่วงนี้ไม่สามารถเก็บเงินได้ดีเท่าไรนัก\n\nความรัก: ยังไม่ตัดสินใจด้านความรัก หรือจะพบเจอเหตุการณ์ที่ทำให้เกิดความเหินห่างระหว่างกัน\n\nอัญมณีมงคล: ไพลิน\n\nสีมงคล: น้ำเงิน\n\nเลขนำโชค: 3,5,6,7";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันพุธ":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันพุธ ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: จะทำงานใดๆ จะประสบความสำเร็จ และจะพบเจอความโชคดีไปทุกอย่าง ทำอะไรก็สำเร็จ\n\nการเงิน: โชคดี มีโชคจะได้เงินเข้ามาเพิ่มเติมมากขึ้นก็เป็นไปได้ เพราะจะพบผู้อุปถัมภ์ทางด้านการเงิน\n\nความรัก: ความสัมพันธ์ทางด้านความรักค่อยๆ ดีขึ้น ก็เพราะแบ่งเวลาให้กับคนรักได้มากขึ้น\n\nอัญมณีมงคล: หยก\n\nสีมงคล:  เขียว\n\nเลขนำโชค: 1,2,5,7,9";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันพฤหัสฯ":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันพฤหัสบดี ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: การเจรจาต่อรองทางด้านการงานเกิดความโชคดี และความสำเร็จที่น่าพอใจ\n\nการเงิน: ระวังการใช้จ่ายเงินให้ดี ยังประมาทในเรื่องของการใช้จ่ายไม่ได้ และต้องประหยัดเข้าไว้\n\nความรัก: ระวังจะพบเรื่องความสัมพันธ์ที่ผิวเผิน เพราะจะเจอเรื่องที่ไม่ชัดเจนด้านความรัก\n\nอัญมณีมงคล: บุษราคัม\n\nสีมงคล: เหลือง\n\nเลขนำโชค: 4,6,8";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันศุกร์":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันศุกร์ ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: ยังพิจารณาแผนงานอยู่ มีโอกาสเดินทางติดต่อหรือโยกย้ายด้านการงานบ่อยขึ้นมากๆ\n\nการเงิน: สามารถหาเข้ามาได้อย่างต่อเนื่อง ด้วยความขยันของตนเอง จะสามารถหาเงินเข้ามาได้อย่างเป็นโชคดี\n\nความรัก: ยังคงไม่แน่ใจในสถานการณ์ด้านความรัก ยังคงดูๆ อยู่มากกว่าที่จะตัดสินใจด้านความรัก\n\nอัญมณีมงคล: มรกต\n\nสีมงคล: เขียว\n\nเลขนำโชค: 0,1,6,7,8";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "เกิดวันเสาร์":
                            $textReplyMessage = "ดูดวงรายวันสำหรับท่านที่เกิดวันเสาร์ ประจำวันศุกร์ ที่ 2 พฤศจิกายน 2561\n\nการงาน: ด้วยความรู้ ความสามารถในการติดต่อเจรจากับผู้ใหญ่ จะทำให้เกิดความสำเร็จที่น่าพอใจ\n\nการเงิน: มีเรื่องที่ต้องใช้จ่ายออกไปมาก แต่ก็จะสามารถหมุนหาเข้ามาใช้จ่ายได้เพิ่มเติมมากขึ้น\n\nความรัก: มีเสน่ห์มากๆ ในช่วงนี้ จึงมีคนอยากเข้ามาทักทาย ทำความรู้จักด้วย\n\nอัญมณีมงคล: ทับทิม\n\nสีมงคล: แดง\n\nเลขนำโชค: 1,2,3,6,9";
                            $replyData = new TextMessageBuilder($textReplyMessage);
                            break;

                        case "t_c":

                            $serverName = "localhost";
                            $userName = "root";
                            $userPassword = "P@ssw0rd";
                            $dbName = "beacon_maejo";
                            $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
                            
                            $beaconuid = $eventObj->getUserId();

                            if (!is_null($groupId) || !is_null($roomId)) {
                                if ($eventObj->isGroupEvent()) {
                                    $response = $bot->getGroupMemberProfile($groupId, $userId);
                                }
                                if ($eventObj->isRoomEvent()) {
                                    $response = $bot->getRoomMemberProfile($roomId, $userId);
                                }
                            } else {
                                $response = $bot->getProfile($userId);
                            }
                            if ($response->isSucceeded()) {
                                $userData = $response->getJSONDecodedBody(); // return array
                                // $userData['userId']
                                // $userData['displayName']
                                // $userData['pictureUrl']
                                $user_beacon_check = "";
                                $user_beacon_check = $userData['userId'];
                            }

                            $sql = "SELECT * FROM ble_base WHERE ble_base_member_uid='$user_beacon_check'";
                            $query = mysqli_query($conn, $sql);
                            $res = mysqli_fetch_array($query);

                            //-----------------------config---------------------------website--//

                            $web1 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='1' ";
                            $queryweb1 = mysqli_query($conn, $web1);
                            mysqli_set_charset($conn,"utf8");
                            $resweb1 = mysqli_fetch_array($queryweb1);

                            $web2 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='2' ";
                            $queryweb2 = mysqli_query($conn, $web2);
                            mysqli_set_charset($conn,"utf8");
                            $resweb2 = mysqli_fetch_array($queryweb2);

                            $web3 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='3' ";
                            $queryweb3 = mysqli_query($conn, $web3);
                            mysqli_set_charset($conn,"utf8");
                            $resweb3 = mysqli_fetch_array($queryweb3);


                            $web4 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='4' ";
                            $queryweb4 = mysqli_query($conn, $web4);
                            mysqli_set_charset($conn,"utf8");
                            $resweb4 = mysqli_fetch_array($queryweb4);


                            $web5 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='5' ";
                            $queryweb5 = mysqli_query($conn, $web5);
                            mysqli_set_charset($conn,"utf8");
                            $resweb5 = mysqli_fetch_array($queryweb5);


                            $web6 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='6' ";
                            $queryweb6 = mysqli_query($conn, $web6);
                            mysqli_set_charset($conn,"utf8");
                            $resweb6 = mysqli_fetch_array($queryweb6);

                            $web7 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='7' ";
                            $queryweb7 = mysqli_query($conn, $web7);
                            mysqli_set_charset($conn,"utf8");
                            $resweb7 = mysqli_fetch_array($queryweb7);

                            $web8 = "SELECT beacon_has_websiteinfo_websiteinfo_id FROM beacon_has_websiteinfo WHERE beacon_has_websiteinfo_beacon_id ='8' ";
                            $queryweb8 = mysqli_query($conn, $web8);
                            mysqli_set_charset($conn,"utf8");
                            $resweb8 = mysqli_fetch_array($queryweb8);

                            //----sub header --//



                            
                            $beacon1 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='1' ";
                            $querybeacon1 = mysqli_query($conn,$beacon1);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon1 = mysqli_fetch_array($querybeacon1);

                            $beacon2 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='2' ";
                            $querybeacon2 = mysqli_query($conn,$beacon2);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon2 = mysqli_fetch_array($querybeacon2);

                            $beacon3 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='3' ";
                            $querybeacon3 = mysqli_query($conn,$beacon3);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon3 = mysqli_fetch_array($querybeacon3);

                            $beacon4 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='4' ";
                            $querybeacon4 = mysqli_query($conn,$beacon4);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon4 = mysqli_fetch_array($querybeacon4);

                            $beacon5 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='5' ";
                            $querybeacon5 = mysqli_query($conn,$beacon5);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon5 = mysqli_fetch_array($querybeacon5);

                            $beacon6 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='6' ";
                            $querybeacon6 = mysqli_query($conn,$beacon6);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon6 = mysqli_fetch_array($querybeacon6);

                            $beacon7 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='7' ";
                            $querybeacon7 = mysqli_query($conn,$beacon7);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon7 = mysqli_fetch_array($querybeacon7);

                            $beacon8 = "SELECT beacon_header,beacon_img_active FROM beacon WHERE beacon_id ='8' ";
                            $querybeacon8 = mysqli_query($conn,$beacon8);
                            mysqli_set_charset($conn,"utf8");
                            $resbeacon8 = mysqli_fetch_array($querybeacon8);



                            //sub head blank

                            
                                 
                            $beacon1_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='1' ";
                            $querybeacon1_blank = mysqli_query($conn,$beacon1_blank);
                            $resbeacon1_blank = mysqli_fetch_array($querybeacon1_blank);

                            $beacon2_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='2' ";
                            $querybeacon2_blank = mysqli_query($conn,$beacon2_blank);
                            $resbeacon2_blank = mysqli_fetch_array($querybeacon2_blank);

                            $beacon3_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='3' ";
                            $querybeacon3_blank = mysqli_query($conn,$beacon3_blank);
                            $resbeacon3_blank = mysqli_fetch_array($querybeacon3_blank);

                            $beacon4_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='4' ";
                            $querybeacon4_blank = mysqli_query($conn,$beacon4_blank);
                            $resbeacon4_blank = mysqli_fetch_array($querybeacon4_blank);

                            $beacon5_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='5' ";
                            $querybeacon5_blank = mysqli_query($conn,$beacon5_blank);
                            $resbeacon5_blank = mysqli_fetch_array($querybeacon5_blank);

                            $beacon6_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='6' ";
                            $querybeacon6_blank = mysqli_query($conn,$beacon6_blank);
                            $resbeacon6_blank = mysqli_fetch_array($querybeacon6_blank);

                            $beacon7_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='7' ";
                            $querybeacon7_blank = mysqli_query($conn,$beacon7_blank);
                            $resbeacon7_blank = mysqli_fetch_array($querybeacon7_blank);

                            $beacon8_blank = "SELECT beacon_header_blank,beacon_img_inactive FROM beacon WHERE beacon_id ='8' ";
                            $querybeacon8_blank = mysqli_query($conn,$beacon8_blank);
                            $resbeacon8_blank = mysqli_fetch_array($querybeacon8_blank);

                            
                                

                          //-----------------------config----------------website--------------//
                            // กำหนด action 4 ปุ่ม 4 ประเภท
                            $actionBuilder = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 1', // ข้อความแสดงในปุ่ม
                                    'base1_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb1["beacon_has_websiteinfo_websiteinfo_id"]
                                ),

                            );
                            $actionBuilder2 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 2', // ข้อความแสดงในปุ่ม
                                    'base2_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb2["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            );
                            $actionBuilder3 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 3 ', // ข้อความแสดงในปุ่ม
                                    'base3_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb3["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            );

                            $actionBuilder4 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 4 ', // ข้อความแสดงในปุ่ม
                                    'base4_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb4["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            
                            );

                            $actionBuilder5 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 5 ', // ข้อความแสดงในปุ่ม
                                    'base5_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb5["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                               
                            );

                            $actionBuilder6 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 6 ', // ข้อความแสดงในปุ่ม
                                    'base6_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb6["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            );

                            $actionBuilder7 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 7 ', // ข้อความแสดงในปุ่ม
                                    'base7_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb7["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            );

                            $actionBuilder8 = array(
                                new MessageTemplateActionBuilder(
                                    'รายละเอียดฐานที่ 8 ', // ข้อความแสดงในปุ่ม
                                    'base8_details' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                ),
                                new UriTemplateActionBuilder(
                                    'เว็บไซต์เพื่มเติม', // ข้อความแสดงในปุ่ม
                                    'https://www.pnall.co.th/apps/line/beacon_maejo/info/main.php?page='.$resweb8["beacon_has_websiteinfo_websiteinfo_id"]
                                ),
                            );



                            if ($res['ble_base_0'] == 0) {
                                $buliderflex1 = new CarouselColumnTemplateBuilder(
                                   ''.$resbeacon1_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_0'] . ' แต้ม',
                                    ''.$resbeacon1_blank["beacon_img_inactive"],
                                    
                                    $actionBuilder
                                );
                            }
                            if ($res['ble_base_0'] == 1) {
                                $buliderflex1 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon1["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_0'] . ' แต้ม',

                                    ''.$resbeacon1["beacon_img_active"],
                                    $actionBuilder
                                );
                            }
                            if ($res['ble_base_1'] == 0) {
                                $buliderflex2 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon2_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_1'] . ' แต้ม',
                                    ''.$resbeacon2_blank["beacon_img_inactive"],
                                  
                                    $actionBuilder2
                                );
                            }
                            if ($res['ble_base_1'] == 1) {
                                $buliderflex2 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon2["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_1'] . ' แต้ม',

                                    ''.$resbeacon2["beacon_img_active"],
                                    $actionBuilder2
                                );
                            }
                            if ($res['ble_base_2'] == 0) {
                                $buliderflex3 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon3_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_2'] . ' แต้ม',
                                    ''.$resbeacon3_blank["beacon_img_inactive"],
                                   
                                    $actionBuilder3
                                );
                            }
                            if ($res['ble_base_2'] == 1) {
                                $buliderflex3 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon3["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_2'] . ' แต้ม',

                                    ''.$resbeacon3["beacon_img_active"],
                                    $actionBuilder3
                                );
                            } 
                            if ($res['ble_base_3'] == 0) {
                                $buliderflex4 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon4_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_3'] . ' แต้ม',
                                    ''.$resbeacon4_blank["beacon_img_inactive"],
                                    
                                    $actionBuilder4
                                );
                            }
                            if ($res['ble_base_3'] == 1) {
                                $buliderflex4 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon4["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_3'] . ' แต้ม',

                                    ''.$resbeacon4["beacon_img_active"],
                                    $actionBuilder4
                                );
                            }  if ($res['ble_base_4'] == 0) {
                                $buliderflex5 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon5_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_4'] . ' แต้ม',

                                    ''.$resbeacon5_blank["beacon_img_inactive"],
                                    $actionBuilder5
                                );
                            }
                            if ($res['ble_base_4'] == 1) {
                                $buliderflex5 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon5["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_4'] . ' แต้ม',
                                    ''.$resbeacon5["beacon_img_active"],
                                   
                                    $actionBuilder5
                                );
                            }  if ($res['ble_base_5'] == 0) {
                                $buliderflex6 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon6_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_5'] . ' แต้ม',
                                    ''.$resbeacon6_blank["beacon_img_inactive"],
                                   
                                    $actionBuilder6
                                );
                            }
                            if ($res['ble_base_5'] == 1) {
                                $buliderflex6 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon6["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_5'] . ' แต้ม',
                                    ''.$resbeacon6["beacon_img_active"],
                                   
                                    $actionBuilder6
                                );
                            }  if ($res['ble_base_6'] == 0) {
                                $buliderflex7 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon7_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_6'] . ' แต้ม',
                                    ''.$resbeacon7_blank["beacon_img_inactive"],
                                   
                                    $actionBuilder7
                                );
                            }
                            if ($res['ble_base_6'] == 1) {
                                $buliderflex7 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon7["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_6'] . ' แต้ม',
                                    ''.$resbeacon7["beacon_img_active"],
                                   
                                    $actionBuilder7
                                );
                            }  if ($res['ble_base_7'] == 0) {
                                $buliderflex8 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon8_blank["beacon_header_blank"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_7'] . ' แต้ม',

                                    ''.$resbeacon8_blank["beacon_img_inactive"],
                                    $actionBuilder8
                                );
                            }
                            if ($res['ble_base_7'] == 1) {
                                $buliderflex8 = new CarouselColumnTemplateBuilder(
                                    ''.$resbeacon8["beacon_header"],
                                    'ตอนนี้คุณได้คะแนนทั้งหมด'  . $res['ble_base_7'] . ' แต้ม',
                                    ''.$resbeacon8["beacon_img_active"],
                                
                                    $actionBuilder8
                                );
                            } else {
                                $textReplyMessage = "ท่านยังไม่ได้เดินเก็บไอเทมเลย";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                            }

                            $replyData = new TemplateMessageBuilder(
                                'Carousel',
                                new CarouselTemplateBuilder(


                                    array(

                                        ($buliderflex1),
                                        ($buliderflex2),
                                        ($buliderflex3),
                                        ($buliderflex4),
                                        ($buliderflex5),
                                        ($buliderflex6),
                                        ($buliderflex7),
                                        ($buliderflex8),


                                    )
                                )
                            );
                    }
                    break;
            }
        }
    }

    $response = $bot->replyMessage($replyToken, $replyData);
    if ($response->isSucceeded()) {
        echo 'Succeeded!';
        return;
    }
    // Failed
    echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    ?>