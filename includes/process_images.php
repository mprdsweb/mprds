<?php
    //include('connector.php');

    $type = $_GET['type'];

    if($type == 'fetch') {
        $directory = "../media/img/*";
        if(isset($_GET['directory'])){
            $directory = "../media/".$_GET['directory']."/*";
        }
        $images = glob($directory);
      	echo json_encode($images);
        /*
        foreach($images as $image){
            echo $image;
        }*/
    }
?>
