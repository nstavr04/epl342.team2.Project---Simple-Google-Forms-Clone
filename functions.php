
<?php
// Print sql errors
function FormatErrors($errors)
{
    /* Display errors. */
    echo "Error information: ";

    foreach ($errors as $error) {
        echo "SQLSTATE: " . $error['SQLSTATE'] . "";
        echo "Code: " . $error['code'] . "";
        echo "Message: " . $error['message'] . "";
    }
}

// print a certain column (1i i 2i i 3i...)
function PrintResultCol($resultSet, $column)
{
    $cnt = 0;
    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        foreach ($row as $col) {
            $cnt++;
            if ($cnt == $column)
                return (is_null($col) ? "Null" : $col);
        }
        $cnt = 0;
    }
}

function PrintResultSet($resultSet)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {
        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            echo (is_null($col) ? "Null" : $col);
            echo ("</td>");
        }
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}

//print resultset with 1 date
function PrintResultSetDate($resultSet, $datevar)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    // Used to check if we have datetime we will echo differently since datetime cannot be converted to string with echo
    $counter = 1;
    $flag = 0;
    $counter2 = 1;

    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {

        // Find the column where we have a DateTime data type
        // Add with OR for the other 2 dates in other tables
        if ($fieldMetadata["Name"] == $datevar)
            $flag = 1;
        if ($fieldMetadata["Name"] != $datevar && $flag == 0)
            $counter++;

        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            if ($counter2 == $counter) {
                //Converts datatime to string
                //echo date_format($col,"Y-m-d H:i:s");
                echo date_format($col, "Y-m-d");
                // $myDateTime = DateTime::createFromFormat('Y-m-d', $col);
                // $datetime = $myDateTime->format('d-m-Y');
                // echo $datetime;
            } else {
                echo (is_null($col) ? "Null" : $col);
            }
            echo ("</td>");
            $counter2++;
        }
        $counter2 = 1;
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}

//print resultset with 2 dates (NEEDS CHECKING)
function PrintResultSetDate2($resultSet, $datevar, $date2var)
{
    echo '<div class="table-responsive">';
    echo ('<table class="table" style="text-align: center; vertical-align:middle">');
    echo '<thead><tr>';
    // Used to check if we have datetime we will echo differently since datetime cannot be converted to string with echo
    $counter0 = 1;
    $counter = 1;
    $flag = 0;
    $flag0 = 0;
    $counter2 = 1;

    foreach (sqlsrv_field_metadata($resultSet) as $fieldMetadata) {

        // Find the column where we have a DateTime data type
        // Add with OR for the other 2 dates in other tables
        if ($fieldMetadata["Name"] == $datevar)
            $flag = 1;
        if ($fieldMetadata["Name"] == $date2var)
            $flag0 = 1;
        if ($fieldMetadata["Name"] != $datevar && $flag == 0)
            $counter++;
        if ($fieldMetadata["Name"] != $date2var && $flag0 == 0)
            $counter0++;

        echo ('<th scope="col">');
        echo $fieldMetadata["Name"];
        echo ("</th>");
    }
    echo ("</tr></thead><tbody>");

    while ($row = sqlsrv_fetch_array($resultSet, SQLSRV_FETCH_ASSOC)) {
        echo ("<tr>");
        foreach ($row as $col) {
            echo ("<td>");
            if ($counter2 == $counter || $counter2 == $counter0) {
                //Converts datatime to string
                //echo date_format($col,"Y-m-d H:i:s");
                echo date_format($col, "Y-m-d");
                // $myDateTime = DateTime::createFromFormat('Y-m-d', $col);
                // $datetime = $myDateTime->format('d-m-Y');
                // echo $datetime;
            } else {
                echo (is_null($col) ? "Null" : $col);
            }
            echo ("</td>");
            $counter2++;
        }
        $counter2 = 1;
        echo ("</tr>");
    }
    echo ("</tbody></table>");
    echo '</div>';
}
?>