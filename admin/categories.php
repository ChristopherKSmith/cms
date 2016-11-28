<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
        
<?php include "includes/admin_navigation.php"?>   
        
        
        
        <div id="page-wrapper">
           <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Subheading</small>
                        </h1>
                        
                       <div class = "col-xs-6">
                          
                          
                          <?php insert_categories() ?>
                          
                          
                          
                          <!--   Category Title-->
                           <form action = "" method = "post">
                            
                           
                                <div class = "form-group">
                                    <label for = "cat_title">Category Title</label>
                                    <input type="text" class = "form-control" name="cat_title">

                                </div>
                                <div class = "form-group">
                                    <input class = "btn btn-primary" type="submit" name="submit" value="Add Category">

                                </div>
                                 
                           </form>
                           
                           
<!--                     INCLUDE EDIT FORM                       -->
                          
                          <?php
                           if(isset($_GET['edit'])){
                               $cat_id = $_GET['edit'];
                               include "includes/update_categories.php";
                           }
                           ?>
                       
                       </div>  <!--Add Category Form -->
                        <div class = "col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <?php //FIND ALL CATEGORIES
                                            findAllCategories();
                                        ?>
                                        
                                        <?php //DELETE CATEGORIES ADMIN
                                           delete_categories();
                                        ?>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            
            
            
            
            

        </div>
        <!-- /#page-wrapper -->

   <?php include"includes/admin_footer.php"?>
