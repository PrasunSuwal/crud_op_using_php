<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <?php
      session_start();
      if(isset($_SESSION['edit_user'])){
        unset($_SESSION['edit_user']);
      }
      
      if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
          <?php echo $_SESSION['success']; ?>
          <button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="float:right;background:none;border:none;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php unset($_SESSION['success']);
    }?>
    <table class="table table-bordered table-striped table-dark">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once 'user.php';
        include_once 'db.php';

        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $stmt = $user->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            //var_dump($row);
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $email . "</td>";
            echo "<td>" . $address . "</td>";
            echo "<td style='display: flex;'>";
            echo "<a href='create_user.php?id=" . $id . "' class='btn btn-primary me-2'> Edit</a>";
            echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModal".$id."'>Delete</button>";
            echo "</td>";
            echo "</tr>";
            include 'modal.php';
            
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="button">
      <a class="nav-link" href="form.php">Create User</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  <script>
    $(document).on('click', '#close', function(){
      $('#alert').hide();
    })
  </script>
</body>

</html>