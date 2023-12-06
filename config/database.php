<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'advisingmanagement';

//Create Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=1');
//Check Connection
if($conn->connect_error){
    die('Connection Failed ' . $conn->connect_error);
}