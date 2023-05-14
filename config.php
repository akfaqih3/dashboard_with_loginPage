<?php
$dbData=array(
    "hostname"=>"localhost",
    "dbuser"=>"root",
    "dbpassword"=>"",
    "dbname"=>"myproject"
);

$conn=mysqli_connect($dbData['hostname'],
                    $dbData['dbuser'],
                    $dbData['dbpassword']);


function checkDB($conn,$dbName){
    try {
        $db= mysqli_select_db($conn,$dbName);
    } catch (Exception $th) {
        $db=mysqli_error($conn);
    }

    if($db==1){
        return true;
    }else{
        if(mysqli_query($conn,"create database ".$dbName.";")){
            return false;
        }
    }
}

function init($conn,$dbData){
    $dbName=$dbData['dbname'];

    if (checkDB($conn,$dbName)){
        $conn=mysqli_connect($dbData['hostname'],
                    $dbData['dbuser'],
                    $dbData['dbpassword'],
                    $dbData['dbname']);
        return true;
    }else{
        $conn=mysqli_connect($dbData['hostname'],
                    $dbData['dbuser'],
                    $dbData['dbpassword'],
                    $dbData['dbname']);

        $sql="create table products(
                        id int primary key auto_increment,
                        name varchar(255),
                        text text,
                        image varchar(255));";

    mysqli_query($conn,$sql);

    return true;
    }

}

if (!init($conn,$dbData)){
    echo mysqli_error($conn);
}else{
	unlink("config.php");
}
?>
