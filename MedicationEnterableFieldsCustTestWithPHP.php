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

            if (isset($_GET["submit"])) {

                $drugName = $_GET["drugName"];
                $drugDose = $_GET['drugDosage'];
                $drugUnit = $_GET['drugUnit'];
                $drugDesc = $_GET['drugDescription'];

                $thisMedList = array();

                $thisMedList["drugName"] = $drugName;
                $thisMedList["drugDose"] = $drugDose;
                $thisMedList["drugUnit"] = $drugUnit;
                $thisMedList["drugDesc"] = $drugDesc;

                $_SESSION['medList'][] = $thisMedList;

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>\n\t\t\t</tr>\n";

                }

            } else if (isset($_SESSION['medList'])) {

                foreach ($_SESSION['medList'] as $item) {

                    echo "\t\t\t<tr>\n\t\t\t\t<td>" . $item["drugName"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDose"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugUnit"] . "</td>";
                    echo "\n\t\t\t\t<td>" . $item["drugDesc"] . "</td>\n\t\t\t</tr>\n";

                }

            } else {

                echo "<p>Please enter patients medications</p>";

            }

            ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
</body>
</html>