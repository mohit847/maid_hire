<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$errors = array();
if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $errors['name'] = "Name cannot be empty";
    }

    // Validate contact number
    if (empty($_POST['contno'])) {
        $errors['contno'] = "Contact number cannot be empty.";
    } elseif (!preg_match("/^[0-9]{10}$/", $_POST['contno'])) {
        $errors['contno'] = "Invalid contact number. It should be exactly 10 digits.";
    }

    // Validate email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address";
    }

    // Validate address
    if (empty($_POST['address'])) {
        $errors['address'] = "Address cannot be empty";
    }

    // Validate gender
    if (empty($_POST['gender'])) {
        $errors['gender'] = "Please select gender";
    }

    // Validate service category
    if (empty($_POST['catid'])) {
        $errors['catid'] = "Please select service category";
    }

    // Validate work shift from and to
    if (empty($_POST['wsf']) || empty($_POST['wst'])) {
        $errors['workShift'] = "Work shift timings cannot be empty";
    }

    // Validate start date
    if (empty($_POST['startdate'])) {
        $errors['startDate'] = "Start date cannot be empty";
    }

    // Validate notes
    if (empty($_POST['notes'])) {
        $errors['notes'] = "Requirements cannot be empty";
    }

    // Check if there are any errors
    if (!empty($errors)) {
        // Display the first error message below the input fields
        // echo '<div class="alert alert-danger">' . current($errors) . '</div>';
    } else {
        // Proceed with other validation and database insertion logic

        $catid = $_POST['catid'];
        $name = $_POST['name'];
        $contno = $_POST['contno'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $wsf = $_POST['wsf'];
        $wst = $_POST['wst'];
        $startdate = $_POST['startdate'];
        $notes = $_POST['notes'];
        $bookingid = mt_rand(100000000, 999999999);
        $sql = "insert into tblmaidbooking(BookingID,CatID,Name,ContactNumber,Email,Address,Gender,WorkingShiftFrom,WorkingShiftTo,StartDate,Notes)values(:bookingid,:catid,:name,:contno,:email,:address,:gender,:wsf,:wst,:startdate,:notes)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
        $query->bindParam(':catid', $catid, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':contno', $contno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':wsf', $wsf, PDO::PARAM_STR);
        $query->bindParam(':wst', $wst, PDO::PARAM_STR);
        $query->bindParam(':startdate', $startdate, PDO::PARAM_STR);
        $query->bindParam(':notes', $notes, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();

    }




}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>

    <title>Maid Hiring Management System || Hiring Form</title>


    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center"
            data-background="assets/img/hero/about.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Hiring Form</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- ================ contact section start ================= -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title" style="text-align: center;color: blue;">Looking To Hire A Maid?</h2>
                    <p class="contact-title" style="text-left: center;color: green;">Post Requirement Here ></p>
                </div>
                <div class="col-lg-8" style="padding-top=20px">
                    <?php if (isset($_POST['submit']) && !empty($errors)): ?>
                        <div class="custom-error-messages">
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error): ?>
                                    <?php echo '*' .$error . '<br>'; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($LastInsertId > 0): ?>
                        <div class="custom-success-messages">
                            <div style="background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px;">
                                Your Booking Request Has Been Sent. We Will Contact You Soon
                            </div>
                        </div>
                    <?php endif; ?>


                    <form class="form-contact contact_form" action="" method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Name:</label>
                                    <input class="form-control" name="name" id="name" type="text"
                                        placeholder="Enter your name">


                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Contact Number:</label>
                                    <input type="text" name="contno" value="" class="form-control" maxlength="10"
                                        pattern="[0-9]+">

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Address(to be
                                        hired):</label>
                                    <textarea class="form-control" name="address" id="address"
                                        placeholder="Enter Your Addresss"></textarea>

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label
                                        style="color: red; font-weight: bold; font-size: 20px; padding-left: 20px;">Gender:</label>
                                    <select name="gender" class="form-control">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Email:</label>
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Email">

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label
                                        style="color: red; font-weight: bold; font-size: 20px; padding-left: 20px;">Select
                                        Service:</label>
                                    <select name="catid" class="form-control">
                                        <option value="" disabled selected>Select Service</option>
                                        <?php
                                        $sql2 = "SELECT * from tblcategory ";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result2 as $row2) {
                                            ?>
                                            <option value="<?php echo htmlentities($row2->ID); ?>">
                                                <?php echo htmlentities($row2->CategoryName); ?>
                                            </option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>


                            <div class="col-sm-12" style="padding-top: 20px;">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Work Shift
                                        From:</label>
                                    <input class="form-control" name="wsf" id="wsf" type="time">

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Work Shift To:</label>
                                    <input class="form-control" name="wst" id="wst" type="time">


                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Start Date:</label>
                                    <input class="form-control" name="startdate" id="startdate" type="date">


                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label style="color: red;font-weight: bold;font-size: 20px;">Enter Your Requirements
                                        :</label>
                                    <textarea class="form-control" name="notes" id="notes" type="text"
                                        placeholder="Enter Your Requirement"></textarea>


                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn"
                                name="submit">Send</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
    <?php include_once('includes/footer.php'); ?>
    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
    <!-- Add this script within the <head> section of your HTML -->



</body>

</html>



