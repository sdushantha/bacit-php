<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 3: tilgangskontroll og automatiske oppgaver";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])):

// index.php is included as we use the generate_footer() function from it
include "index.php";
?>

<?="<h1>$task_name</h1>"?>

<?php
class User {
    protected $firstname;
    protected $lastname;
    protected $username;
    protected $birthday;
    protected $reg_date;
    protected static $deleted_users = array();

    function __construct($firstname, $lastname, $birthday)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->randomUsername();
        $this->birthday = $birthday;
        $this->reg_date = date("Y-m-d");;
    }

    function __destruct()
    {
        // self vs $this
        // Use $this to refer to the current object. Use self to refer to the current class
        self::$deleted_users[] = $this->username;
    }
    protected function randomUsername() {
        // Take first letter of firstname. Append lastname. Append random nummber between 100 and 999.
        // The username format will be the following:
        //  Bob Smith -> bsmith836
        $this->username = strtolower(substr($this->firstname, 0, 1) . $this->lastname. rand(100, 999));
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRegDate() {
        return $this->reg_date;
    }

    public function getDeletedUsers() {
        return self::$deleted_users;
    }

}


class Student extends User{
    function __construct($firstname, $lastname, $birthday)
    {
        parent::__construct($firstname, $lastname, $birthday);
    }

    function getFirstname()
    {
       return "Firstname: "  . $this->firstname;
    }
}

$alice = new Student("Alice", "Smith", "11 Dec");
$bob = new Student("Bob", "Smith", "10 Jan");
echo $alice->getFirstname();
echo "<br>";
echo $alice->getLastname();
echo "<br>";
echo $alice->getRegDate();
echo "<br>";
echo "<br>";
echo $bob->getFirstname();
echo "<br>";
echo $bob->getLastname();
echo "<br>";
echo $bob->getRegDate();


$alice->__destruct();
$bob->__destruct();

echo "<br><br>";
echo "deleted user: ";
print_r($alice->getDeletedUsers());
?>



<?php generate_footer();?>
<?php endif;?>
