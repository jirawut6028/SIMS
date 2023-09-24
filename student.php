<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function deleteRecord(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    type: "POST",
                    url: "delete_std.php",
                    data: { id: id },
                    success: function(response) {
                        if (response === "success") {
                            alert(`Delete Record ID ${id} Successfully!`);
                            window.location.reload(); 
                        } else {
                            alert("Error: " + response);
                        }
                    }
                });
            }
        }
</script>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
ini_set('display_startup_errors','1');


$servername="localhost";
$username="root";
$password="12345678";
$dbname="students";
// create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die("Connection failed ".mysqli_connect_error());
}
$sql="SELECT * FROM `std_info`";
$result=mysqli_query($conn,$sql);
if($result){
    if(mysqli_num_rows($result)>0){
        echo "<table border='1'>";
        echo "<tr><th>id</th><th>name</th><th>surname</th>";
        echo "<th>ชื่อ</th><th>นามสกุล</th>";
        echo "<th>Major</th><th>email</th><th>ลบ</th><th>แก้ไข</th></tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["id"]."</td>";
            echo "<td>".$row["en_name"]."</td>";
            echo "<td>".$row["en_surname"]."</td>";
            echo "<td>".$row["th_name"]."</td>";
            echo "<td>".$row["th_surname"]."</td>";
            echo "<td>".$row["major_code"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td><button onclick='deleteRecord(".$row["id"].")' style='cursor: pointer;'>X</button></td>";
            echo "<td><button><a href='update_std_form.php?id=".$row["id"]."' style='text-decoration: none; color:black'>edit</a></button></td></tr>";
        }
        echo "</table>";
    }
}
echo "<button><a href='insert_std_form.html' style='text-decoration: none; color:black'>Insert New Record</a></button>";
mysqli_close($conn);
?>
</body>
</html>