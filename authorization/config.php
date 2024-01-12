<?php
try
{
 $conn = new PDO( 'mysql:host=<host>;dbname=<dbname>', '<username>', '<password');

}
catch (PDOException $e){
    echo $e->getMessage();
}

?>
