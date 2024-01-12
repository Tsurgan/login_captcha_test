<?php
require_once "config.php";


	//
	define('SMARTCAPTCHA_SERVER_KEY', '<server_key>');

    function check_captcha($token) {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => SMARTCAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'],

        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return true;
        }
        $resp = json_decode($server_output);
        return $resp->status === "ok";
    }

    $token = $_POST['smart-token'];
    if (check_captcha($token)) {





	try {




		$login = trim($_POST['login']);
		$pass = trim($_POST['pass']);






		$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");

		$stmt->execute([$login,$login]);

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (isset($data[0])){
            if (password_verify($pass, $data[0]['password'])) {
                                session_start();
                                $_SESSION["userid"] = $data[0]['id'];
                                $_SESSION["user"] = $data[0]['name'];
                                echo "Добро пожаловать, ", $_SESSION["user"],"!";
                                ?>
                                <html>
                                <form action="profile.php">
                                    <div>
                                        <input type="submit" value="Профиль">
                                    </div>
                                </form>
                                </html>
                                <?php
            }
            else {
            print "Неверный логин или пароль";
            }
		}
		else{
		print "Пользователь не найден";
		}









	} catch (PDOException $e) {

    		echo "Error: " . $e->getMessage();

	}



    } else {
        echo "Сперва пройдите капчу!\n";
    }
	//


?>
