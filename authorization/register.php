<?php
require_once "config.php";
	try {
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		$pass_d = trim($_POST['pass_d']);

		if ($pass!=$pass_d)
		{
		echo "Поля должны быть заполнены одинаково!";
		}
        else{
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);





		$stmt = $conn->prepare("INSERT INTO users (name,phone,email,password) VALUES (?,?,?,?)");

		$stmt->execute([$name,$phone,$email,$pass_hash]);

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		print "Регистрация успешна";
		}






	} catch (PDOException $e) {
	        if ($e->getCode()=='23000')
	        {
	        echo "Ошибка: такой пользователь уже существует";
	        }
	        else {
    		echo "Error: " . $e->getMessage();
    		}
	}
?>
