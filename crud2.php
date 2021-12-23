<?php
    $server_name = "localhost";
    $user_name = "db_con";
    $user_password = "123456";
    $db_name = "crud";

    $conn = new mysqli($server_name,$user_name,$user_password,$db_name);

    if(isset($_POST["submit"])){

        if(!empty($_POST["name"]) && !empty($_POST["reg"])){
            if(strlen($_POST["name"])<=30 && strlen($_POST["reg"]) <=6){
                $stdname = val($_POST["name"]);
                $stdreg = val($_POST["reg"]);
                $query = "INSERT INTO student(stdname,reg) VALUE('$stdname',$stdreg)";
                $submitdata = mysqli_query($conn,$query);
            }else{
                echo '<div class="alert alert-danger" role="alert">Name should be maximam 30 carecter and reg should be 6 number</div>';
            }
        }else{
            echo '<div class="alert alert-danger" role="alert">Name and reg is requered!</div>';
        }
    }


    function val($data){
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
    <title>Crud2 php</title>
    <style>
        th,td{
            border: 1px solid #999999;
        }
    </style>
</head>
<body>

<div class="container my-2">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex" method="post">
        <input type="text" class="form-control" name="name" placeholder="Your name">
        <input type="number" class="form-control" name="reg" placeholder="Your reg">
        <input type="submit" name="submit" class="btn btn-success">
    </form>
</div>
<div class="container my-2">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="d-flex" method="get">
        <?php 
            if(isset($_GET["update"])){
                $stdid = $_GET["update"];
                $query = "SELECT * FROM student WHERE ID={$stdid}";
                $getdata = mysqli_query($conn, $query);
                while($rd = mysqli_fetch_assoc($getdata)){
                    $stdid = $rd["id"];
                    $stdname = $rd["stdname"];
                    $stdreg = $rd["reg"];
        ?>
        <input type="text" class="form-control" name="name" value="<?php echo $stdname;?>" placeholder="Your name">
        <input type="number" class="form-control" name="reg" value="<?php echo $stdreg;?>" placeholder="Your reg">
        <input type="submit" value="Update" name="update" class="btn btn-info">
        <?php }}?>
        <?php 
            if(isset($_POST["update"])){
                $stdname = $_POST["stdname"];
                $stdreg = $_POST["reg"];
                $query = "UPDATE student SET stdname='$stdname',$stdreg=$stdreg WHERE id=$stdid";
                $updatequery = mysqli_query($conn,$query);
            }
        ?>
    </form>
</div>





<div class="container my-5">
    <table class="table table-border">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>REG</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM student";
            $read_query = mysqli_query($conn, $query);
            if($read_query -> num_rows >0){
                while($rd=mysqli_fetch_assoc($read_query)){
                    $stdid = $rd["id"];
                    $stdname = $rd["stdname"];
                    $stdreg = $rd["reg"];
        ?>
        <tr>
            <td><?php echo $stdid;?></td>
            <td><?php echo $stdname; ?></td>
            <td><?php echo $stdreg; ?></td>
            <td><a href="crud2.php?update=<?php echo $stdid;?>" class="btn btn-primary">Update</a></td>
            <td><a href="crud2.php?delete=<?php echo $stdid;?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php }}?>
    </table>
</div>















<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>