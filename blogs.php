
<?php
$blog_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
}
?>

<!---MODALS-->

<!---Add-->
<?php if(isset($_GET['add'])) { ?>
        <script>
            $( document ).ready(function() {
                $('#add-success').modal('show');
                 $('#add-success').modal('show');
            setTimeout(function() {
                $('#add-success').modal('hide');
            }, 1500); // 1.5 seconds delay  
            });
        </script>
    <?php } ?>
    <div id="add-success" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="text-primary m-0">Post Added Successfully!</h5>
                </div>
            </div>
        </div>
    </div>


<!---DELETE-->
<?php if(isset($_GET['delete'])) { ?>
        <script>
            $( document ).ready(function() {
                $('#delete-success').modal('show');
                 $('#delete-success').modal('show');
            setTimeout(function() {
                $('#delete-success').modal('hide');
            }, 1500); // 1.5 seconds delay  
            });
        </script>
    <?php } ?>
    <div id="delete-success" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4 class="text-danger m-0">Successfully Deleted!</h4>
                </div>
            </div>
        </div>
    </div>

<!---Update-->
<?php if(isset($_GET['update'])) { ?>
        <script>
            $( document ).ready(function() {
                $('#update-success').modal('show');
                 $('#update-success').modal('show');
            setTimeout(function() {
                $('#update-success').modal('hide');
            }, 1500); // 1.5 seconds delay  
            });
        </script>
    <?php } ?>
    <div id="update-success" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4 class="text-primary m-0">Successfully Updated!</h4>
                </div>
            </div>
        </div>
    </div>
<?php

//Add
if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    //data preparation for insertion
    $insert = $conn->prepare("INSERT INTO blog_posting (post_title, post_content, u_id) VALUES(?,?,?)");
    //data binding
    $insert->execute([
        $title,
        $content,
        $_SESSION['user_id']
    ]);

    header("location: blogs.php?add=successful");

}

//update
if (isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $update = $conn->prepare("UPDATE blog_posting SET post_title = ?, post_content = ? WHERE post_id = ?");
    //bind/execute the data since we use the prepare() function
    $update->execute([
        $title,
        $content,
        $id
    ]);
    header("location: blogs.php?update=successful");
}

//delete post
if (isset($_GET['delete'])) {
    $id = $_GET['id']; //get the id from the GET request variable

    //execute the delete command
    $delete = $conn->prepare("DELETE FROM blog_posting WHERE post_id = ?");
    //bind the variable id
    $delete->execute([$id]);
}

?>
<body style="background-color:lightgray;">

<div class="row">
    <div class="col-4 mx-3 shadow-lg mt-2">
        <form method="POST" action="blogs.php" class="row p-3 mt-1" novalidate style="background-color:  #a2b9bc;" >
            <h4 class="mb-3">New Post</h4>
            <div class="col-12 mb-3">
                <label for="validationCustom01" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="validationCustom01" placeholder="Enter your Title" required>
            </div>
            <div class="col-12">
                <label for="basic-url" class="form-label">Content</label>
                <div class="input-group">
                    <textarea type="text" name="content" class="form-control" aria-describedby="basic-addon3 basic-addon4" required></textarea>
                </div>
            </div>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary" name="create_post">Create Post</button>
            </div>
        </form>
    </div>

    <div class="col mx-2 shadow p-3 mt-2"style="background-color:  #a2b9bc;">
        <h4 class="mb-3">Blog Posts</h4>
        <table id="posts_table" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                $id = $_SESSION['user_id']; //get the session id to make it unique only for the user who is logged in
                $rows = $conn->prepare("SELECT * FROM blog_posting WHERE u_id = ?");
                $rows->execute([$id]);
                foreach ($rows as $data) {
                  $post_id = $data['post_id'];
                 ?>

                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?= $data['post_title']; ?></td>
                        <td><?php echo truncateWords($data['post_content'], 10); ?></td>
                        <td>
                            <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-post<?php echo $post_id;?>">✏</a>
                            <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#delete-post<?php echo $post_id;?>">❌</a>
                        </td>
                    </tr>

                    <!--MODALS-->

                    <!--Delete Post MODAL-->
                    <div id="delete-post<?php echo $post_id; ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Post</h4>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <h7>Do you want to delete this post?</h7>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-light border my-0" data-bs-dismiss="modal">Cancel</button>
                                    <a class="btn btn-danger my-0" href="?delete&id=<?= $data['post_id']; ?>">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Edit Post MODAL-->
                    <div id="edit-post<?php echo $post_id; ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Post</h4>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="blogs.php" novalidate>
                                <div class="modal-body">
                                    <?php
                                        $select = $conn->prepare("SELECT * FROM blog_posting WHERE post_id = ?");
                                        $select->execute([$post_id]);

                                        foreach ($select as $edit) { ?>
                                        
                                            <input type="hidden" name="id" value="<?= $edit['post_id']; ?>">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title" class="form-control" id="validationCustom01" placeholder="Enter your Title" value="<?= $edit['post_title']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Content</label>
                                                <textarea type="text" name="content" class="form-control" aria-describedby="basic-addon3 basic-addon4"><?= $edit['post_content']; ?></textarea>
                                            </div>

                                        
                                        <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-light border my-0" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary my-0" name="update_post">Update</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php   } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
function truncateWords($text, $limit) {
    $words = explode(' ', $text);
    $truncated = implode(' ', array_slice($words, 0, $limit));
    if (count($words) > $limit) {
        $truncated .= '...';
    }
    return $truncated;
}
?>

<script type="text/javascript">
    //Removes get methods when page is reloaded
    if (performance.navigation.type === 1) {
  // The page was reloaded
  window.location.href = 'blogs.php';
}
</script>

 <!--Tnitialise the Datatable-->
<script type="text/javascript">
    $(document).ready(function () {
        $('#posts_table').DataTable();
    });
</script>
<script src="assets/datatables/js/datatables.min.js"></script>
</body>

</html>