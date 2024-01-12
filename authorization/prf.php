<?php
require_once "config.php";
	try {
	    $name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);

        $prep="UPDATE users SET";

        $flag=0;


        if (strlen($name)>0){
            $prep = "$prep name = '$name'";

            $flag=1;
            }

        if (strlen($phone)>0){
            if ($flag==1){
            $prep="$prep,";
            }
            else{$flag=1;}
            $prep = "$prep phone = $phone";
            }

        if (strlen($email)>0){
            if ($flag==1){
            $prep="$prep,";
            }
            else{$flag=1;}
            $prep = "$prep email = '$email'";
            }

        if (strlen($pass)>0){
            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
            if ($flag==1){
            $prep="$prep,";
            }
            $prep = "$prep password = '$pass_hash'";
            }

        session_start();
        $uid=$_SESSION["userid"];

        $prep="$prep WHERE id = $uid";
		$stmt = $conn->prepare($prep);

		$stmt->execute();

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		print "Данные изменены успешно.";



	} catch (PDOException $e) {

    		if ($e->getCode()=='23000')
            	        {
            	        echo "Ошибка: пользователь с такими данными уже существует.";
            	        }
            	        else {
                		echo "Error: " . $e->getMessage();
                		}

	}
?>
