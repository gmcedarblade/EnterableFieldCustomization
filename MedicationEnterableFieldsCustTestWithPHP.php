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
    <div class="testArea" style="border: 1px solid #000;">
        <form style="padding: 10px;" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="get">
            <label>Medication</label>
            <input type="text" spellcheck="true" id="drugName" name="drugName" required="required">
            <label>Dosage</label>
            <input type="number" id="drugDosage" name="drugDosage" required="required">
            <label>Unit(s)</label>
            <select id="drugUnit" name="drugUnit" required="required">
                <option value="N/A">N/A</option>
                <option value="cc">cc</option>
                <option value="milligrams">mg</option>
                <option value="micrograms">mcg</option>
                <option value="unit">unit</option>
                <option value="capsule">capsule</option>
                <option value="tablet">tablet</option>
            </select>
            <label>Description</label>
            <input type="text" spellcheck="true" id="drugDescription" name="drugDescription" required="required">
            <button class="submit" type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div class="medList">
        <table id="medTable">
            <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Unit(s)</th>
                <th>Description</th>
                <th>Edit</th>
            <?php
            echo "</tr>\n";

            global $number;
            $number = 0;

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


                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number'>Delete</button></form>";

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number'>Discontinue</button></form>";

                    echo "</td>";
                    $number++;

                    echo "\n\t\t\t</tr>\n";

                }

                if(isset($_SESSION['discontinueList'])) {

                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr><th>Discontinued Medication</th><th>Dosage</th><th>Unit(s)</th><th>Description</th><th>Edit</th>";

                    foreach ($_SESSION['discontinueList'] as $value) {


                        echo "\t\t\t<tr>\n\t\t\t\t<td>" . $value['drugName'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugDose'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugUnit'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugDesc'] . "</td>";
                        echo "\n\t\t\t\t<td>";


                        echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number' disabled='disabled'>Delete</button></form>";

                        echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number' disabled='disabled'>Discontinue</button></form>";

                        echo "</td>";
                        $number++;

                        echo "\n\t\t\t</tr>\n";

                    }

                }

            /*
             * Check if the session array already has data and if
             * the remove button has already been pressed, then display in table format,
             * with the remove buttons disabled until the confirm button has been pressed.
             */
            } else if (isset($_SESSION['medList']) && isset($_GET['remove'])) {

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>";
                    echo "\n\t\t\t\t<td>";
                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number' disabled='disabled'>Delete</button></form>";

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number' disabled='disabled'>Discontinue</button></form>";
                    echo "</td>";
                    echo "\n\t\t\t</tr>\n";
                    $number++;

                }

                if (isset($_GET['remove'])) {

                    echo "<h2>Please confirm deletion</h2>";

                    unset($_SESSION['medList'][$_GET['remove']]);

                    $_SESSION['medList'] = array_values($_SESSION['medList']);

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='confirm'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='confirm' id=" . $number . " value='-1'>Confirm</button></form>";

                }


            /*
             * Check if there is items in the session and if the
             * user has clicked on the discontinue button.
             */
            } else if (isset($_SESSION['medList']) && isset($_GET['discontinue'])) {

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>";
                    echo "\n\t\t\t\t<td>";
                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number' disabled='disabled'>Delete</button></form>";

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number' disabled='disabled'>Discontinue</button></form>";
                    echo "</td>";
                    echo "\n\t\t\t</tr>\n";
                    $number++;

                }

                if (isset($_GET['discontinue'])) {

                    $_SESSION['discontinueList'][] =  $_SESSION['medList'][$_GET['discontinue']];

                    echo "<h2>Please confirm discontinuation</h2>";

                    unset($_SESSION['medList'][$_GET['discontinue']]);

                    $_SESSION['medList'] = array_values($_SESSION['medList']);

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='confirm'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='confirm' id=" . $number . " value='-1'>Confirm</button></form>";
                    $number++;
                }
            /*
             * Checking if the confirm button was pressed and
             * if it was then display the rows with the remove
             * button active.
             */

            } else if (isset($_GET['confirm']) || isset($_SESSION['medList'])) {

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>";
                    echo "\n\t\t\t\t<td>";
                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number'>Delete</button></form>";

                    echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number'>Discontinue</button></form>";

                    echo "</td>";
                    echo "\n\t\t\t</tr>\n";
                    $number++;

                }

                if(isset($_SESSION['discontinueList'])) {

                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr></tr>";
                    echo "<tr><th>Discontinued Medication</th><th>Dosage</th><th>Unit(s)</th><th>Description</th><th>Edit</th>";
                    foreach ($_SESSION['discontinueList'] as $value) {

                        echo "\t\t\t<tr>\n\t\t\t\t<td>" . $value['drugName'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugDose'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugUnit'] . "</td>";
                        echo "\n\t\t\t\t<td>" . $value['drugDesc'] . "</td>";
                        echo "\n\t\t\t\t<td>";


                        echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='remove'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='remove' id=" . $number . " value='$number' disabled='disabled'>Delete</button></form>";

                        echo "<form action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='get' name='discontinue'><input type='hidden' name='number' value=" . $number . "><button type='submit' name='discontinue' id=" . $number . " value='$number' disabled='disabled'>Discontinue</button></form>";

                        echo "</td>";
                        $number++;

                        echo "\n\t\t\t</tr>\n";

                    }

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