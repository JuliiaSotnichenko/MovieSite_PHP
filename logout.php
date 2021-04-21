<?php
include_once "header.php";
include_once "database.php";

session_start();
session_destroy();
header("location: login.php");
