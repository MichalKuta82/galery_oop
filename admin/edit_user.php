<?php include("includes/header.php"); ?>
<?php include("includes/photo-library-modal.php"); ?>
<?php 
    if (!$session->is_signed_in()) {
        redirect('login.php');
    }
?>
<?php 

if (empty($_GET['id'])) {
    
    redirect('users.php');
}

$user = User::find_by_id($_GET['id']);

if (isset($_POST['update'])) {

    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $user->password_encrypt($_POST['password']);

        if (empty($_FILES['user_image'])) {
            
            $user->save();
            redirect('users.php');
            $session->message("The user: {$user->username} has been updated");
        }else{

            if (isset($_FILES['user_image'])) {
                $user->set_file($_FILES['user_image']);
                $user->upload_photo();
                $user->save();
                //redirect('edit_user?id=' . $user->id);
                redirect('users.php');
                $session->message("The user: {$user->username} has been updated");
            }
        }   
    }
}


?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->


            <?php include("includes/top_nav.php"); ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            

            <?php include("includes/side_nav.php"); ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            EDIT USER
                        </h1>

                        <div class="col-md-6 user_image_box">
                            <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-fluid img-thumbnail" src="<?php echo $user->image_path_and_placeholder(); ?>"></a>
                        </div>
                        
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="user_image">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $user->username;?>">
                                </div>
                                <div class="form-group">
                                    <label for="first name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name;?>">
                                </div>
                                <div class="form-group">
                                    <label for="last name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name;?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $user->password;?>">
                                </div>
                                <div class="form-group">
                                    <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                    <input type="submit" name="update" class="btn btn-primary float-right" value="Update">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>