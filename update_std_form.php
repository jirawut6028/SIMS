<?php
$id = $_GET["id"];
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "students";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}
$sql = "SELECT * FROM std_info WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#studentForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize(); 
                $.ajax({
                    type: "POST",
                    url: "update_std.php",
                    data: formData,
                    success: function (response) {
                        if (response === "success") {
                            alert("Update Record ID " + <?php echo $row["id"]; ?> + " Successfully!");
                            window.location.href = "student.php";
                        } else {
                            alert("Error: " + response);
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <form id="studentForm">
        id: <input type="text" name="id" value="<?php echo $row["id"]; ?>" readonly><br>
        name: <input type="text" id="en_name" name="en_name" value="<?php echo $row["en_name"]; ?>" required><br>
        surname: <input type="text" id="en_surname" name="en_surname" value="<?php echo $row["en_surname"]; ?>" required><br>
        ชื่อ: <input type="text" id="th_name" name="th_name" value="<?php echo $row["th_name"]; ?>" required><br>
        นามสกุล: <input type="text" id="th_surname" name="th_surname" value="<?php echo $row["th_surname"]; ?>" required><br>
        Major: <input type="text" id="major_code" name="major_code" value="<?php echo $row["major_code"]; ?>"><br>
        Email: <input type="email" id="email" name="email" value="<?php echo $row["email"]; ?>"><br>
        <input type="submit" value="Update">
        <input type="reset" value="Reset">
    </form>
</body>
</html>
