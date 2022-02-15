<?php
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("Location: search.php");
}
require 'functions.php';

