<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    
    session_start();

    function data($key)
    {
        if (isset($_SESSION['edit_user'])) {
            $result = $_SESSION['edit_user'];
            // $id = $result['id'];
            // $name = $result['name'];
            // $email = $result['email'];
            // $address = $result['address'];
            $data = $result[$key];
            return $data;
        } else {
            return '';
        }
    }

    ?>
    <div class="container mt-5">
        <form action="create_user.php" method="POST" id="myForm">
            <?php
                if (isset($_SESSION['edit_user'])){
                    echo "<input type='hidden' name='id' value=".$_SESSION['edit_user']['id'].">";
                }

            ?>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo data('name') ?>" required>
            <div id="name-error" class="mt-1 mb-2 text-danger"></div>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo data('email') ?>" required>
            <div id="email-error" class="mt-1 mb-2 text-danger"></div>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo data('address') ?>" required>
            <div id="address-error" class="mt-1 mb-2 text-danger"></div>


            <?php if (!isset($_SESSION['edit_user'])){?>
                    
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <div id="password-error" class="mt-1 mb-2 text-danger"></div>

                <label for="confrim-password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm-password" required>
                <div id="confirm-error" class="mt-1 mb-2 text-danger"></div>

            <?php }?>


            <div class="form-check form-switch">
                <input class="form-check-input" name="status" type="checkbox" id="checkbox" <?php echo (data('status') == 1) ? 'checked' : '';?>>
                
                <label class="form-check-label" for="checkbox">Agree to all the terms</label>
                <div id="checkbox-error" class="mt-1 mb-2 text-danger"></div>
            </div>

            <button type="button" id="submit">submit</button>
            <button type="submit" id="hidden-submit" style="display:none;">submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
        $(document).on('click', '#submit', function() {

            let name = $('#name').val();
            let email = $('#email').val();
            let address = $('#address').val();
            let password = $('#password').val();
            let confirm_password = $('#confirm-password').val();
            let check = $('#checkbox').is(':checked');


            let has_value = true;

            if ($.trim(name) == '') {

                $('#name-error').text('Name Cannot Be Empty');
                has_value = false;
            } else if ($.isNumeric(name)) {

                $('#name-error').text('Name cannot be numeric')
                has_value = false;
            }

            if ($.trim(email) == '') {

                $('#email-error').text('Email Cannot Be Empty');
                has_value = false;
            }

            if ($.trim(address) == '') {

                $('#address-error').text('Address Cannot Be Empty');
                has_value = false;
            }

            <?php if(!isset($_SESSION['edit_user'])){?>

                if (password == '') {

                    $('#password-error').text('Password Cannot be empty');
                    has_value = false;
                }

                if (confirm_password == '') {

                    $('#confirm-error').text('Confirm password cannot be empty');
                    has_value = false;
                }

                if (password !== confirm_password) {

                    $('#confrim-error').text('Both the password doesnt match');
                    has_value = false;
                }
            <?php }?>

            if (!check) {

                $('#checkbox-error').text('Agree to all the terms')
                has_value = false;

            }

            if (has_value) {
                //$('#myForm').off('submit').submit();
                $('#hidden-submit').click();
            } else {
                alert("Check the error and fill the form properly...");
            }
        });
    </script>
</body>

</html>