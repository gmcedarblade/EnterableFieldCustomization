<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Drug Adding with Table</title>
    <meta charset="utf-8">
    <style>
        th {
            padding: 25px;
            border: 1px solid #243;

        }
        td {
            padding: 25px;
            border: 1px solid #243;
        }
    </style>
</head>
<body>
<?php

//if (isset($_SESSION['medList'])) {
//
//    $medList = $_SESSION['medList'];
//
//} else {
//
//    $medList = Array();
//
//}
//

//
//if (isset($_POST['remove'])) {
//    $remove = $_POST['remove'];
//} else {
//    $remove = Array();
//}

?>
    <div class="testArea" style="border: 1px solid #000;">
        <form style="padding: 10px;" action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <label>Medication</label>
            <input type="text" spellcheck="true" id="drugName" name="drugName">
            <label>Dosage</label>
            <input type="number" id="drugDosage" name="drugDosage">
            <label>Units</label>
            <select id="drugUnit" name="drugUnit">
                <option value="cc">cc</option>
                <option value="milligrams">mg</option>
                <option value="micrograms">mcg</option>
                <option value="unit">unit</option>
                <option value="capsule">capsule</option>
                <option value="tablet">tablet</option>
            </select>
            <label>Description</label>
            <input type="text" spellcheck="true" id="drugDescription" name="drugDescription">
            <button class="submit" type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div class="medList">
        <table id="medTable">
            <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Units</th>
                <th>Description</th>
                <th>Remove</th>
            <?php
            echo "</tr>\n";

            global $number;
            $number = -1;
            if (isset($_GET["submit"])) {

                /*
                 * Get the drug name, dose,
                 * unit and description from the form
                 */
                $drugName = $_GET["drugName"];
                $drugDose = $_GET['drugDosage'];
                $drugUnit = $_GET['drugUnit'];
                $drugDesc = $_GET['drugDescription'];

                /*
                 * Set new array to store the form information
                 */
                $thisMedList = array();

                /*
                 * Set the new array with keys value pairs for the
                 * input form information
                 */
                $thisMedList["drugName"] = $drugName;
                $thisMedList["drugDose"] = $drugDose;
                $thisMedList["drugUnit"] = $drugUnit;
                $thisMedList["drugDesc"] = $drugDesc;
//                echo "thisMedList: " . var_dump($thisMedList) . "<br>";
                /*
                 * Set the new array list to be saved in
                 * the session array to store the input data
                 * for if the user leaves
                 */
                $_SESSION['medList'][] = $thisMedList;

                /*
                 * Output the information in table format.
                 */

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>";
                    echo "\n\t\t\t\t<td>";


                    echo "<form action=" . $_SERVER['PHP_SELF'] . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number'>Remove</button></form>";





                    echo "</td>";
                    $number++;

                    echo "\n\t\t\t</tr>\n";
                    echo $number . "<br><br>";



                }

                if (isset($_GET['remove'])) {
                    echo "GET Remove: " . $_GET['remove'];
                    echo "<h2>Please confirm deletion by pressing button once more.</h2>";
                    echo "Number: " . $number;
                    unset($_SESSION['medList'][$number]);
                    unset($_GET['remove']);
                }

            /*
             * Check if the session array already has data and if
             * does then display in table format.
             */
            } else if (isset($_SESSION['medList'])) {

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>";
                    echo "\n\t\t\t\t<td>";

                    echo "<form action=" . $_SERVER['PHP_SELF'] . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number'>Remove</button></form>";




                    echo "</td>";

                    echo "\n\t\t\t</tr>\n";
                    $number++;
                    echo $number;
                }



                if (isset($_GET['remove'])) {
                    echo "GET Remove: " . $_GET['remove'];
                    $newNumber = $_GET['remove'] + 1;
                    echo "New number : " . $newNumber;
                    echo "Array: " . array_search($newNumber, $_SESSION['medList']);
                    echo "<h2>Please confirm deletion by pressing button once more.</h2>";
                    echo "Number: " . $number;
                    unset($_SESSION['medList'][$newNumber]);
                    $_SESSION['medList'] = array_values($_SESSION['medList']);
                    echo "Session: " . var_dump($_SESSION['medList']);
                    unset($_GET['remove']);
                }






            /*
             * Display for users if there is not information
             * stored in the session array.
             */
            } else {

                echo "<p>Please enter patients medications</p>";

            }

            ?>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
</body>
</html>