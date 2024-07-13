<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Application Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- <h1>Internship Application Form</h1> -->  

    <!-- Begin PHP code to insert data into the database -->
    <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $college = $_POST["college"];
            $course = $_POST["course"];
            $internship = $_POST["internship"];

            $errors = array();
            
            if (empty($fullName) || empty($email) || empty($contact) || empty($college) || empty($course) || empty($internship)) {
            array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email format");
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
            array_push($errors, "Only letters and white space allowed");
            }
            if (!preg_match("/^[0-9]*$/",$contact)) {
            array_push($errors, "Only numbers allowed");
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$college)) {
            array_push($errors, "Only letters and white space allowed");
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$course)) {
            array_push($errors, "Only letters and white space allowed");
            }
            if ($internship == "Select an option") {
            array_push($errors, "Please select an internship opportunity");
            }

            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }else{
            require_once "database.php";
            $sql = "INSERT INTO users (full_name, email, contact, college, course, internship) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $fullName, $email, $contact, $college, $course, $internship);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Application submitted successfully!</div>";
            }else{
                die("Something went wrong");
            }
            }
            }
        ?>
    <!-- End PHP code to insert data into the database -->
        
    <!-- Begin HTML form -->
    <form action="Application.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="fullname" placeholder="Full Name:" required> 

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="@gmail.com" required>

        <label for="contact">Contact Number:</label>
        <input type="tel" id="contact" name="contact" placeholder="123-456-7890" required>

        <label for="college">College Name:</label>
        <input type="text" id="college" name="college" placeholder="Enter your college name" required>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" placeholder="Enter your course" required>

        <label for="internship">Select Internship Opportunity:</label>
        <select id="internship" name="internship" required>
            <option value="" disabled selected>Select an option</option>
            <option value="graphic-designer">Graphic Designer</option>
            <option value="video-editor">Video Editor</option>
            <option value="content-writer">Content Writer</option>
            <option value="anchoring">Anchoring</option>
            <option value="human-resources">Human Resources</option>
            <option value="marketing">Marketing</option>
            <option value="medical-volunteer">Medical Volunteer</option>
            <option value="public-relations">Public Relations</option>
            <option value="campus-ambassador">Campus Ambassador</option>
            <option value="csr">Corporate Social Responsibility (CSR)</option>
            <option value="project-manager">Project Manager</option>
            <option value="finance-manager">Finance Manager</option>
            <option value="project-coordinator">Project Coordinator</option>
            <option value="ui-ux-designer">UI/UX Designer</option>
        </select>

        <button type="submit" name="submit">Apply</button>
    </form>
    <!-- End HTML form -->
    
</body>
</html>