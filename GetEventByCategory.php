
<?php
/**
 * Created by PhpStorm.
 * User: ghassen
 * Date: 05/12/16
 * Time: 12:31 م
 */
$url = "http://www.webtickets.co.za/MyService/wsWebtickets.asmx/GetEventCategories";
$fileContents = file_get_contents($url);
// removes newlines, returns and tabs
$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
// replace double quotes with single quotes, to ensure the simple XML function can parse the XML
$fileContents = trim(str_replace('"', "'", $fileContents));

$xml = simplexml_load_string($fileContents);
$data = array();
$elements = array();
$arr = array('http://www.becomeablogger.com/wp-content/uploads/2015/10/233_Categories_Tags_Featured-881x367.jpg','http://northfieldartsguild.org/_file/Music.jpg','http://ampthemag.com/wp-content/uploads/2016/05/musicfestival1.jpg','http://ecoleracine.com/wp-content/uploads/2016/10/tourisme.png','http://aquitaine.media.tourinsoft.eu/upload/Theatre-108.jpg','http://laligue03.org/wp-content/uploads/2015/05/sport.png');
$images = json_encode($arr,true);
$arrURL = array("http://109.74.196.162/html/test/GetFeaturedEvents.php","http://109.74.196.162/html/test/GetMusicEvents.php","http://109.74.196.162/html/test/GetFestivalEvents.php","http://109.74.196.162/html/test/GetTourismEvents.php","http://109.74.196.162/html/test/GetTheatreEvents.php","http://109.74.196.162/html/test/GetSpecialEvents.php");
$urls = json_encode($arrURL,true);
$i = 0;
foreach ($xml->EventCatData as  $event) {
    $buttons = array();
    array_push($buttons, (object)array('url' => $arrURL[$i],'type' => 'json_plugin_url','title' =>"go to"));
    array_push($elements, (object)array('title' => $event->Category."",
        'image_url' => $arr[$i],'subtitle' =>  $event->ID."",'buttons' => $buttons));
    //Getting only 9 element chatfuel max element per gallery is 9
    $i++;
    if($i==6) break;
}
$wrapper = array((object)array('attachment' => (object)array('type' => 'template', 'payload' => (object)array('template_type' => 'generic', 'elements' => $elements))));
$json = json_encode($wrapper);
print_r($json);