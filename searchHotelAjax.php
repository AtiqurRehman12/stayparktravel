<?php
require_once './admin/inc/sqlfunctions.php';
$searched = $_POST["searched"];
$search_sql = "SELECT * FROM airports WHERE airport LIKE '%$searched%'";
$search_res = mysqli_query($connection, $search_sql);
if(mysqli_num_rows($search_res)>0){
    while($search_row = mysqli_fetch_array($search_res)){
        $data[] = $search_row;
    }
    print_r(json_encode($data));
}
 ?>