<?php
    spl_autoload_register(function($class){
        require_once("./lab3_1.php");
    }); 

    class BritishPerson extends Person {
        function calculateBMI() {
            $this->height = $this->height / 2.54;
            $this->weight = $this->weight * 2.205 ;

            return parent::calculateBMI();
        }
    }