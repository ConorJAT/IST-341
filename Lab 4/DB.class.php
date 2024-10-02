<?php

    class DB {
        
        private $conn;

        function __construct(){
            $this->conn = new mysqli(
                $_SERVER['DB_SERVER'], 
                $_SERVER['DB_USER'], 
                $_SERVER['DB_PASSWORD'], 
                $_SERVER['DB']
            );

            if ($this->conn->connect_error) {
                echo "Connection Failure: ".mysqli_connect_error();
                die();
            }
        }

        // People Table Functions
        function getAllPeople() {
            $data = [];

            if ($stmt = $this->conn->prepare("SELECT * FROM people")) {
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id, $last, $first, $nick);

                if ($stmt->num_rows > 0) {
                    while ($stmt->fetch()) {
                        $data[] = [
                            'id' => $id,
                            'last' => $last,
                            'first' => $first,
                            'nick' => $nick
                        ];
                    }
                }
            }

            return $data;
        }

        function getAllPeopleAsTable() {
            $data = $this->getAllPeople();
            $dataCount = count($data);

            if ($dataCount > 0) {
                $bigString = "<h2>Records Found: {$dataCount}</h2>";

                $bigString .= "<table border='1'>\n
                                <tr><th>ID</th><th>Last</th><th>First</th><th>Nick</th>
                                </tr>\n";
                                
                foreach ($data as $row) {
                    $bigString .= "<tr>
                        <td><a href='Lab4_2.php?PersonID={$row['id']}'>{$row['id']}</a></td>
                        <td>{$row['last']}</td>
                        <td>{$row['first']}</td>
                        <td>{$row['nick']}</td>
                        </tr>\n";
                }

                $bigString .= "</table>\n";
            } else {
                $bigString = "<h2>No people exist.</h2>";
            }

            return $bigString;
        }

        function insertPerson($last, $first, $nick) {
            $query = "INSERT INTO people (LastName, FirstName, NickName) 
                VALUES (?, ?, ?)";

            $insertID = -1;

            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("sss", $last, $first, $nick);
                $stmt->execute();
                $stmt->store_result();
                $insertID = $stmt->insert_id;
            }

            return $insertID;
        }

        function updatePerson($fields) {
            $query = "UPDATE people SET ";
            $updateID = 0;
            $numRows = 0;
            $items = [];
            $type = "";

            foreach ($fields as $k => $v) {
                switch ($k) {
                    case "nick":
                        $query .= "NickName = ?,";
                        $items[] = &$fields[$k];
                        $type .= "s";
                        break;

                    case "first":
                        $query .= "FirstName = ?,";
                        $items[] = &$fields[$k];
                        $type .= "s";
                        break;

                    case "last":
                        $query .= "LastName = ?,";
                        $items[] = &$fields[$k];
                        $type .= "s";
                        break;

                    case "id":
                        $updateID = intval($fields[$k]);
                        break;
                }
            }

            $query = trim($query, ",");
            $query .= " WHERE PersonID = ?";
            $type .= "i";
            $items[] = &$updateID;

            if ($stmt = $this->conn->prepare($query)) {
                $refArr = array_merge([$type], $items);
                $ref = new ReflectionClass('mysqli_stmt');
                $method = $ref->getMethod('bind_param');
                $method->invokeArgs($stmt, $refArr);

                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }

            return $numRows;
        }

        function deletePerosn($id) {
            $query = "DELETE FROM people WHERE PersonID = ? ";

            $numRows = 0;

            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("i", intval( $id));
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }

            return $numRows;
        }


        // Phone Number Table Functions
        function getAllPhoneNums($id) {
            $data = [];

            if ($stmt = $this->conn->prepare("SELECT * FROM phonenumbers WHERE PersonID = ? ")) {
                $stmt->bind_param("i", intval( $id));
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id, $type, $num, $code);
                
                if ($stmt->num_rows > 0) {
                    while ($stmt->fetch()) {
                        $data[] = [
                            'id' => $id,
                            'type' => $type,
                            'num' => $num,
                            'code' => $code
                        ];
                    }
                }
            }

            return $data;
        }

        function getAllPhoneNumsAsTable($id) {
            $data = $this->getAllPhoneNums($id);
            $dataCount = count($data);

            if ($dataCount > 0) {
                $bigString = "<h2>Records Found: {$dataCount}</h2>";

                $bigString .= "<table border='1'>\n
                                <tr><th>Person ID</th><th>Phone Type</th><th>Phone Number</th><th>Area Code</th>
                                </tr>\n";
                                
                foreach ($data as $row) {
                    $bigString .= "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['num']}</td>
                        <td>{$row['code']}</td>
                        </tr>\n";
                }

                $bigString .= "</table>\n";
            } else {
                $bigString = "<h2>No phone nums exist.</h2>";
            }

            return $bigString;
        }

    } // DB