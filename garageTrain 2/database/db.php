<?php

function connectDB(){
  $host = 'localhost';
  $user = 'root';
  $password = 'root';
  $database = 'examen-new_func';
  $conn = new mysqli($host, $user, $password, $database);

  if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
  }
  else{
    return $conn;
  }
}

