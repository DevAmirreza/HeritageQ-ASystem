<?php require 'functions.inc'; ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Q&A-Teacher Dashbord</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel='stylesheet' href='style.css' />
   </head>
   <body>
      <!--Nav bar-->
      <?php include("theme/header.html");?>
      <div class='col-md-4 col-sm-6 centered '>
         <?php  if(!isset($_COOKIE['className'])){ ?>
         <h2 class='text-center'>Choose Your Existing Class</h2>
         <div class="form-group">
            <form id="selectClass" method="POST">
               <select class='form-control' name='class'>
               <?php
                  loadClassList() ;
                  ?>
               </select>
               <br />
               <input name='select' type='submit' class='btn btn-primary centered' value='Select' />
               </form 
         </div>
         <h2 class='text-center'>Create a New Class</h2>
         <div class="form-group">
         <form id="newClass" method="POST">
         <input placeholder='Create a New Class' class='form-control' name='class' type='text' />
         <br />
         <input class='btn btn-primary' name='submit' type='submit' value='Create' />
         </form>
         </div>
      </div>
      <?php }?>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   </body>
</html>
<?php
   if(isset($_POST['submit'])){
   	createClass() ;
   	setcookie("className",$_POST['class'],time()+3600);
   //reset
   	file_put_contents( 'students/'.$_POST['class'].'.txt', "");
   header("Refresh:0");
   
    }
    if(isset($_POST['select'])){
   	 if(!isset($_COOKIE['className']))
    	setcookie("className",$_POST['class'],time()+3600);
   
   //must be check when file get corrupted
   try {
   $result = file_get_contents('students/'.$_POST['class'].'.txt') ;
    }catch(Exception $e){
   	 echo "Error - Exception Catched " ; 
   	 createStudentList() ;	
   }
   header("Refresh:0");
    }
   
    if(isset($_COOKIE['className']))
       refresh()  ;
   echo "<form method='POST'>" ;
   loadStudents() ;
   echo "</form>" ;
   
    if(isset($_POST['studentBtn'])){
   removeStudent($_POST['studentBtn']);
     header("Refresh:0");
   
    }
   
   ?>