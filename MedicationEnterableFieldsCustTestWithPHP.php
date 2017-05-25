<?php
session_start();
$_SESSION['visits']++;
print_r("You have been here: " . $_SESSION['visits'] . " times.");
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

if (isset($_SESSION['medList'])) {

    $medList = $_SESSION['medList'];

} else {

    $medList = Array();

}

$number = 0;

if (isset($_POST['remove'])) {
    $remove = $_POST['remove'];
} else {
    $remove = Array();
}

?>
    <div class="testArea" style="border: 1px solid #000;">
        <form style="padding: 10px;" action="<?=$_SERVER['PHP_SELF']?>" method="get">
            <label>Medication</label>
            <input type="text" spellcheck="true" id="drugName<?=$number?>" name="drugName">
            <label>Dosage</label>
            <input type="number" id="drugDosage<?=$number?>" name="drugDosage">
            <label>Units</label>
            <select id="drugUnit<?=$number?>" name="drugUnit">
                <option value="cc">cc</option>
                <option value="milligrams">mg</option>
                <option value="micrograms">mcg</option>
                <option value="unit">unit</option>
                <option value="capsule">capsule</option>
                <option value="tablet">tablet</option>
            </select>
            <label>Description</label>
            <input type="text" spellcheck="true" id="drugDescription<?=$number?>" name="drugDescription">
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
                    echo "\n\t\t\t\t<td><form action=" . $_SERVER['PHP_SELF'] . " method='post'><button type='submit' name='remove[$item]' id='remove' value='Remove'>Remove</button></td></form>";
                    echo "\n\t\t\t</tr>\n";
                    $number++;
                    echo $number;
                }
                if (isset($remove[$item])) {
                    echo "here!!";
//                    unsest($_SESSION["medList"]);
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
                    echo "\n\t\t\t\t<td><form action=" . $_SERVER['PHP_SELF'] . " method='post'><button type='submit' name='remove' id='remove' value='Remove'>Remove</button></td></form>";
                    echo "\n\t\t\t</tr>\n";
                    $number++;
                    echo $number;
                }
                if (isset($_POST['remove'])) {
                    echo "here!!";
//                    unsest($_SESSION["medList"]);
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