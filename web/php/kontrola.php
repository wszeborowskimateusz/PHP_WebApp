<?php
session_start();

//Weryfikacja przesyłanych obrazków, nakładanie znaków wodnych i tworzenie miniaturek

$fine = true;

//znak wodny
$znak_wodny=$_POST['znak_wodny'];
if(strlen($znak_wodny)<=0)
{
    $_SESSION['blad_znak'] = "Podaj znak wodny";
    $fine=false;
    header("Location: index.php");
}

//weryfikacja autora
$autor = $_POST['autor'];
if(strlen($autor)<=0)
{
    $_SESSION['blad_autor'] = "Podaj autora";
    $fine=false;
    header("Location: index.php");
}

//weryfikacja tytulu
$tytul = $_POST['tytul'];
if(strlen($tytul)<=0)
{
    $_SESSION['blad_tytul'] = "Podaj tytul";
    $fine=false;
    header("Location: index.php");
}

if((!isset($_POST['access']))&&(isset($_SESSION['zalogowany'])))
{
    $_SESSION['blad_dostep'] = "Wybierz dostep";
    $fine=false;
    header("Location: index.php");
}

if((isset($_FILES['zdjecie']))&&($fine == true))
{
    $zdjecie = $_FILES['zdjecie'];

    //weryfikacja pliku
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_name = $_FILES['zdjecie']['tmp_name'];
    $_SESSION['file_name'] = $file_name;
    $mime_type = finfo_file($finfo, $file_name);
    $file_size = $zdjecie['size'];
    if (($mime_type !== 'image/jpeg') && ($mime_type !== 'image/png'))
    {
        $_SESSION['blad_typu'] = "Niepoprawny format";
        header("Location: index.php");

    }

    if($file_size>1024*1024)
    {
        $_SESSION['blad_rozmiaru'] = "Zbyt duży rozmiar";
        header("Location: index.php");

    }

    if((($mime_type === 'image/jpeg') || ($mime_type === 'image/png'))&&($file_size<=1024*1024)&&(strlen($znak_wodny)>0))
    {
        //załadowanie pliku
        $upload_dir = 'images/';
        $file = $_FILES['zdjecie'];
        $file_name = basename($file['name']);
        $target = $upload_dir . $file_name;
        $tmp_path = $file['tmp_name'];
        if(move_uploaded_file($tmp_path, $target)){

            //nakładanie znaku wodnego
            if($mime_type === 'image/jpeg')
            {

                list($w,$h)=getimagesize('images/'.$file_name);

                $resource = imagecreatefromjpeg('images/'.$file_name);

                $target = imagecreatetruecolor($w,$h);

                $color = imagecolorallocate($target,255,255,255);

                imagecopyresized($target,$resource,0,0,0,0,$w,$h,$w,$h);

                imagettftext($target,100,0,$w/3,($h/2)-50,$color,'fonts/arial.ttf',$znak_wodny);

                imagejpeg($target,'images/WM/'.$file_name);

                imagedestroy($resource);
                imagedestroy($target);
            }

            if($mime_type === 'image/png')
            {
                list($w,$h)=getimagesize('images/'.$file_name);

                $resource = imagecreatefrompng('images/'.$file_name);

                $target = imagecreatetruecolor($w,$h);

                $color = imagecolorallocate($target,255,255,255);

                imagecopyresized($target,$resource,0,0,0,0,$w,$h,$w,$h);

                imagettftext($target,100,0,$w/3,($h/2)-50,$color,'fonts/arial.ttf',$znak_wodny);

                imagepng($target,'images/WM/'.$file_name);

                imagedestroy($resource);
                imagedestroy($target);
            }

            //generowanie miniatury
            if($mime_type === 'image/png')
            {
                list($w2,$h2)=getimagesize('images/'.$file_name);

                $resource2 = imagecreatefrompng('images/'.$file_name);

                $target2 = imagecreatetruecolor(200,125);

                $color2 = imagecolorallocate($target2,255,255,255);

                imagecopyresized($target2,$resource2,0,0,0,0,200,125,$w2,$h2);

                imagepng($target2,'images/MINI/'.$file_name);

                imagedestroy($resource2);
                imagedestroy($target2);
            }

            if($mime_type === 'image/jpeg')
            {
                list($w2,$h2)=getimagesize('images/'.$file_name);

                $resource2 = imagecreatefromjpeg('images/'.$file_name);

                $target2 = imagecreatetruecolor(200,125);

                $color2 = imagecolorallocate($target2,255,255,255);

                imagecopyresized($target2,$resource2,0,0,0,0,200,125,$w2,$h2);

                imagejpeg($target2,'images/MINI/'.$file_name);

                imagedestroy($resource2);
                imagedestroy($target2);
            }

            if(isset($_SESSION['zalogowany']))
            {$radio = $_POST['access'];}

            else {$radio= "publiczne";}

            //zapisanie autora i tytulu do bazy danych
            require_once("connect.php");
            $db = get_db();
            $db->images->insert([
                'name' => $file_name,
                'autor' => $autor,
                'tytul' => $tytul,
                'checkbox' =>'no',
                'access' => $radio,
                ]);

            $_SESSION['pomyslny_upload'] = "Upload przebiegł pomyślnie";
            header("Location:index.php");
            exit();
        }
    }




    //unset($zdjecie);
}





?>