<?php 
$host='localhost';
$user='root';
$password='';
$database='skadarlija_db';

$conn= new mysqli($host,$user,$password,$database);
if ( mysqli_connect_errno() ) {
    printf("Connection failed: %s\
", mysqli_connect_error());
    exit();
};

function selectAll($table, $conditions=[]){
    global $conn;
    $sql = "SELECT * From $table";
    if (empty($conditions)) {
        $query=$conn->prepare($sql);
        $query->execute();
        $result=$query->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    } 
    };
    function dd($value){
        echo "<pre>". print_r($value, true)."</pre>";
         }; 
?>