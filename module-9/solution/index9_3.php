<?php
// The reason why we store the task name in a variable instead of directly
// using it in the HTML code is because this file gets inlcuded by index.php,
// which then access $task_name so that it can add it to it's list
$task_name = "";

// In index.php we import this file so that we can access $task_name.
// Without the if-statement below, the HTML code will displayed in index.php.
// __FILE__ and $_SERVER['SCRIPT_FILENAME'] explaination: https://stackoverflow.com/a/29697427/9215267
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) :

    // index.php is included as we use the generate_footer() function from it
    include "index.php";
    $user_id = 2;
    $upload_dir = "images";
    // 2 * 1024 * 2014 = 2MB
    $max_file_size = 2 * 1024 * 1024;
    $allowed_extensions = ["jpg", "png"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
            $file_name = $_FILES["file"]["name"];
            $file_size = $_FILES["file"]["size"];
            $tmp_file_name = $_FILES["file"]["tmp_name"];
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Check if file type and filze size is valid
            if (!in_array($file_type, $allowed_extensions) || $file_size > $max_file_size) {
                echo "Error: Invalid file. Only PNG and JPG under 2MB are allowed.";
            } else {
                // Backup the current profile picture
                // Reason for doing this:
                //  The profile pic can be JPG or PNG. So if the existing image is PNG, uploading a new PNG will
                //  overwrite the old PNG. But if the user uploads a JPG, the old image which is a PNG will still
                //  exist. This will lead to a single user having 2 profile pictures. This will further lead to 
                //  the wrong profile picture as we use a iterate over allowed extensions to find the user's profile
                //  picture. Since JPG is first in $allowed_extension, the JPG will always be shown if there are 2 images
                foreach ($allowed_extensions as $ext) {
                    $old_file = "$upload_dir/$user_id.$ext";
                    if (file_exists($old_file)) {
                        rename($old_file, "$old_file.bak");
                    }
                }

                // Attempt to move te uploaded file the directory where we store the profile pictures.
                if (move_uploaded_file($tmp_file_name, "$upload_dir/$user_id.$file_type")) {
                    // If this succeeds, we will delete the old profile picture which was "backed up".
                    foreach ($allowed_extensions as $ext) {
                        $bak_file = "$upload_dir/$user_id.$ext.bak";
                        if (file_exists($bak_file)) {
                            unlink($bak_file);
                        }
                    }

                    // "Reload" the page so that the profile picture gets updated for the user
                    header("Location: " . $_SERVER["REQUEST_URI"]);
                    exit();
                } else {
                    // If not, we will restore it and let the user know that the something went wrong
                    foreach ($allowed_extensions as $ext) {
                        if (file_exists($bak_file)) {
                            rename("$upload_dir/$user_id.$ext.bak", "$upload_dir/$user_id.$ext");
                        }
                    }
                    echo "Something went wrong";
                }
            }
        } else {
            echo "Error: File upload failed";
        }
    }

    echo "<h1>$task_name</h1>";

    // The profile pic will be either JPG or PNG. So find a JPG or PNG that is named afer the user's
    // user_id. Since there is only JPG or PNG, we dont have to worry about finding both. This is explained
    // further up in the code
    $existing_extension = null;
    foreach ($allowed_extensions as $ext) {
        if (file_exists("$upload_dir/$user_id.$ext")) {
            $existing_extension = $ext;
            break;
        }
    }

    if ($existing_extension) {
        // Reason for appending the current timestamp to the url for fetching the image is to
        // prevent the image not updating in the front end due to caching
        echo '<img src="' . "$upload_dir/$user_id.$existing_extension?" . time() . '">';
    } else {
        echo '<img src="images/default.jpg">';
    }
?>

    <br>
    <?php echo "Hello, Siddharth <br>"; ?>
    <form method="post" enctype="multipart/form-data">
        <p>Feel free to change your profile pic:</p>
        <input type="file" name="file" id="file">
        <input type="submit" name="submit" value="Upload">
    </form>
    <?php generate_footer(); ?>
<?php endif; ?>