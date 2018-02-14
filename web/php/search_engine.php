<?php

$partialNode = $_POST['partialNode'];

require_once("connect.php");
$db = get_db();
//$images = $db->images->find();

//foreach($images as $image) {
//$db->images->remove($image);
//}


$query = ['tytul'=>new MongoRegex ("/$partialNode/i")];

$images = $db->images->find($query);

foreach($images as $image)
{
    echo '<div>'.'<img src="images/MINI/'.$image['name'].'"/></div>'.'Tutul:'.$image['tytul'].'<br/>';
}

?>