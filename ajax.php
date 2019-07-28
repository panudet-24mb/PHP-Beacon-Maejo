<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

$requestData= $_REQUEST;

$columns = array( 
 0 =&gt;'employee_name', 
 1 =&gt; 'employee_salary',
 2=&gt; 'employee_age'
);

$sql = "SELECT employee_name, employee_salary, employee_age ";
$sql.=" FROM employee";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = "SELECT employee_name, employee_salary, employee_age ";
$sql.=" FROM employee WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
 $sql.=" AND ( employee_name LIKE '".$requestData['search']['value']."%' ";    
 $sql.=" OR employee_salary LIKE '".$requestData['search']['value']."%' ";

 $sql.=" OR employee_age LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query);
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
 $nestedData=array(); 
 $nestedData[] = $row["employee_name"];
 $nestedData[] = $row["employee_salary"];
 $nestedData[] = $row["employee_age"];
 $data[] = $nestedData;
}

$json_data = array(
   "draw" =&gt; intval( $requestData['draw'] ),
   "recordsTotal" =&gt; intval( $totalData ),  // total number of records
   "recordsFiltered" =&gt; intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
   "data"            =&gt; $data   // total data array
   );

echo json_encode($json_data);  // send data as json format

?>