<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 4: fortolkning av CSV-fil";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";

    $host = "db";
    $port = 3306;
    $dbname = "bookingsystem";
    $username = "root";
    $password = "root";
    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

        // Set PDO to throw exceptions on errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            if (isset($_FILES["csv_file"])) {
                $file_name = $_FILES["csv_file"]["name"];
                $file_tmp = $_FILES["csv_file"]["tmp_name"];

                $csv_data = file_get_contents($file_tmp);
                $rows = explode("\n", $csv_data);

                foreach ($rows as $row) {
                    $user_data = str_getcsv($row);

                    // Must contain all values
                    if (count($user_data) >= 5) {
                        $username = $user_data[0];
                        $firstname = $user_data[1];
                        $lastname = $user_data[2];
                        $email = $user_data[3];
                        $role = $user_data[4];

                        // Create "random" password where its first letter of fist name and then lastname
                        $password = substr($firstname, 0, 1) . $lastname;
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);

                        $query = "INSERT INTO user (username, password_hash, firstname, lastname, email, role) VALUES (:username, :password_hash, :firstname, :lastname, :email, :role)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":username", $username);
                        $stmt->bindParam(":password_hash", $password_hash);
                        $stmt->bindParam(":firstname", $firstname);
                        $stmt->bindParam(":lastname", $lastname);
                        $stmt->bindParam(":email", $email);
                        $stmt->bindParam(":role", $role);
                        $stmt->execute();
                        echo "Data inserted successfully for username: $username<br>";
                    }
                }
            }
        }
    }

    echo "<h1>$task_name</h1>";
?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv">
        <input type="submit" name="submit" value="Upload">
    </form>

    <?php generate_footer(); ?>
<?php endif; ?>