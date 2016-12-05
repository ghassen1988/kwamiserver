<?php
//Get featuredEvents
    $url='http://www.webtickets.co.za/MyService/wsWebtickets.asmx/GetAllEventsByCategory?&intCategoryId=1184162';
$fileContents = file_get_contents($url);
// removes newlines, returns and tabs
$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
// replace double quotes with single quotes, to ensure the simple XML function can parse the XML
$fileContents = trim(str_replace('"', "'", $fileContents));
    $xml = simplexml_load_string($fileContents);
    $data = array();

    $elements = array();
$i = 0;

    foreach ($xml->EventData as $event) {
        $i++;
        //echo $event->EventLink.'<br>';
       // array_push($data, (object)array('text' => $event->EventLink.""));
        $buttons = array();
        array_push($buttons, (object)array('type' => "web_url",'url' => $event->EventLink."",'title' => "Book"));
        array_push($elements, (object)array('title' => $event->Name."",'image_url' => $event->EventImageLink."",'subtitle' => strip_tags($event->Description."", ""),'buttons' => $buttons));

        if($i==9) break;
    }
    $wrapper = array((object)array('attachment' => (object)array('type' => 'template', 'payload' => (object)array('template_type' => 'generic', 'elements' => $elements))));

    $json = json_encode($wrapper);
    echo $json;
//echo '<pre>';
//var_dump($wrapper);

    exit;
