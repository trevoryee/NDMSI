<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register Account</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="register.css">
</head>
<body>
<h1> Please enter the following information to Register</h1>
<h2> <a href="./Launch_Page.html">Go back</a></h2>
<p>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect DB
		
	$errors = array(); // Error array
	
	// Check for first name
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	}
	
	// Check for last name
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	}
	
	// Check for email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Confirm passwords match
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

    // Check for QA
    if (empty($_POST['answer'])) {
		$errors[] = 'You forgot to select an answer.';
	} else {
		$answer = mysqli_real_escape_string($dbc, trim($_POST['answer']));
	}
	
	if (empty($errors)) { // If no errors
	
		//Register
		
		// Query
		$a = "INSERT INTO users (first_name, last_name, email, pass, registration_date, answer) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), NOW() ),$answer";		
		$b = @mysqli_query ($dbc, $a); // Execute
		if ($b) { // If run is successful

			echo '<h1>Submitted</h1>';	
		
		} else { // If run unsuccessful
			
			// HTML message
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debug message
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $a . '</p>';
						
		}
		
		mysqli_close($dbc);
		exit();
		
	} else { // Error reporting
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print errors
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	}
	
	mysqli_close($dbc);
}
?>

<form action="register.php" method="post">
<div class="row">
    <div class="column">
        <label for="fname">First name</label><br>
        <input type="text" id="fname" name="fname" required><?php if (isset($_POST['fname'])) echo $_POST['fname']; ?> <br><br>
        <label for="lname">Last name</label><br>
        <input type="text" id="lname" name="lname" required><?php if (isset($_POST['lname'])) echo $_POST['lname']; ?> <br><br>
        <label for="email">University Email</label><br>
        <input type="email" id="email" name="email" required><?php if (isset($_POST['email'])) echo $_POST['email']; ?>
        <br><br><br>
        <label for="fullname">Full Name including degrees/designations<br>to be listed on
        web-site and directory.<br> (e.g. John Smith, PhD, MD) </label><br><br>
        <input type="text" id="fullname" name="fullname" size="50" required><br><br><?php if (isset($_POST['fullname'])) echo $_POST['fullname']; ?>
        <label for="password">Password</label><br>
        <input type="text" id="pass1" name="pass1" required><br><br><?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>
        <label for="pass2">Re-Enter Password</label><br>
        <input type="text" id="pass2" name="pass2" required><br><br><?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>
    </div>
    
    <div class="column">
        <label for="register_status">What is your status at the Marquette or UW-Milwaukee?
            (Adjunct and Visiting Faculty with at least two full years at
            the university are eligible.)
        </label><br><br>
        <input type='radio' id='statusQA1' name="answer" value="FT"> 
            <label for="statusQA1"> Full-Time Faculty</label> <br><br>
        <input type='radio' id='statusQA2' name="answer" value="Visiting+2">
            <label for="statusQA2"> Visiting faculty (with two+ complete
                years at MU or UWM) </label><br><br> 
        <input type='radio' id='statusQA3' name="answer" value="Adjunct+2"> 
            <label for="statusQA3"> Adjunct faculty (with two+ complete
                years at MU or UWM) </label><br><br> 
        <input type='radio' id='statusQA4' name="answer" value="Visiting-2">
            <label for="statusQA4"> Visiting faculty (with less than two
                complete years at MU or UWM)</label> <br><br>
        <input type='radio' id='statusQA5' name="answer" value="Adjunct-2">
            <label for="statusQA5"> Adjunct faculty (with less than two
                complete years at MU or UWM)</label><br><br>
        <input type='radio' id='statusQA6' name="answer" value="other"> 
            <label for="statusQA6"> Faculty at other university</label><br><br>
        <input type='radio' id='statusQA7' name="answer" value="non-faculty"> 
            <label for="statusQA7"> Non-faculty / Industry representative</label><br><br>
    </div>
    <div class="submit_button">
        <button type='submit' name='submit'>Submit</button>
    </div>
    
</form>
</p>
</body>

