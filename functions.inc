<?php
   //Default Class List 
      define("CLASSLIST","classList.json");
   
   
	function logout(){
	 setcookie("studentName", "", time() - 3600);
	 setcookie("className", "", time() - 3600);
      	header("Refresh:0");

	}
   
      function refresh(){
      	header("Refresh:5");
      }
      
   function loadClassList(){
   	$content = "" ;
   	$classList = file_get_contents('classList.json');
       $load = json_decode($classList,true) ;
   	    for($i = 0 ; $i < count($load) ; $i++){
   		  $content .= "<option>".$load[$i]['fileName']."</option>" ; 	
   	 }
   	 echo $content ; 
   	}
   	
      function removeStudent($stuentName){
   	    	if(isset($_COOKIE['className'])){
      		$classContent = file_get_contents('students/'.$_COOKIE['className'].'.txt');
   		if($classContent != NUll){
   		$classContent = explode('~',$classContent) ; 
   	if (($key = array_search($stuentName, $classContent)) !== false) {
       unset($classContent[$key]);
   	$classContent = array_values(array_diff($classContent,array("null","")));
   	 if(isset($_COOKIE['className'])){
   		 		file_put_contents('students/'.$_COOKIE['className'].'.txt','');
   	foreach($classContent as $item){
   		file_put_contents('students/'.$_COOKIE['className'].'.txt',$item.'~',FILE_APPEND);
   	}
   	 }else
   		 die("Error - Removing Student ");
   
   
   }
   		}else
   			die("<h4 class='text-center'>You are not on the list</h4>");
      	}  
      }
      
      //Only For Student 
      function addStudent(){
   	if(isset($_COOKIE['className'])){
   		if(isset($_COOKIE['studentName']))
   		file_put_contents('students/'.$_COOKIE['className'].'.txt',$_COOKIE['studentName'].'~',FILE_APPEND);
   		else
   		file_put_contents('students/'.$_COOKIE['className'].'.txt',$_POST['studentName'].'~',FILE_APPEND);
   
   	}else
   		die("Error - Adding Student ");
   }
      
      
       function createStudentCookie(){
     	setcookie("studentName",$_POST['studentName'],time()+3600);
   	 }
      
      //For Teachers Only 
         function createClass(){
      		$fileContent = file_get_contents(CLASSLIST);
      		$classArray = array() ;
      	if($fileContent == NULL){
      		$classObject = array('fileName'=>'' , 'expiryDate'=>''); 
      		$classObject['fileName'] = $_POST['class'] ; 
      		$classArray[] = $classObject;
      		file_put_contents( CLASSLIST, json_encode($classArray , JSON_PRETTY_PRINT));
      	}else{
      		$classObject = array('fileName'=>'' , 'expiryDate'=>''); 
      		$classObject['fileName'] = $_POST['class'] ; 
      		$classArray = json_decode($fileContent);	
      		array_push($classArray,$classObject) ;
      		file_put_contents( CLASSLIST, json_encode($classArray , JSON_PRETTY_PRINT));
      	}	
      }
      
       
      function createStudentList(){
      if(isset($_COOKIE['className']))
      	file_put_contents('students/'.$_COOKIE['className'].'.txt', "");
      }
      
	              function loadStudents(){
            if(isset($_COOKIE['className'])){
            $classContent = file_get_contents('students/'.$_COOKIE['className'].'.txt');
            if($classContent != NUll){
            $classContent = explode('~',$classContent) ; 
            foreach($classContent as $item){
            if(strlen($item) > 0 )
            echo '<input  type="submit" value="'.$item.'" class="btn btn-info centerit" name="studentBtn"/><br />' ; 
            }
            }else
            die("<h4 class='text-center'>There Are Curently No Question To Answer</h4>");
            }
            
            }
      
      
   ?>