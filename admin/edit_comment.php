<?php include("includes/header.php"); ?>
<?php 
    if (!$session->is_signed_in()) {
        redirect('login.php');
    }
?>
<?php 

if (empty($_GET['id'])) {
    
    redirect('comments.php');
}

$comment = Comment::find_by_id($_GET['id']);

if (isset($_POST['update'])) {

    if ($comment) {
        $comment->author = $_POST['author'];
        $comment->body = $_POST['body'];
            
        $comment->update(); 

        redirect('comments.php');
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
                            EDIT COMMENT
                        </h1>
                        
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" name="author" class="form-control" value="<?php echo $comment->author;?>">
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" class="form-control"><?php echo $comment->body;?></textarea>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-danger" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                    <input type="submit" name="update" class="btn btn-primary float-right">
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