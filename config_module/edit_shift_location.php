<?php
include("../database_config.php");

   $edit_name = $_POST['edit_name'];

    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update cam_shift set shift_name='$_POST[edit_name]',updated_at='$chicagotime' where shift_id='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Shift/Location Updated Sucessfully.';
        } else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Error: Shift/Location with this Name Already Exists';
        }
    }

header("Location:shift_location.php");
?>
