<table class ="table table-bordered table-hover">
    <thead>
        <tr>
            <th>User Id</th>
            <th>User Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th>Delete</th>
            <th>Edit</th>
            
            
        </tr>
    </thead>


    <tbody>

<?php
$query = "SELECT * FROM users";
$select_users = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_users) ){

    $user_id = $row['user_id']; 
    $user_image = $row['user_image'];     
    $username = $row['username'];    
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];    
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];    
    $user_date = $row['user_date']; 

        echo "<tr>";
             echo "<td>{$user_id}</td>";
             echo "<td><img width='100' src='../images/{$user_image}'></td>";
             echo "<td>{$username}</td>";
             echo "<td>{$user_firstname}</td>";
             echo "<td>{$user_lastname}</td>";
             echo "<td>{$user_email}</td>";
        
                 

//                $query = "SELECT * FROM posts WHERE post_id = {$user_post_id}";
//                $select_post_id_query = mysqli_query($connection,$query);
//                    while($row = mysqli_fetch_assoc($select_post_id_query) ){
//
//                     $post_id = $row['post_id'];    
//                     $post_title = $row['post_title'];
//                        
//                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//        
//        
//                    }
            
             echo "<td>{$user_role}</td>";
             echo "<td>{$user_date}</td>";   
             echo "<td><a href ='users.php?delete={$user_id}'>Delete</a></td>";
             echo "<td><a href ='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
        
        echo "</tr>";

    }
?>
            

    </tbody>
</table>


<?php

if(isset($_GET['delete'])){
    $the_user_id = $_GET['delete'];
    
    $query = "DELETE FROM users WHERE user_id =  $the_user_id ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
    
}
?>