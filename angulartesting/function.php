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
                echo "Connected to database";
                if($sql === true){
                    echo "->SUCCESS: Inserted into database.";
                }
                else{
                    echo "->Failed: Was not inserted into database.";
                }
                echo "->", mysqli_error($conn);
            }
            else{
                echo "Could not connect to Database";
                echo mysqli_error($conn);
            }
            
    }

    function getit(){
            $conn = mysqli_connect('localhost', 'root', '', 'test');
            $SqlSelectUN = $conn->query("SELECT * FROM testtable");
            //$SqlSelectUN = mysqli_query($conn, "SELECT * FROM testtable");
            $data = array();
            // foreach(username as $username){
            //     echo JSON_encode($username);
            //     echo $username;
            //     echo "came to php file";
            // }
            while($row = mysqli_fetch_array($SqlSelectUN)){
                    $data[] = $row;
                    // echo $data;
                    // echo "came to php file";
                }
                echo JSON_encode($data);

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


// if($_GET['shower'] == true){
//         $Insertionn->getit();
// }




























?>