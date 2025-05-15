<?php
$msg = "";
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
        return $data;
}
if(isset($_POST['sbtn'])){
    
    if(empty($_POST['name'])){
        $msg .= "please enter name.<br>";   
    }else{
        $name = test_input($_POST['name']);
        // check if name only contains letters and whitespace
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
			$msg.="Only Alphabates Allowed in Name <br>";
		}
    }

    if(empty($_POST['email'])){
        $msg  .= "please enter email.<br>";   
    }else{
        $email = test_input($_POST['email']);
		// check if e-mail address is well-formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg.="Invalid email format<br>";
		}
    }

    if(empty($_POST['massage'])){
        $msg .= "please enter massage.<br>";   
    }else{
        $massage = test_input($_POST['massage']);
    }
    echo $msg;
    if( $msg=="" ){
        $dor=date('Y-m-d');
	    $conn=mysqli_connect('localhost','root','','Aspacedesign');
	    $sql = "INSERT INTO `users` (`name`,`email`, `massage`, `dor`) VALUES ('$name','$email','$massage','$dor')";
	    if(mysqli_query($conn, $sql)) {
            header("location:contact.html");
	    	$regmsg= "Register successfully";
	    } else {
	    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}
}
?>