//connect.php
<?php
$con=new mysqli('localhost','root','','prac');
if(!$con){
    die(mysqli_error($con));
}
?>


//insert
<?php
include('connect.php');

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $country=$_POST['country'];


$sql="insert into `prac` (name,mobile,country) values('$name','$mobile','$country')";
$result=mysqli_query($con,$sql);
if($result){
    echo "added";
}
else{
    die(mysqli_error($con));
}
}
?>


//display
<table border="1">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Country</th>
                <th>operations</th>
            </thead>
            <tbody>
                <?php
                $sql="select * from `prac`";
                $result=mysqli_query($con,$sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $name=$row['name'];
                        $mobile=$row['mobile'];
                        $country=$row['country'];
                        echo '<tr>
                <th>'.$id.'</th>
                <td>'.$name.'</td>
                <td>'.$mobile.'</td>
                <td>'.$country.'</td>
                <td>
                    <button><a href="update.php?updateid='.$id.'">update</a></button>
                    <button><a href="?deleteid='.$id.'">delete</a></button>
                </td>
                </tr>';
                    }
                }


//delete
                if(isset($_GET['deleteid'])){
                    $id=$_GET['deleteid'];
                    $sql="delete from `prac` where id='$id'";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        echo "deleted";
                    }
                    else{
                        die(mysqli_error($con));
                    }
                }
                ?>
                
            </tbody>
        </table>

//update
<?php
include('connect.php');

$id=$_GET['updateid'];
$sql="select * from `prac` where id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$mobile=$row['mobile'];
$country=$row['country'];

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $country=$_POST['country'];


$sql="update `prac` set id='$id',name='$name',mobile='$mobile',country='$country' where id='$id'";
$result=mysqli_query($con,$sql);
if($result){
    header("location:index.php");
}
else{
    die(mysqli_error($con));
}
}
?>

//search
 <?php
              if(isset($_POST['submit1'])){
               $search=$_POST['search'];
               $sql="select * from `prac` where id='$search'";
                $result=mysqli_query($con,$sql);
                if($result){
                    if(mysqli_num_rows($result)>0){
                        echo '<thead><tr>
                <th>Id</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Country</th>
                </tr>
            </thead>';

            $row=mysqli_fetch_assoc($result);
            echo '<tbody><tr>
                <th>'.$row['id'].'</th>
                <td>'.$row['name'].'</td>
                <td>'.$row['mobile'].'</td>
                <td>'.$row['country'].'</td>
                </tr>
                </tbody>';
                    }
                    else{
                        echo '<h21>data not found</h2>';
                    }
                }
              }
              
              ?>
