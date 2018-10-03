<?php include("includes/init.php"); ?>

<?php 
    if (!$session->is_signed_in()) {
        redirect('login.php');
    }
?>
<?php

if (empty($_GET['id'])) {
    
    redirect('photos.php');
}

$photo = Photo::find_by_id($_GET['id']);

if ($photo) {
    
    $photo->delete_photo();
    redirect('photos.php');
    $session->message("The photo: {$photo->filename} has been deleted");
}else{

    redirect('photos.php');
}

?>