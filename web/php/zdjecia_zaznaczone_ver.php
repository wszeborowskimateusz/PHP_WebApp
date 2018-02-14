<?php
session_start();


if(isset($_POST['submit']))
{
    if(!empty($_POST['image']))
    {
        require("connect.php");
        $db = get_db();


        $checkbox = $_POST['image'];
        foreach($checkbox as $selected)
        {

            $query = ['name'=> $selected];
            $new_value = ['checkbox' =>'no'];
            $db -> images ->update($query,['$set'=> $new_value]);

        }
    }


}

header("Location: zdjecia_zaznaczone.php");

?>