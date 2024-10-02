<?php

class DB {
    private $dbh;

    function __construct() {
        try {
            $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}",$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pe) {
            echo $pe->getMessage();
            die("Bad Database.");
        }
    }

    // People Table Functions
    function getPerson($id) {
        $data = [];

        try {
            $stmt = $this->dbh->prepare("SELECT * FROM people WHERE PersonID = :id");
            $stmt->execute(["id"=>$id]);

            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); // Don't usually echo; prefer to console log out instead.
        }

        return $data;
    }

    function getPersonAlt($id) {
        $data = [];

        try {
            $stmt = $this->dbh->prepare("SELECT * FROM people WHERE PersonID = :id");

            // More explicit method to bind parameters -> More secure b/c of explicitness.
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $data[] = $row;
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); // Don't usually echo; prefer to console log out instead.
        }

        return $data;
    }

    function getPersonAlt2($id) {
        $data = [];

        try {
            $stmt = $this->dbh->prepare("SELECT * FROM people WHERE PersonID = :id");
            $stmt->execute(["id"=>$id]);

            // Rather than looping through and picking out specific data
            $data = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage(); // Don't usually echo; prefer to console log out instead.
        }

        return $data;
    }

    function insert($last, $first, $nick) {
        try {
            $stmt = $this->dbh->prepare("INSERT INTO people 
                (LastName, FirstName, NickName) 
                VALUES (:lastName, :firstName, :nickName)");

            $stmt->execute([
                "lastName" => $last,
                "firstName" => $first,
                "nickName" => $nick
            ]);

            return $this->dbh->lastInsertId();
        } catch (PDOException $e) { 
            echo $e->getMessage();
            return -1;
        }
    }

    function getAllObjects() {
        $data = [];
        
        try {
            // include "Person.class.php";

            $stmt = $this->dbh->prepare("SELECT * FROM people");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($person = $stmt->fetch()) {
                $data[] = $person;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $data;
    }

    function getAllPeopleAsTable() {
        $data = $this->getAllObjects();
        $dataCount = count($data);

        if ($dataCount > 0) {
            $bigString = "<h2>Records Found: {$dataCount}</h2>";
            
            $bigString .= "<table border='1'>\n
                            <tr><th>ID</th><th>Last</th><th>First</th><th>Nick</th>
                            </tr>\n";
                            
            foreach ($data as $row) {
                $bigString .= "<tr>
                    <td><a href='Lab4_4.php?PersonID={$row['PersonID']}'>{$row['PersonID']}</a></td>
                    <td>{$row['LastName']}</td>
                    <td>{$row['FirstName']}</td>
                    <td>{$row['NickName']}</td>
                    </tr>\n";
            }
            $bigString .= "</table>\n";

        } else {
            $bigString = "<h2>No people exist.</h2>";
        }

        return $bigString;
    }

    // Phone Number Table Functions
    function getPhoneNumsByAssoc($id) {
        $data = [];

        try {
            $stmt = $this->dbh->prepare("SELECT * FROM phonenumbers WHERE PersonID = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            $data = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $data;
    }

    function getPhoneNumsByClass($id) {
        $data = [];

        try {
            include "PhoneNumber.class.php";

            $stmt = $this->dbh->prepare("SELECT * FROM phonenumbers WHERE PersonID = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "PhoneNumber");
            $stmt->execute();

            $data = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $data;
    }

    function getPhoneNumsAsAssocTable($id) {
        $data = $this->getPhoneNumsByAssoc($id);
        $dataCount = count($data);

        if ($dataCount > 0) {
            $bigString = "<h2>Records Found: {$dataCount}</h2>";

            $bigString .= "<table border='1'>\n
                            <tr><th>Person ID</th><th>Phone Type</th><th>Phone Number</th><th>Area Code</th>
                            </tr>\n";
                                
            foreach ($data as $row) {
                $bigString .= "<tr>
                    <td>{$row['PersonID']}</td>
                    <td>{$row['PhoneType']}</td>
                    <td>{$row['PhoneNum']}</td>
                    <td>{$row['AreaCode']}</td>
                    </tr>\n";
            }

            $bigString .= "</table>\n";
        } else {
            $bigString = "<h2>No phone nums exist.</h2>";
        }

        return $bigString;
    }

    function getPhoneNumsAsClassTable($id) {
        $data = $this->getPhoneNumsByClass($id);
        $dataCount = count($data);

        if ($dataCount > 0) {
            $bigString = "<h2>Records Found: {$dataCount}</h2>";

            $bigString .= "<table border='1'>\n
                            <tr><th>Person ID</th><th>Phone Type</th><th>Phone Number</th><th>Area Code</th>
                            </tr>\n";
                                
            foreach ($data as $row) {
                $bigString .= "<tr>
                    <td>{$row->PersonID}</td>
                    <td>{$row->PhoneType}</td>
                    <td>{$row->PhoneNum}</td>
                    <td>{$row->AreaCode}</td>
                    </tr>\n";
            }

            $bigString .= "</table>\n";
        } else {
            $bigString = "<h2>No phone nums exist.</h2>";
        }

        return $bigString;
    }
}