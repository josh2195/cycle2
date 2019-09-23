<?php
/**
 * Created by PhpStorm.
 * User: joshe
 * Date: 9/21/2019
 * Time: 5:20 PM
 */
session_start();
$currentfile = basename($_SERVER['PHP_SELF']);
//set the time
$rightnow = time();

//turn on error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors','1');

//set the time zone
ini_set( 'date.timezone', 'America/New_York');
date_default_timezone_set('America/New_York');

require_once "connect.php";
require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Custom File Storage</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<header>
    <h1><?php echo $pagetitle; ?></h1>
    <nav><?php require_once "nav.php"; ?></nav>
</header>
<main>
    <h2>This website is for anyone to store their files on a safe and secure server.</h2>
