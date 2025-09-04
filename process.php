<?php
// Club Registration Form Processing
// TODO: Add your PHP processing code here starting in Step 3


$name ="";
$email ="";
$club ="";

$DataFile = __DIR__ . '/data/registrations.txt';
if (file_exists($DataFile)){
    $regist=json_decode(file_get_contents($DataFile));
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $club = trim($_POST["club"]);

  if ($name === ''){
    $error[] = "Name is required.";

  if ($email === ''){
    $error[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = "Invalid email format.";
  }

  if ($club === ''){
    $error[] = "Club selection is required.";
  }
}
if (empty($error)){
  $regist = [
    "name" => $name,
    "email" => $email,
    "club" => $club
  ];
  file_put_contents($DataFile, json_encode($regist));

  echo "<h2>Registration Successful</h2>";
echo "<p>Name: " . htmlspecialchars($name) . "</p>";
echo "<p>Email: " . htmlspecialchars($email) . "</p>";
echo "<p>Club: " . htmlspecialchars($club) . "</p>";


} else {
  echo "<h2>Errors:</h2><ul>";
  foreach ($error as $err) {
    echo "<li>" . htmlspecialchars($err) . "</li>";
  }
  echo "</ul>";
}

if (!empty($regist)) {
  echo "<h2>All Registrations:</h2><ul>";
  foreach ($regist as $entry) {
    echo "<li>" . htmlspecialchars($entry['name']) . " (" . htmlspecialchars($entry['email']) . ") - " . htmlspecialchars($entry['club']) . "</li>";
  }
  echo "</ul>";
}

 
/* 
Step 3 Requirements:
- Process form data using $_POST
- Display submitted information back to user
- Handle name, email, and club fields

Step 4 Requirements:
- Add validation for all fields
- Check for empty fields
- Validate email format
- Display appropriate error messages

Step 5 Requirements:
- Store registration data in arrays
- Display list of all registrations
- Use loops to process array data

Step 6 Requirements:
- Add enhanced features like:
  - File storage for persistence
  - Additional form fields
  - Better error handling
  - Search functionality
*/

?>
