
<?php
//Alert for testing buttons and shit
    function testfunc(){
        echo "<script> alert ('it works!!!!!!')</script>";
    }











function edit_db(){
    $db = mysqli_connect("localhost", "root", "", "testingphp");
   
    
    $edit_box = $_POST['edit_box'];
    $id = $_POST['edit'];
    //$sqlselect = "Select * FROM filetest";
    //$result = mysqli_query($db, $sqlselect);
    //$count = mysqli_num_rows($result);
    //$row = mysql_fetch_array($result);
    
    
    
    
    //$newname = $_POST['edit_box'];
   // $realid = $_POST['id'];
   // $name = $_POST['edit_box'];
    
    //$sqlupdate = "UPDATE filetest SET name ='$newname' WHERE id ='$realid'";
    $sqlupdate = "INSERT INTO filetest (name) VALUES ('$name');";
        
        
    mysqli_query($db, $sqlupdate) or die ("Could not exicute script-IS".mysqli_error());
    echo "meta http-equiv='refresh' content='0;url=index.php'>";
  
        
        
        
        
        
        

    //echo "<script>alert('alert works')</script>";
    
  

    
    
    


}



























































?>




























