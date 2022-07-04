<?php
    include 'org.hessian/server/HessianPhpServer.php';
    include_once("HessianPHP/src/HessianService.php");
    $service = new HessianService(new HessianPhpServer());


$service->handle();


?>

