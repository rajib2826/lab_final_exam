<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title> 
    <style> 
      table{ 
          border : 1px solid; 
         
         width : 80%; 
      } 
      th,td{ 
         border : 2px solid black; 
         text-align:center; 
      } 
 
      
    </style> 
</head> 
<body> 
    
   <?php 
    include('connection.php'); 
    $username = ""; 
    $name = ""; 
    $age = ""; 
    $password = ""; 
    $id = null; 
    $update = false; 
    if(isset($_GET['edit'])) 
    { 
      $update = true; 
      $id = $_GET['edit']; 
      $sql = "SELECT  username, name, age,  password FROM data WHERE id=$id"; 
      $result = $conn->query($sql); 
      $row = $result->fetch_assoc(); 
      $username = $row['username']; 
      $name = $row['name']; 
      $age = $row['age']; 
      $password = $row['password']; 
           
    } 
   ?> 
    <form action="index.php" method="post"> 
      <input type="hidden" name="id" value="<?php echo $id ?>"> 
       Username: <input type="text" name="username" value="<?php echo $username ?>"><br> 
       Name: <input type="text" name="name" value="<?php echo $name ?>"><br> 
       Age: <input type="text" name="age" value="<?php echo $age ?>"><br> 
       Password: <input type="password" name="password" value="<?php echo $password ?>"><br> 
       <?php if($update): ?> 
      <input type="submit" name="update" value="Update"> 
      <?php else: ?> 
       <input type="submit" name="submit"> 
       <?php endif ?> 
       <input type="submit" name="show" value="Show"> 
    </form> 
 
    <?php 
        
       function view() 
       { 
         include('connection.php'); 
         $show = 'SELECT * FROM data'; 
         $result = $conn->query($show); 
 
          if($result->num_rows > 0) 
          { 
            echo "<table class='table'> 
               <th>Id</th> <th>User Name</th> <th >Name</th> <th>Age</th> <th>Update</th> <th>Delete</th>"; 
            while($row = $result->fetch_assoc()) 
            { 
               $vID = $row['id']; 
               echo " 
               <tr><td>".$row['id']."</td> 
               <td>".$row['username']."</td> 
               <td>".$row['name']."</td> 
               <td>".$row['age']."</td> 
               <td><a href='index.php?edit=$vID'> edit </a></td>  
               <td><a href='index.php?delete=$vID'> delete </a></td></tr> 
               "; 
                
            } 
            echo "</table>"; 
          } 
       } 
        
       if(isset($_POST['submit'])) 
       { 
          $username = $_POST['username']; 
          $name = $_POST['name']; 
          $age = $_POST['age']; 
          $password = $_POST['password']; 
          $sql = "INSERT INTO data(username, name, age, password) 
          values('$username', '$name', '$age', '$password') 
          "; 
           
          $conn->query($sql); 
          view(); 
      } 
 
      elseif(isset($_POST['show'])) 
      { 
           view(); 
           
      } 
 
       elseif(isset($_POST['update'])) 
       { 
          $vID = $_POST['id']; 
          $username = $_POST['username']; 
          $name = $_POST['name']; 
          $age = $_POST['age']; 
          $password = $_POST['password']; 
 
          $sql = "UPDATE data SET username='$username', name='$name', age='$age', password='$password' where id='$vID' "; 
          $conn->query($sql); 
          view(); 
       } 
 
       elseif(isset($_GET['delete'])) 
       { 
         $vID = $_GET['delete'];
         $sql = " DELETE FROM data WHERE id=$vID "; 
         $conn->query($sql); 
         view(); 
       } 
 
        
    ?> 
 
</body> 
</html>