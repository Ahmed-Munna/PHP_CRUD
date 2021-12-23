<?php
    $conn = new mysqli('localhost','db_con','123456','crud');
    if(isset($_POST["submit"])){
        $stdname = val($_POST["name"]);
        $stdreg = val($_POST["reg"]);
        if(!empty($stdname) && strlen($stdname) <= 20 && strlen($stdreg) == 6){
            $query = "INSERT INTO form(`name`,`reg`) VALUES('$stdname',$stdreg)";
            $insert_data = mysqli_query($conn,$query);
            if($insert_data){
                echo 'Insert data successfully';
            }else{
                echo 'Insert data failed';
            }
        }else{
            echo 'not valid input fild';
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
    <title>Crud project</title>
    <style>
        table{
            border-collapse: collapse;
        }
        th,td{
            padding: 20px;
        }
        .id{
            display: none;
        }
    </style>
</head>
<body>

    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="text" name="name" placeholder="Your Name"><br>
        <input type="number" name="reg" placeholder="Password"><br>
        <input type="submit" name="submit">
    </form>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <?php
        if(isset($_GET["edit"])){
            $stdid = $_GET["edit"];
            $query = "SELECT * FROM form WHERE id={$stdid}";
            $insert_data = mysqli_query($conn,$query);
            while($upData = mysqli_fetch_assoc($insert_data)){
                $stdid = $upData ["id"];
                $stdname = $upData ["name"];
                $stdreg = $upData ["reg"];
    ?>
        <input type="text" name="name" value="<?php echo $stdname;?>"><br>
        <input type="number" name="reg" value="<?php echo $stdreg;?>"><br>
        <input type="number" class="id" name="id" value="<?php echo $stdid;?>">
        <input type="submit" name="update" value="Update">
        <?php }};
         if(isset($_POST["update"])){
            $stdid = val($_POST["id"]);
            $stdname = val($_POST["name"]);
            $stdreg = val($_POST["reg"]);
            if(!empty($stdname) && strlen($stdname) <= 20 && strlen($stdreg) == 6){
                $query = "UPDATE form SET `name`='$stdname',`reg`=$stdreg WHERE id={$stdid}";
                $insert_data = mysqli_query($conn,$query);
                if($insert_data){
                    echo 'update data successfully';
                }else{
                    echo 'Update data failed';
                }
            }else{
                echo 'not valid input fild';
            }
        }
        ?>
    </form>

    <table border="1px">
        <tr>
            <th>SL NO</th>
            <th>Name</th>
            <th>Regestation</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM `form`";
            $insert_data = mysqli_query($conn,$query);
            if($insert_data -> num_rows > 0){
                while($data = mysqli_fetch_assoc($insert_data)){
                    $stdid = $data["id"];
                    $stdname = $data["name"];
                    $stdreg = $data["reg"];
        ?>
        <tr>
            <td><?php echo $stdid;?></td>
            <td><?php echo $stdname;?></td>
            <td><?php echo $stdreg;?></td>
            <td><a href="crud3.php?edit=<?php echo $stdid ?>">edit</a></td>
            <td><a href="crud3.php?delete=<?php echo $stdid ?>">Delete</a></td>
        </tr>
        <?php
                }
            }else{
                echo 'Have not any data';
            }
        ?>
    </table>
        <?php
            if(isset($_GET["delete"])){
            if(!empty($stdid)){
                $query = "DELETE FROM form WHERE id=$stdid";
                $insert_data = mysqli_query($conn,$query);
                if($insert_data){
                    echo 'Delete Successfull';
                }else{
                    echo 'Something is wrong';
                }
            }
         }
        ?>








</body>
</html>
<?php
    
?>