<?php
    include('connector.php');

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
            array_push($events, $e);
      	}
      	echo json_encode($events);
        /*while($obj = mysql_fetch_object($rs)) {
            $arr[] = $obj;
            }
            echo json_encode($arr);*/
    }
    if($type == 'new') {
      	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
      	$title = $_POST['title'];
      	$insert = mysqli_query($db, "INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
      	$lastid = mysqli_insert_id($db);
      	echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }
?>
