<?php 
if(isset($_POST['create_user'])){
    $user_firstname = $_POST['first_name'];
    $user_lastname = $_POST['last_name'];
    $username= $_POST['username'];
    $user_password= $_POST['user_password'];
    $user_role= $_POST['user_role'];
    
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    
    $user_email = $_POST['user_email'];

    $user_date = date('d-m-y');
    
     $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
        if(!$select_randsalt_query){
            die("Query Failed" . mysqli_error($connection));
        }
    
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($user_password, $salt);
    
    
    move_uploaded_file($user_image_temp, "../images/$user_image");
    
    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_date)";
    
    $query.="VALUES('{$username}','{$hashed_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}','{$user_role}',now())";
    
    $create_user_query = mysqli_query($connection, $query);
    
    confirm($create_user_query);
    
    echo "<h2 class='bg-success'>User Created: " . " " . "<a href='users.php'> View Users </a> </h2>";
    
}

?>  

  <form action ="" method ="post" enctype="multipart/form-data">
   
   
   <div class = "form-group">
       <label for = "title">First name</label>
       <input type = "text" class="form-control" name = "first_name">
   </div>
   
   <div class="form-group">
       <label for ="user_status">Last Name</label>
        <input type = "text" class="form-control" name = "last_name">
       
   </div>
   
   <div>
       <label for="user_tags">Username</label>
       <input type="text" class ="form-control" name ="username">
   </div>
   
   <div>
       <label for="user_tags">Password</label>
       <input type="text" class ="form-control" name ="user_password">
   </div>
   
  
       
   <div class="form-group">
   <label for="user_tags">User Role</label>
   <select class="form-control" name = "user_role" id="">
       <option value='subscriber'>Select Options</option>
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
       <input type="text" class ="form-control" name ="user_email">
       <br></br>
   </div>
   
   <div class ="form-group">
      <input class="btn btn-primary" type="submit" name="create_user" value="Create User"
       
   </div>
    
    
</form>