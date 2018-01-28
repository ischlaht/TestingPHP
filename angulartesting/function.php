<?php

//include_once("phpclass.php");//import php files
//$curseFilter = new curseFilter;//adding php class
//($cursefilter->clean($userName))//run filter on object username









class Inserting{

    function insertion(){
    $conn = mysqli_connect('localhost', 'root', '', 'test');
    $userName = $_POST['userName'];
    $password = $_POST['password'];

        $sql = $conn->query("INSERT INTO testtable(userName, password)
                VALUES('$userName', '$password')");

            if($conn == true){
                echo "->Connected to database";
                if($sql === true){
                    echo "->SUCCESS: Inserted into database.";
                }
                else{
                    echo "->Failed: Was not inserted into database.";
                }
                echo "->", mysqli_error($conn);
            }
            else{
                echo "->Could not connect to Database";
                echo mysqli_error($conn);
            }
            
    }

    function getit(){
            $conn = mysqli_connect('localhost', 'root', '', 'test');
            $SqlSelectUN = $conn->query("SELECT * FROM testtable");
            $data = array();
                while($row = mysqli_fetch_array($SqlSelectUN)){
                    $data[] = $row;
                } echo JSON_encode($data);
               
    }

    function deleteUser(){
        $conn = mysqli_connect('localhost', 'root', '', 'test');
        $data = json_decode(file_get_contents("php://input"));
            $userid = $data->id;
            $sqlDelete= $conn->query("DELETE FROM testtable WHERE id = '$userid'");  
                $conn->close(); 
        if($conn == true){   
            echo "->Connected to database";   
            if($sqlDelete == true){
                echo "->Data Deleted!";
            }
            else{
                echo "->Data failed to Delete!";
            }
        }
        else{
            echo "->Could not connect to database!";
        }
    }

}
 $Insertionn = new Inserting();





if(isset($_GET['insert'])){
    if($_GET['insert'] == true){
        $Insertionn->insertion();
    }
}

if(isset($_GET['shower'])){
    if($_GET['shower'] == true){
        $Insertionn->getit();
        // echo "";
    }
}

if(isset($_GET['DELUSER'])){
    if($_GET['DELUSER'] == true){
        $Insertionn->deleteUser();
    }
}


// if($_GET['shower'] == true){
//         $Insertionn->getit();
// }




























?>