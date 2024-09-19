<?php
    spl_autoload_register(function($class){
        require_once("./lab3_1.php");
    }); 

    $p1 = new Person();
    $p1->setHeight(68);
    $p1->setWeight(150);

    echo "This is {$p1->getFName()} {$p1->getLName()} and their BMI is {$p1->calculateBMI()}.";
?>