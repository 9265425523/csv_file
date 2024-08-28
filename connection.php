<?php 
            $con=mysqli_connect('localhost','root','','fetch_record');

            if(!$con){
                echo 'Connection Not Successfully' ,mysqli_error($con);
            }
?>