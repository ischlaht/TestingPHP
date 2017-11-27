<script type="text/javascript" src="javas.js"></script>
<?php include('functions.php') ?>


<?php
error_reporting();

//Database Connection
    $db = mysqli_connect("localhost", "root", "", "testingphp");

    //ERROR Reporting------------------------
    $error_array = array("<script>alert ('Must select file to upload!')</script>", "<script>alert ('Upload successfull!')</script>", "'uploading failed'", "<script>alert ('Upload Failed! Name(['name']) already exists!')</script>");
    $errortest = array();
   
    //Declare variables--------------------------
    $name = mysqli_real_escape_string($db, $_POST['name']);
    //Select from database
    $checkresult = "SELECT name FROM filetest WHERE name= '$name'";
    $sqlselect_all = "SELECT * FROM filetest";
    $uniqueresult = mysqli_query($db, $checkresult);





//==================================================================================================================================================================================

if (isset($_POST['edit'])){
   // edit_db();
    
        
    $db = mysqli_connect("localhost", "root", "", "testingphp");
    $sqlselect = "Select * FROM filetest";
    $result = mysqli_query($db, $sqlselect);
    $count = mysqli_num_rows($result);
    //$row = mysql_fetch_array($result);
    
    
    
    
    $newname = $_POST['edit_box'];
    $realid = $_POST['id'];
    $name = $_POST['name'];
    
    //for($i=0;$i<$count;$i++){
        
        $edit = $_POST['edit'];
        //$edit_id = $edit[$i];
    $sqlupdate = "UPDATE filetest SET name ='$newname' WHERE name ='$edit'";
    //$sqlupdate = "INSERT INTO filetest (name) VALUES ('$name'), ('$realid')";
        
        
    mysqli_query($db, $sqlupdate);
    //}
  
    

}



if (isset($_POST['submit'])){
    //Checks if empty giving error
    if (empty($name) === true){
        array_push($errortest, true);
        echo $error_array['0'];
        mysqli_close($db);
    }
    
    //checks if name exists giving error
    elseif (mysqli_num_rows($uniqueresult) != 0) {
        array_push ($errortest, true);
        echo $error_array['3'];
        mysqli_close($db);
    }
    
    //Adds to database if no errors
    if (!$errortest){
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $sql = "INSERT INTO filetest (name) VALUES ('$name')";
    mysqli_query($db, $sql);
        mysqli_close($db);
    }
    
}






if(isset($_POST['submitdel'])){
    
    $sqlselect = "Select * FROM filetest";
    
    $result = mysqli_query($db, $sqlselect);
    $count = mysqli_num_rows($result);

    for($i=0;$i<$count;$i++){
    $checkbox = $_POST['checkbox']; 
            $del_id = $checkbox[$i];
            $sql = "DELETE FROM filetest WHERE id = '$del_id'";
            mysqli_query($db, $sql);
    }
}

?>

<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------=================================================================================================================================================================================================================================================================================================================================================================================================================================================================================-->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link href="structure.css" rel="stylesheet" style type="text/css">
<title>PHP Debugger</title>
</head>


<body>
<form method="POST" action="index.php">
    
    <input type="text" name="name">
    <input type="submit" name="submit" value="submit">
    <input type='submit' name='submitdel' value="delete Selected files">
<!--    <echo "<input type='submit' name='del' value='$row";-->
    
   
    
     
      
       
        
     <?php //connect database---------------------------------------
    $db = mysqli_connect("localhost", "root", "", "testingphp");
        $result = mysqli_query($db, $sqlselect_all);
    
            //selecting rows------------------------------------------
            while($row = mysqli_fetch_array($result)) {
        
                
                //Display Content from Rows----------------------
            echo "<div id='test'>";
                echo $row['name'];
                echo "<input type='checkbox' name='checkbox[]' value='$row[id]'>";
                echo "<input type='text' name='edit_box' value='$row[name]'>";
                echo "<input type='text' name='id' value='$row[id]'>";
                echo "<input type='submit' name='edit' value='$row[name]'>";
        echo "</div>";
                
            }
    ?>
    
    
    
    
    

</form>
</body>










</html>