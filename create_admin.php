<?php
// Use this file ONLY ONCE to create your hashed password
$your_password = 'password123'; // <-- CHANGE THIS to a strong password
$hashed_password = password_hash($your_password, PASSWORD_DEFAULT);

echo "Your username is: <strong>admin</strong><br>";
echo "admin";
echo "password123";
echo "Copy this hashed password: <strong>" . $hashed_password . "</strong>";
?>