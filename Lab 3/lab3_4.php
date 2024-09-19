<?php
    spl_autoload_register(function($class){
        require_once("./lab3_3.php");
    }); 

    $p1 = new BritishPerson();
    $p1->setHeight(173);
    $p1->setWeight(68);

    echo "This is {$p1->getFName()} {$p1->getLName()} and their BMI is {$p1->calculateBMI()}.";
?>