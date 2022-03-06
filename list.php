<?php
   $server = "localhost";
   $username = "root";
   $password = "";
   $dbname = "db_trip";

   //create a database connection
   $conn    = new mysqli($server , $username , $password, $dbname);

   //check for connection status
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

    $tripQry = "SELECT * FROM tb_trip WHERE status = 'active' ORDER BY date_updated DESC";
    $resTrip = $conn->query($tripQry);
    $tripsArr = array();
    if($resTrip->num_rows > 0){
        while($tripRow = $resTrip->fetch_assoc()) {
            $tripsArr[] = $tripRow;
        }
        }
   
    //close the database connection
    $conn->close();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="liststyle.css">
</head>
<body>
    <div class="container">
    <h3>List of students going for trip: </h3>
        <table >
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Father's Mobile No.</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Address</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(is_array($tripsArr) && count($tripsArr) > 0){
                    $srNo = 0;
                    foreach($tripsArr as $tRow){
                        $srNo++;
                        $trHtml = '<tr>';
                        $trHtml .= '<td>'.$srNo.'</td>';
                        $trHtml .= '<td>'.$tRow['name'].'</td>';
                        $trHtml .= '<td>'.$tRow['mobile_no'].'</td>';
                        $trHtml .= '<td>'.$tRow['fmobile_no'].'</td>';
                        $trHtml .= '<td>'.$tRow['email'].'</td>';
                        $trHtml .= '<td>'.$tRow['class'].'</td>';
                        $trHtml .= '<td>'.nl2br($tRow['home_address']).'</td>';
                        $trHtml .= '<td>'.date('d/m/Y h:i A', strtotime($tRow['date_updated'])).'</td>';
                        $trHtml .= '</tr>';
                        echo $trHtml;
                    }
                }
                else{
                ?>
                <tr><td colspan="8">No Records Found</td></tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>