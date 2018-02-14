<?php
session_start();

//polaczenie z baza danych w celu pozskania inf. o autorze i tytule
require_once ("connect.php");
$db = get_db();



//wczytywanie miniaturek
$my_images_arr = scandir("images/MINI");

$img_string="";
$i=0;
foreach($my_images_arr as $img_name)
{
    $dane="";
    if(strlen($img_name)>2)
    {
        $query = [
           'name'=> $img_name
           ];
        $images = $db->images->find($query);
        foreach($images as $image){
            $dane= 'Autor:'.$image['autor']."  ".'Tytul:'.$image['tytul']." Dostep: ".$image['access']."<br/>";
        }


        require_once("connect.php");
        $db = get_db();
        if(isset($_SESSION['user']))
        {
            $query_access =
                [
                'name' =>$img_name,
                'autor' => $_SESSION['user'],
                'access' => 'prywatne',
                ];
            $prywatne = $db->images->count($query_access);
            if($prywatne>0)
            {
                $query=
                    [
                    'name'=>$img_name,
                    'checkbox'=>'yes',
                    ];
                $img_string .='<input type="checkbox" ';
                $file=$db->images->count($query);
                if($file>0)
                {
                    $img_string .=" ". ' checked="checked"';
                }


                $img_string .=' name="image[]" value="'.$img_name.'"'.'/><img class="button" src="images/MINI/'.$img_name.'"/>'.$dane;
                $i++;
            }
        }
        $query_access2 =
            [
            'name' =>$img_name,
            'access' => 'publiczne',
            ];
        $publiczne = $db->images->count($query_access2);
        if($publiczne>0)
        {
            $query=
               [
               'name'=>$img_name,
               'checkbox'=>'yes',
               ];
            $img_string .='<input type="checkbox" ';
            $file=$db->images->count($query);
            if($file>0)
            {
                $img_string .=" ". ' checked="checked"';
            }


            $img_string .=' name="image[]" value="'.$img_name.'"'.'/><img class="button" src="images/MINI/'.$img_name.'"/>'.$dane;
            $i++;

        }
    }
}

//wczytywanie pelnych zdjec

$my_images_big_arr = scandir("images/WM");

$img_big_string="";

foreach($my_images_big_arr as $img_big_name)
{
    if(strlen($img_big_name)>2){
        $img_big_string .= '<img src="images/WM/'.$img_big_name.'"/>';
    }
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Urzadzenia Mobilne</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
    <link rel="stylesheet" href="zdjecia.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script type="text/javascript">
        function imgFunc()
        {
            var bigImage = document.getElementById("bigImage");
            var thumbnailsHolder = document.getElementById("thumbnailsHolder");

            thumbnailsHolder.addEventListener("click", function (event) {
                var nazwa = event.target.src.split('/').reverse()[0];
                if (event.target.tagName == "IMG")
                {
                    bigImage.src = "images/WM/" + nazwa;



                }


            }, false);

        }
        window.addEventListener("load", imgFunc, false);
    </script>

</head>
<body>
    <div id="container">
        <div id="header">
            O urzadzeniach mobilnych slow kilka!


        </div>

        <div class="menu2">

            <ol>
                <li>
                    <a>
                        <b>Galeria zdjec</b>
                    </a>
                    <ul>
                        <li>
                            <a class="white" href="HTMLPage6.html">Smartphony</a>
                        </li>
                        <li>
                            <a class="white" href="HTMLPage7.html">Laptopy</a>
                        </li>
                        <li>
                            <a class="white" href="HTMLPage8.html">Konsole przenosne</a>
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
        <div id="menu">
            <a href="../index.html">
                <div class="tile">Strona Glowna</div>
            </a>
            <a href="../HtmlPage2.html">
                <div class="tile">Smartphony</div>
            </a>
            <a href="../HtmlPage3.html">
                <div class="tile">Laptopy</div>
            </a>
            <a href="../HtmlPage4.html">
                <div class="tile">Konsole przenosne</div>
            </a>
            <a href="../HtmlPage5.html">
                <div class="tile">Kontakt</div>
            </a>
            <a href="index.php">
                <div class="tile">Galeria Zdjec - PHP</div>
            </a>
        </div>
        <div id="content">

            <div style="float:left;">
                <a href="index.php"><div class="tile">Przeslij plik</div></a>
                <a href="zdjecia.php"><div class="tile">Zdjecia</div></a>
                <a href="zaloguj.php"><div class="tile">Zaloguj sie</div></a>
                <a href="rejestracja.php"><div class="tile">Zarejestruj sie</div></a>
		<a href="search.php"><div class="tile">Wyszukiwarka</div></a>
            </div>

            <div id="theBigImageHolder">

                <?php
                echo '<img src="images/WM/'.$my_images_big_arr[2].'"id="bigImage"/>';
                ?>

            </div>

            <div id="thumbnailsHolder">
                <br/>

                <?php
                echo '<form name="form" method="post" action="checkbox.php">';
                echo $img_string;
                echo"<br/>";
                echo'<input type="submit" name="submit" value="Zapamietaj wybrane"/>';

                echo "</form>";
                ?>
                <br/>
            </div>

            <br/>
            <a href="zdjecia_zaznaczone.php">Zdjecia zaznaczone</a>



        </div>
        <!--<div style="clear:both"></div>
        <div id="footer">
            Strona stworzona z mysla o projekcie.Wszelkie prawa zastrzerzone &copy;
            <a class="white" href="#container">Back to top</a>
        </div>
            -->


    </div>
</body>
</html>
