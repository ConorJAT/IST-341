<?php
    class Person {
        protected $fName, $lName, $height, $weight;

        function __construct($fName = "Sam", $lName = "Spade") {
            $this->fName = $fName;
            $this->lName = $lName;
        }

        function getFName() { return $this->fName; }
        function setFName($fName) { $this->fName = $fName; }

        function getLName() { return $this->lName; }
        function setLName($lName) { $this->lName = $lName; }

        function getHeight() { return $this->height; }
        function setHeight($height) { $this->height = $height; }

        function getWeight() { return $this->weight; }
        function setWeight($weight) { $this->weight = $weight; }

        function calculateBMI() {
            return 705 * ($this->weight / ($this->height * $this->height));
        }
    }