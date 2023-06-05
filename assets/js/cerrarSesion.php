<?php
    session_start();
    session_destroy();
    header('location: ./../../maderastablas/index.php');
?>