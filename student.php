<?php require 'functions.inc'; ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Q&A-Student Dashbord</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
         crossorigin="anonymous">
      <link rel='stylesheet' href='style.css' />
   </head>
   <body>
      <!--Nav bar-->
      <?php include("theme/header.html");?>
      <div class='col-md-4 col-sm-6 centered'>
      <?php
         if(!isset($_COOKIE['className'])){
         ?>
      <form id="newClass" method="POST" class='form-group'>
         <select class='form-control' name='class'>
         <?php
            loadClassList() ;
            ?>
         </select><br />
         <input class='btn btn-primary' name='select' type='submit' value='Select' />  
      </form>
      <?php
         }//end
         ?>
      <?php 
         if(!isset($_COOKIE['studentName'])){
         ?>
      <form class='form-group' method="POST">
         <input placeholder='Enter Your Name' class='form-control' type='text' name='studentName' /><br />
         <input class='btn btn-primary' type='submit' name='submit' value='Enter' />
      </form>
      <?php
         }else{
         ?>
      <form method="POST">
         <input value="I Have Question" type='submit' name='question' class='btn btn-success centerit' /><br /><br />
         <input value="Not Anymore" type='submit' name='delete' class='btn btn-danger centerit' />
      </form>
      <?php
         }//end else
         ?>
      <script
         src="https://code.jquery.com/jquery-3.1.1.min.js"
         integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
         crossorigin="anonymous"></script>	
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
         integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
         crossorigin="anonymous"></script>
   </body>
</html>
<?php
   if(isset($_POST['select'])){
    if(!isset($_COOKIE['className']))
   	setcookie("className",$_POST['class'],time()+3600);
   //must be check when file get corrupted
   try {
   $result = file_get_contents('students/'.$_POST['class'].'.txt') ;
   }catch(Exception $e){
    echo "Can not load student file " ; 
   }
   
   }
   
   
   if(isset($_POST['submit'])){
   createStudentCookie() ; 
   addStudent() ;
   header("Refresh:0");
   }
   
   
   if(isset($_POST['question']))
    	addStudent() ;
   
     if(isset($_POST['delete'])){
   	removeStudent($_COOKIE['studentName']);
   	header("Refresh:0");
   
      }
   ?>