<?php
    $server_name = "localhost";
    $user_name = "db_con";
    $user_password = "123456";
    $db_name = "crud";
    $conn = new mysqli($server_name,$user_name,$user_password,$db_name);

    if($conn -> connect_error){
        die("Connection failed: ".$conn -> connect_error);
    }
    
    $val_error="";

    if(isset($_POST["submit"])){

        $stdname = vali($_POST["stdname"]);
        $stdreg =  vali($_POST["stdreg"]);

        if(!empty($stdname) && !empty($stdreg)){
            $query = "INSERT INTO student_info(STUDENT_NAME,REG) VALUE('$stdname',$stdreg)";
            $createquery = mysqli_query($conn,$query);
            $dasubmit = "Your data submited";
        }else{
            $val_error = "You should be valid data fill up on fild";
        }
    }
    function vali($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Crud method</title>
    <style>
        th,td{
            border: 1px solid #999999;
        }
    </style>
</head>
<body>
    



<div class="container">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="d-flex mt-5 mb-5">
        <input type="text" class="form-control me-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type your name" name="stdname">
        <input type="number" class="form-control me-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type your reg" name="stdreg">
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </form>
</div>
<div class="container">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="d-flex mt-5 mb-5">
        <?php
            if(isset($_GET["update"])){
                $stdid = $_GET["update"];
                $query = "SELECT * FROM student_info WHERE ID = {$stdid}";
                $getdata = mysqli_query($conn, $query);
                while($rx = mysqli_fetch_assoc($getdata)){
                    $stdid = $rx["ID"];
                    $stdname = $rx["STUDENT_NAME"];
                    $stdreg = $rx["REG"];
        ?>

<input type="text" class="form-control me-3" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $stdname; ?>" name="stdname">
        <input type="number" class="form-control me-3" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $stdreg; ?>" name="stdreg">
        <button type="submit" name="update_btn" class="btn btn-primary">update</button>
        <?php }}?>
        <?php
            if(isset($_POST["update_btn"])){
                $stdname = $_POST["stdname"];
                $stdreg = $_POST["stdreg"];
                $query = "UPDATE student_info SET 	STUDENT_NAME='$stdname',REG=$stdreg WHERE ID = $stdid";
                $updatequery = mysqli_query($conn,$query);
            }
        ?>
    </form>
</div>
<div class="container p-4">
    <table class="table table-borderd">
        <tr>
            <th>STUDENT ID</th>
            <th>STUDENT NAME</th>
            <th>STUDENT REG</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM `student_info`";
            $readquery = mysqli_query($conn,$query);
            if($readquery -> num_rows >0){
                while($rd = mysqli_fetch_assoc($readquery)){
                    $stdid = $rd["ID"];
                    $stdname = $rd["STUDENT_NAME"];
                    $stdreg = $rd["REG"];
        ?>
        <tr>
            <td><?php echo $stdid; ?></td>
            <td><?php echo $stdname; ?></td>
            <td><?php echo $stdreg; ?></td>
            <td><a href="CRUD1.php?update=<?php echo $stdid; ?>" class="btn btn-info">Update</a></td>
            <td><a href="CRUD1.php?delete=<?php echo $stdid; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php  }}?>
    </table>
</div>



<?php
    
// Delete area

if(isset($_GET["delete"])){
    $stddel = $_GET["delete"];
    $query = "DELETE FROM student_info WHERE ID={$stdid}";
    $deletequery = mysqli_query($conn,$query);
}else{
    $nullvar = "Inpyt is blanck";
}

?>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>