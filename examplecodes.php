
<!----------------Security COD#ES -------------------------------------------------------------------------------------------------------------------------------------------$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$------>

--------------------------------------Database prepare example(not my favorit)-------------------------------------------------------
<?php
   if(isset($_POST['username'])){
    $username = $_POST['username'];
            //SQL PREVENTION
       $user = $db->prepare{"SELECT * FROM users WHERE email = :email"};
       $user->execute(['email' => $email,]);

       //checks if rows are empty
if ($user->rowCount()){
    die('SEND email');
    
}


}

?>






<!------------------------To display content/download in DATABASE------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
            <?php

        $db = mysqli_connect("localhost", "root", "", "fileupload");
        $sql = "SELECT * FROM filedetails";
        $result = mysqli_query($db, $sql);
            while($row = mysqli_fetch_array($result)) {
                echo "<img id='filedisplay' src='images/".$row['image']."'>";
            echo "<div id='imagetextbox'>";//bnox container checkbox, view, text
                echo "<div id='checkboxtext'>Select to delete!<input type='checkbox' name='checkbox[]' id='checkbox'value='$row[id]'></div>";
                echo "<a href='images/" .$row['image']."'/ download>Download!</a>";
                echo $row['image_text'];
            }
?>
        
       
      
     
    
   
<!-- ------------------  For Validating and submitting form data.------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<?php
 if (isset($_POST['upload'])) {
      if (($_FILES['image']['size'] == 0)){
    echo $error_array[0];
}
  }


if ($_FILES['image']['size'] >= 1) {
    if (isset($_POST['upload'])) {
//        $filesize = $_FILES['image']['size'];
		$image = $_FILES['image']['name'];
            $target = "images/".basename($_FILES['image']['name']);


		$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

		$sql = "INSERT INTO filedetails (image, image_text) VALUES ('$image', '$image_text')";
		mysqli_query($db, $sql);

		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			echo $error_array[1];
        }
                           }
        else{
			echo $error_array[3];
        }
}
	$result = mysqli_query($db, "SELECT * FROM filedetails");

?>





<!--For deleting a file incremented in rows-->

<?php
if(isset($_POST['submitdel'])){
    $db = mysqli_connect("localhost", "root", "", "fileupload");
    $sqlnew = "Select * FROM filedetails";
    $result = mysqli_query($db, $sqlnew);
    $count = mysqli_num_rows($result);
    
 for($i=0;$i<$count;$i++){
    $checkbox = $_POST['checkbox']; 
    $del_id = $checkbox[$i];
    $sql = "DELETE FROM filedetails WHERE id = '$del_id'";
    mysqli_query($db, $sql);



 }
}
?>


<!--Login and register people and validation--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php

if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}                                   
//        if (mysqli_query($db, $username) == 0) {
//            array_push($errors, "Username does not exist");
//        }

	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: homepage.php');
		}
        else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}


//--------------------------------------------------Register User-----
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($firstname)) { array_push($errors, "First Name is required"); }
    if (empty($lastname)) { array_push($errors, "Last Name is required"); }
    if (empty($phone_number)) { array_push($errors, "Phone number is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }


	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
    
	// register user if there are no errors in the form
    //Also the query selecter for sql------------
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO users (username, firstname, lastname, phone_number, password) 
				  VALUES('$username', '$firstname', '$lastname','$phone_number', '$password')";
		mysqli_query($db, $query);

		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: homepage.php');
	}

}
?>



<!-------------------------------------------Some Random ass error Code function--------------------------->
<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
