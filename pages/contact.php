<?php
include('../helpers/variables.php');
include('../helpers/session_messages.php');

// Handle errors by type
$contactErrors = isset($_SESSION['contactErrors']) ? $_SESSION['contactErrors'] : [];
$contact_firstName_error = count($contactErrors) > 0 && isset($contactErrors['firstname']) ? $contactErrors['firstname'] : "";
$contact_lastName_error = count($contactErrors) > 0 && isset($contactErrors['lastname']) ? $contactErrors['lastname'] : "";
$contact_email_error = count($contactErrors) > 0 && isset($contactErrors['emailcontact']) ? $contactErrors['emailcontact'] : "";
$contact_message_error = count($contactErrors) > 0 && isset($contactErrors['messagecontact']) ? $contactErrors['messagecontact'] : "";

// Get the input values in order to reinsert them in the form
$firstnameValue = isset($_SESSION['contact']['firstnamecontact']) ? $_SESSION['contact']['firstnamecontact'] : '';
$lastnameValue = isset($_SESSION['contact']['lastnamecontact']) ? $_SESSION['contact']['lastnamecontact'] : '';
$emailValue = isset($_SESSION['contact']['emailcontact']) ? $_SESSION['contact']['emailcontact'] : '';
$messageValue = isset($_SESSION['contact']['message']) ? $_SESSION['contact']['message'] : '';
?>

<!-- HTML content -->
<?php include('../layouts/master.php'); ?>
<?php include('../layouts/header.php'); ?>

<section id="contact" class="container d-flex flex-column justify-content-center p-5">
    <div class="col-lg-5 col-sm-8 mx-auto text-center mb-4">
        <h2 class="mb-3 text-info">Contact us</h2>
        <hr class="bg-info">
    </div>

    <div class="col-8 mx-auto">
        <form action="../controllers/contactUser.php" method="POST" id="contactForm">
            <div class="form-group">
                <label for="firstnamecontact">First name</label>
                <input type="text" name="firstnamecontact" class="form-control" value="<?php echo $firstnameValue; ?>" >
                <small class="text-danger"><?php echo $contact_firstName_error ; ?></small>
            </div>

            <div class="form-group">
                <label for="lastnamecontact">Last name</label>
                <input type="text" name="lastnamecontact" class="form-control" value="<?php echo $lastnameValue; ?>" >
                <small class="text-danger"><?php echo $contact_lastName_error; ?></small>
            </div>

            <div class="form-group">
                <label for="emailcontact">Email address</label>
                <input type="email" name="emailcontact" class="form-control" value="<?php echo $emailValue; ?>" >
                <small class="text-danger"><?php echo $contact_email_error; ?></small>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Message</span>
                </div>

                <textarea class="form-control" name="messagecontact" aria-label="With textarea"><?php echo $messageValue; ?></textarea>
                <small class="text-danger col-12"><?php echo $contact_message_error; ?></small>
            </div>

            <div class="form-group text-right p-2">
                <button type="submit" name='buttonContact' class="btn btn-info ">Send</button>
            </div>
        </form>
    </div>
</section>

<?php include('../layouts/footer.php'); ?>
<!-- end HTML content -->

<script type="text/javascript">
    var signout_success = "<?php echo $signout_success; ?>";
    var success_message = "<?php echo $success_message; ?>";
   
    function resetForm(formId) {
        // console.log(formId);
        $("#"+formId+" input[type=text], #"+formId+" textarea").val("");
    }
    
    if (success_message != '') {
        toastr.info(success_message);
        resetForm('contactForm');
    }

    if (signout_success != '') {
        toastr.info(signout_success);
        resetForm('contactForm');
    }
</script>