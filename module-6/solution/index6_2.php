<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "Oppgave 2: arv";

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
    public $firstname;
    public $lastname;
    public $username;
    public $birthday;
    public $reg_date;

    function __construct($firstname, $lastname, $username, $birthday, $reg_date)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->birthday = $birthday;
        $this->reg_date = $reg_date;
    }


    function getFirstname() {
        return $this->firstname;
    }

    function getLastname() {
        return $this->lastname;
    }
}


class Student extends User{
    function __construct($firstname, $lastname, $username, $birthday, $reg_date)
    {
        parent::__construct($firstname, $lastname, $username, $birthday, $reg_date);
    }

    function getFirstname()
    {
       return "Firstname: "  . $this->firstname;
    }
}


$mystudent = new Student(firstname:"Bob", lastname:"Smith", username:"bob", birthday:"10-10-2000", reg_date:"12-09-2023");
var_dump($mystudent);
echo "<br>";
echo $mystudent->getFirstname();
echo "<br>"
?>



<?php generate_footer();?>
<?php endif;?>
