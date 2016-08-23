<?php
    include('connector.php');

//    $type = $_GET['type'];
    $type = $_POST['type'];

    if($type == 'fetch') {
      	$events = array();
      	$query = mysqli_query($db, "SELECT * FROM calendar");
      	while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $e = array();
            $e['id'] = $fetch['id'];
            $e['title'] = $fetch['title'];
            $e['start'] = $fetch['startdate'];
            $e['end'] = $fetch['enddate'];
            $allday = ($fetch['allDay'] == "true") ? true : false;
            $e['allDay'] = $allday;
            $e['url'] = $fetch['url'];
            $e['img_path'] = $fetch['img_path'];
            $e['description'] = $fetch['description'];
            array_push($events, $e);
      	}
      	echo json_encode($events);
    }
    if($type == 'upcoming') {
      	$events = array();
        date_default_timezone_set('America/Los_Angeles');
        $date = date('Y-m-d H:i:s');

      	$query = mysqli_query($db, "SELECT * FROM calendar");
      	while($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $phpdate = strtotime($fetch['startdate']);
            $eventDate = date( 'Y-m-d H:i:s', $phpdate );
            if($eventDate >= $date){
                $e = array();
                $e['id'] = $fetch['id'];
                $e['title'] = $fetch['title'];
                $e['start'] = $fetch['startdate'];
                $e['end'] = $fetch['enddate'];
                $allday = ($fetch['allDay'] == "true") ? true : false;
                $e['allDay'] = $allday;
                $e['url'] = $fetch['url'];
                $e['img_path'] = $fetch['img_path'];
                $e['description'] = $fetch['description'];
                array_push($events, $e);
          	}
      	}
      	echo json_encode($events);
    }
    if($type == 'new') {
      	$startdate = $_POST['startDate'].'T'.$_POST['startTime']; //Must be in format '2014-04-25T01:30:00.000'
      	$enddate = $_POST['endDate'].'T'.$_POST['endTime'];
      	$title = $_POST['title'];
        $allday = ($_POST['allDay'] == "on") ? true : false;
        $description = $_POST['description'];
        $img_path = $_POST['img_path'];
      	$insert = mysqli_query($db, "INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`, `img_path`, `description`) VALUES('$title','$startdate','$enddate','$allDay', '$img_path', '$description')");
      	$lastid = mysqli_insert_id($db);
      	echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }
    if($type == 'update') {
    }
?>
