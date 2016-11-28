<?php include "includes/admin_header.php" ?>
<?php
   if(isset($_SESSION['username'])){
       $username = $_SESSION['username'];
       
       $query = "SELECT * FROM users WHERE username = '{$username}'";
       
       $select_user_profile_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_array($select_user_profile_query)){
                $user_firstname = $row['user_firstname'];    
                $user_lastname = $row['user_lastname'];    
                $username = $row['username']; 
                $user_password = $row['user_password'];    
                $user_role = $row['user_role']; 
                $user_image = $row['user_image'];    
                $user_email = $row['user_email'];
        }
        if(isset($_POST['update_profile'])){
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
                $query = "SELECT * FROM users WHERE username = '{$username}' ";
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
            $query.="user_role = '{$user_role}' ";
            

            $query.="WHERE username  = '{$username}' ";

           $update_user= mysqli_query($connection, $query);
            confirm($update_user);
           
    
    }
       
   }
?>       
    <div id="wrapper">
        
<?php include "includes/admin_navigation.php"?>   
        
        
        
        <div id="page-wrapper">
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                     <?php 
                        if(isset($_POST['update_profile'])){
                                echo "<h2 class = 'bg-success'> User Has Been updated! </h2>";
                            }
                        ?>
                    <h1 class="page-header">
                           
                       
                               
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
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
                               <input type="text" value="<?php echo $user_email; ?>"  class ="form-control" name ="user_email">
                               <br></br>
                           </div>

                           <div class ="form-group">
                              <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile"

                           </div>


                        </form>
    
                        
                       
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            
            
            
            
            

        </div>
        <!-- /#page-wrapper -->

   <?php include"includes/admin_footer.php"?>