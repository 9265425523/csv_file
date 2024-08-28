<?php
require_once('PhpXlsxGenerator.php');
include 'connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get date inputs from the form
    $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    
    // Define the file name for the download
    $fileName = "date_wise_record_" . date('Y-m-d') . '.csv';

    // Prepare data for CSV
    $exceldata[] = array('Name', 'Email', 'Mobile');

    // Build the SQL query
    if (!empty($from_date) && !empty($to_date)) {
        // If both dates are provided, fetch records within the date range
        $sql = "SELECT * FROM customer WHERE fetch_date BETWEEN '$from_date' AND '$to_date'";
    } else {
        // If no dates are provided, fetch all records
        $sql = "SELECT * FROM customer";
    }

    // Execute the query
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $linedata = array($row['cname'], $row['cmobile'], $row['cemail']);
            $exceldata[] = $linedata;
        }
        $xlxs = CodexWorld\PhpXlsxGenerator::fromArray($exceldata);
        $xlxs->downloadAs($fileName);
        exit();
    }else{
        echo "not found";
    }

    

    // Generate and download the CSV file
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>export</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form class="row justify-content-center m-5 g-3" method="POST">
            <div class="col-auto col-lg-3">
                <label for="to_date" class="visually-hidden">To Date</label>
                <input type="date" class="form-control" name="to_date" id="to_date">
            </div>
            <div class="col-auto col-lg-3">
                <label for="from_date" class="visually-hidden">From Date</label>
                <input type="date" class="form-control" name="from_date" id="from_date">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" name="submit">GET RECORD</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>
