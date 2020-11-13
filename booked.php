<?php
if(isset($_GET['date'])){
  $date=$_GET['date'];
}
/*
if(isset($_POST['submit'])){
  $name=$_POST['name '];
  $email = $_POST['email '];
  $mysqli = new mysqli('localhost','sqllab','Tomten2009','ateam_majorna');
  $stmt = $mysqli->prepare("INSERT INTO Bookings (Name, Email, date) VALUES(?,?,?)");
  $stmt->bind_param('sss',$name,$email,$date);
  $stmt->execute();
  $msg="<div>Booking successful, congrats! </div>";
  $stmt->close();
  $mysqli->close();
}*/

//Varaktigthet på respektive slot.
$duration = 30;
//Används för att skapa "time gap" mellan slot, sätter man den till exempelvis 10 så skapas en lucka på 10 min mellan timeslotsen.
$cleanUp = 5;
//Definierar när timeslotsen skall börja.
$start = "08:00";
//Definierar när timeslotsen skall sluta.
$end = "16:00";

//Skapa funktion för timeslotsen.
function timeslots($duration,$cleanUp,$start,$end){
  $start = new DateTime($start);
  $end = new DateTime($end);
  $interval = new DateInterval("PT".$duration."M");
  $cleanupInterval = new
  DateInterval("PT".$cleanUp."M");
  $slots = array();

//For-loop som skapar timeslots mellan den satta starttiden ($start) och den satta sluttiden ($end).
  for($intStart=$start; $intStart<$end;$intStart->add($interval)->add($cleanupInterval)){
    $endPeriod = clone $intStart;
    $endPeriod->add($interval);
    if($endPeriod>$end){
      break;
    }
    //Sätter tidsformatet på varje slot.
    $slots[]=$intStart->format("H:i")."-".$endPeriod->format("H:i");
  }
  return $slots;
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
    <head>
       <meta charset="utf-8">
       <title></title>
    </head>
    <body>
       <div class="container">
          <h1 class"text-center"> Book for date: <?php echo date('m/d/Y',strtotime($date)); ?></h1>
          <hr>
          <?php $timeslots = timeslots($duration,$cleanUp,$start,$end);
             foreach($timeslots as $ts){
               ?>
          <div class="col-md-2">
             <button class="btn btn-success"> <?php echo $ts; ?></button>
          </div>
          <?php }?>
       </div>
    </body>
 </html>
