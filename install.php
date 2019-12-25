<?php

echo "Please make sure you have configured everything in config.php<br>";

include 'config.php';

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Fail to connect with database" . $conn->connect_error);
}

$sql = "CREATE TABLE pb_content (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
textId VARCHAR(255) NOT NULL,
textContent TEXT(65535) NOT NULL,
textUser VARCHAR(255) NOT NULL,
date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Successfully created table: pb_content <br>";
} else {
    echo "Fail to created table: pb_content" . $conn->error . "<br>";
}

$sql = "CREATE TABLE pb_users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
userName VARCHAR(255) NOT NULL,
userPassword VARCHAR(255) NOT NULL,
userPermission INT NOT NULL,
userEmail VARCHAR(255) NOT NULL,
date TIMESTAMP
)";
 
if ($conn->query($sql) === TRUE) {
    echo "Successfully created table: pb_users <br>";
} else {
    echo "创Fail to created table: pb_users" . $conn->error . "<br>";
}

$conn->close();

echo "Done!";

?>
