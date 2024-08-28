<?php
require_once('PhpXlsxGenerator.php');
include 'connection.php';

if (isset($_POST['to_date']) && isset($_POST['from_date'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $fileName = "date_wise_record" . date('Y-m-d') . '.csv';

    $exceldata[] = array('Name', 'Email', 'Mobile ');
    $sql = "SELECT * FROM customer where fetch_date between '$to_date' AND '$from_date' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {

            $linedata = array($row['cname'], $row['cmobile'], $row['cemail']);
            $exceldata[] = $linedata;
        }
    }



    //else if close



    $xlxs = CodexWorld\PhpXlsxGenerator::fromArray($exceldata);
    $xlxs->downloadAs($fileName);
    exit();
} //main if  close
else if(isset($_POST['submit'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    
    $fileName = "date_wise_record" . date('Y-m-d') . '.csv';

    $exceldata[] = array('Name', 'Email', 'Mobile ');
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($con, $sql);
    

    if (mysqli_num_rows($result) > 0) {
        // print_r($ph);
        // exit;

        while ($row = mysqli_fetch_array($result)) {

            $linedata = array($row['cname'], $row['cmobile'], $row['cemail']);
            $exceldata[] = $linedata;
        }
    }

    $xlxs = CodexWorld\PhpXlsxGenerator::fromArray($exceldata);
    $xlxs->downloadAs($fileName);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get-Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">


        <form class="row justify-content-center m-5 g-3" method="POST">
            <div class="col-auto col-lg-3 ">
                <label for="to_date" class="visually-hidden">To Date</label>
                <input type="date" class="form-control" name="to_date" id="to_date">
            </div>
            <div class="col-auto col-lg-3">
                <label for="from_date" class="visually-hidden">To Date</label>
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