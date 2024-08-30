<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    	<title>Lab 1.4</title>
    </head>

    <body>
        <?php
            echo "<h1>ISTE 341 - Lab 1.4 - Conor Race</h1>";

            $array = [
                [1, 2, 3, 4, 5],
                [6, 7, 8, 9, 10],
                [11, 12, 13]
            ];

            $value = $array[1][2];

            echo "
                <h2>Part A</h2>
                <p>In the array, value 8 is at indecies [1][2]: $value</p>
                <h2>Part B</h2>
            ";

            $array[2][] = 14;
            $array[] = [15, 16, 17];
            $array[] = 18;

            foreach ($array as $xIndex => $arr) {
                if (is_int($arr)) {
                    echo "[$xIndex]: $arr<br/>";
                } else {
                    foreach ($arr as $yIndex => $num) {
                        echo "[$xIndex][$yIndex]: $num<br/>";
                    }
                }   
            }

            echo "<h2>Part C</h2>";

            for ($i = 0; $i < count($array); $i++) {
                if (is_int($array[$i])) {
                    echo "[$i]: $array[$i]<br/>";
                } else {
                    for ($j = 0; $j < count($array[$i]); $j++) {
                        $tempVal = $array[$i][$j];
                        echo "[$i][$j]: $tempVal<br/>";
                    }
                }
            }

            echo "<h2>Part D</h2>";

            $array2 = [
                'name' => [
                    "first" => "Conor", 
                    "last" => "Race"
                ],
                'address' => [
                    "street" => "123 Main St.",
                    "city" => "Rochester",
                    "state" => "NY",
                    "zip" => "14623"
                ]
            ];

            foreach ($array2 as $arrType => $arrData) {
                foreach ($arrData as $key => $value) {
                    echo "[$arrType][$key]: $value<br/>";
                }
            }

            echo "<h2>Part E</h2>";

            $array2["name"]["middle"] = "none";
            $array2["name"][] = ["my" => "name"];
            $array2["name"][] = 25;
            $array2[] = [1, 2, 3, 4, 5];
            $array2[][] = ["testing" => "yes"];

            foreach ($array2 as $xKey => $xData) {
                foreach ($xData as $yKey => $yData) {
                    if (is_int($yData) || is_string($yData)) {
                        echo "[$xKey][$yKey]: $yData<br/>";
                    } else {
                        foreach ($yData as $zKey => $zData) {
                            echo "[$xKey][$yKey][$zKey]: $zData<br/>";
                        }
                    }
                }
            }
        ?>
    </body>
</html>