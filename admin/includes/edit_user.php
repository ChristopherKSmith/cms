
<?php

if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];
}
$query = "SELECT * FROM users WHERE user_id = $the_user_id";
$select_users_by_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_users_by_id) ){

    $user_firstname = $row['user_firstname'];    
    $user_lastname = $row['user_lastname'];    
    $username = $row['username']; 
    $user_password = $row['user_password'];    
    $user_role = $row['user_role']; 
    $user_image = $row['user_image'];    
    $user_email = $row['user_email'];
    $user_date = date('d-m-y');
    
    
        
    }
if(isset($_POST['update_user'])){
    $user_firstname = $_POST['first_name'];
    $user_lastname = $_POST['last_name'];
    $username= $_POST['username'];
    $user_password= $_POST['user_password'];
    $user_role= $_POST['user_role'];
    
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    
    $user_email = $_POST['user_email'];
    
    move_uploaded_file($user_image_temp, "../images/$user_image");
    
    if(empty($user_image)){
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_image = mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($select_image)){
            $user_image = $row['user_image'];
        }
    }
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
        if(!$select_randsalt_query){
            die("Query Failed" . mysqli_error($connection));
        }
    
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);
    
    $query = "UPDATE users SET ";
    $query.="username = '{$username}', ";
    $query.="user_password = '{$hashed_password}', ";
    $query.="user_firstname = '{$user_firstname}', ";
    $query.="user_lastname = '{$user_lastname}', ";
    $query.="user_email = '{$user_email}', ";
    $query.="user_image = '{$user_image}', ";
    $query.="user_role = '{$user_role}', ";
    $query.="user_date = '{$user_date}' ";

    $query.="WHERE user_id  = '{$the_user_id}' ";
    
   $update_user= mysqli_query($connection, $query);
    confirm($update_user);
    echo "<h2 class = 'bg-success'> User Has Been updated! </h2>";
    
    }
?>  

  

  <form action ="" method ="post" enctype="multipart/form-data">
   
   
   <div class = "form-group">
       <label for = "title">First name</label>
       <input type = "text" value="<?php echo $user_firstname; ?>" class="form-control" name = "first_name">
   </div>
   
   <div class="form-group">
       <label for ="user_status">Last Name</label>
        <input type = "text" value="<?php echo $user_lastname; ?>"  class="form-control" name = "last_name">
       
   </div>
   
   <div>
       <label for="user_tags">Username</label>
       <input type="text" value="<?php echo $username; ?>"  class ="form-control" name ="username">
   </div>
   
   <div>
       <label for="user_tags">Password</label>
       <input type="password" value="<?php echo $user_password; ?>"  class ="form-control" name ="user_password">
   </div>
   
  
       
   <div class="form-group">
   <label for="user_tags">User Role</label>
   <select class="form-control" name = "user_role" id="">
       <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
       <option value='admin'>Admin</option>
       <option value='subscriber'>Subscriber</option>
   </select>
       
   </div>
  
   
   
   <div class = "form-group">
      <label for ="user_image">User Image</label>
       <input type="file" name="image">
   </div>
   
   
   <div>
       <label for="user_content">User Email</label>
       <input type="text" value="<?php echo $user_email; ?>"  class ="form-control" name ="user_email">
       <br></br>
   </div>
   
   <div class ="form-group">
      <input class="btn btn-primary" type="submit" name="update_user" value="Update User"
       
   </div>
    
    
</form>
    