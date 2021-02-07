<?php

function imagePlaceholder($image='') {

	if(!$image) { // ha nincs megadva kép, akkor placeholder
		return 'image_4.jpg';
	} else {
		return $image;
	}

}

function currentUser(){
	if(isset($_SESSION['username'])) {
		return $_SESSION['username'];
	}
	return false;
}

//=====DATABASE HELPER FUNCTIONS =====//

function redirect($location) {

	//return header("Location:" . $location);

	// this is more flexible, better than using return
	header("Location:" . $location);
	exit;
	
}

function query($query){
	global $connection;
	$result = mysqli_query($connection,$query);
	confirmQuery($result);
	return $result;
}

function fetchRecords($result){
	return mysqli_fetch_array($result);
}

function count_records($result){
	return mysqli_num_rows($result);
}

//=====END DATABASE HELPERS =====//

//=====GENERAL HELPERS =====//

function get_user_name() {
	return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

//===== END GENERAL HELPERS =====//

//===== AUTHENTICATION HELPERS=====//

// setting empty string as a default value
// function is_admin($username = '') {

function is_admin() {

	if(isLoggedIn()) {

		$result = query("SELECT user_role FROM users WHERE user_id = ".$_SESSION['user_id']."");

		$row = fetchRecords($result); // getting ONLY ONE ROW from db

		if($row['user_role'] == 'admin') {
			return true;
		} else {
			return false;
		}

	}

	return false;
}

//===== END AUTHENTICATION HELPERS=====//





//===== USER SPECIFIC HELPERS=====//

function get_all_user_posts(){
	return query("SELECT * FROM posts WHERE user_id = ".loggedInUserId()."");
}

function get_all_post_user_comments(){
	return query("SELECT * FROM posts
				INNER JOIN comments ON posts.post_id = comments.comment_post_id
				WHERE user_id =".loggedInUserId()."");
}

function get_all_user_categories(){
	return query("SELECT * FROM categories WHERE user_id = ".loggedInUserId()."");
}

function get_all_user_published_posts() {
	return query("SELECT * FROM posts WHERE user_id = ".loggedInUserId()." AND post_status = 'published'");
}

function get_all_user_draft_posts() {
	return query("SELECT * FROM posts WHERE user_id = ".loggedInUserId()." AND post_status = 'draft'");
}

function get_all_user_approved_comments() {
	return query("SELECT * FROM posts
				INNER JOIN comments ON posts.post_id = comments.comment_post_id
				WHERE user_id =".loggedInUserId()." AND comment_status = 'approved'");
}

function get_all_user_unapproved_comments() {
	return query("SELECT * FROM posts
			INNER JOIN comments ON posts.post_id = comments.comment_post_id
			WHERE user_id =".loggedInUserId()." AND comment_status = 'unapproved'");
}

//===== END USER SPECIFIC HELPERS=====//





// setting default parameter
// checking for POST and GET methods
function ifItIsMethod($method=null) {

	// making all the input UPPERCASE
	//if its post, if its get...
	if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
		return true;
	}

	return false;
}

function isLoggedIn(){
	if(isset($_SESSION['user_role'])) {
		return true;
	}

	return false;
}

function loggedInUserId() {
	if(isLoggedIn()){

		$result = query("SELECT * FROM users WHERE username ='" .$_SESSION['username']."'");

		confirmQuery($result);

		$user = mysqli_fetch_array($result);

		return mysqli_num_rows($result) >=1 ? $user['user_id'] : false;
		
		/*if(mysqli_num_rows($result) >= 1) {
			return $user['user_id'];
		}*/

	}
	return false;
}

function userLikedThisPost($post_id){

	$result = query("SELECT * FROM likes WHERE user_id =" .loggedInUserId() . " AND post_id = {$post_id}");
	confirmQuery($result);
	return mysqli_num_rows($result) >=1 ? true : false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
	if(isLoggedIn()) {
		redirect($redirectLocation);
	}
}

function getPostLikes($post_id){
	$result = query("SELECT * FROM likes WHERE post_id = $post_id");
	confirmQuery($result);
	echo mysqli_num_rows($result);
}

// MySQL-injection ellen kell
function escape($string) {

	global $connection;

	return mysqli_real_escape_string($connection, trim($string));

}

function users_online(){

	if(isset($_GET['onlineusers'])) {		

		global $connection;

		if(!$connection) {

			session_start();
			include("../includes/db.php");

		    $session = session_id(); // catching the id of every open session

		    // 14:00 - user insert
		    $time = time(); // The time() function returns the current time in the number of seconds since the Unix Epoch

		    $time_out_in_seconds = 30; // 60 seconds

		    // 14:09 admin update
		    $time_out = $time - $time_out_in_seconds;

		    $query = "SELECT * FROM users_online WHERE session = '$session'";
		    $send_query = mysqli_query($connection,$query);
		    $count = mysqli_num_rows($send_query);

		    if($count == NULL) { // when a new user just logged in

		        // 14:00 - user insert
		        mysqli_query($connection,"INSERT INTO users_online(session, time) VALUES('$session','$time')");

		    } else { // if the user is not new

		        mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");

		    }

		    // admin update at 14:10 --- user inactive volt --- 14:00 > 14:09 --- INACTIVE
		    // admin update at 14:10 --- user active volt --- 14:09:30 user update --- 14:09:30 > 14:09 --- ACTIVE
		    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
		    echo $count_user = mysqli_num_rows($users_online_query); // echo az AJAX-hoz kell (return helyett)

		}

    } // get request isset()

}

users_online();

function confirmQuery($result) {


	global $connection;

	if(!$result) {
		die("QUERY FAILED ." . mysqli_error($connection));
	}


}

// function insert_categories() {

// 	global $connection; // so we can use it inside the function...

//     if(isset($_POST['submit'])) {

// 	    $cat_title = $_POST['cat_title'];

// 	    if($cat_title == "" || empty($cat_title)) {

// 	        echo "This field should not be empty";

// 	    } else {

// 	        $query = "INSERT INTO categories(cat_title) ";
// 	        $query .= "VALUES ('{$cat_title}')";

// 	        $create_category_query = mysqli_query($connection, $query);

// 	        if(!$create_category_query) { // checking if query was successful...

// 	            die('QUERY FAILED' . mysqli_error($connection));

// 	        }

// 	    }

// 	}

// }

// PREPARED STATEMENT
function insert_categories() {

	global $connection; // so we can use it inside the function...

    if(isset($_POST['submit'])) {

	    $cat_title = $_POST['cat_title'];

	    if($cat_title == "" || empty($cat_title)) {

	        echo "This field should not be empty";

	    } else {

	        $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) "); // PREPARE

	        mysqli_stmt_bind_param($stmt, 's', $cat_title); // s for string BIND

	        mysqli_stmt_execute($stmt); // EXECUTE

	        if(!$stmt) { // checking if query was successful...

	            die('QUERY FAILED' . mysqli_error($connection));

	        }

	    }

	    mysqli_stmt_close($stmt);

	}

}

function findAllCategories() {


	global $connection; // so we can use it inside the function...


	$query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }


}

function deleteCategories() {


	global $connection;

    if (isset($_GET['delete'])) {

    $the_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: categories.php"); // force redirect to see result

	}


}

function recordCount($table){

	global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_post = mysqli_query($connection, $query);

	$result = mysqli_num_rows($select_all_post); // getting the number of existing posts in the system

	confirmQuery($result);

	return $result;

}

function checkStatus($table,$column,$status) {

	global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);

	confirmQuery($result);

	return mysqli_num_rows($result);

}

function checkUserRole($table,$column,$role){


	global $connection;

	$query = "SELECT * FROM $table WHERE $column = '$role'";
	$select_all_subscribers = mysqli_query($connection,$query);

	return mysqli_num_rows($select_all_subscribers);

}

function username_exists($username) {

	global $connection;

	$query = "SELECT username FROM users WHERE username = '$username'";

	$result = mysqli_query($connection, $query);

	confirmQuery($result);

	if(mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}
}

function email_exists($email) {

	global $connection;

	$query = "SELECT user_email FROM users WHERE user_email = '$email'";

	$result = mysqli_query($connection, $query);

	confirmQuery($result);

	if(mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}
}

function register_user($username,$email,$password) {

	global $connection;

    // cleaning data before they go to db (MySQL injection ellen kell)
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12)); // new encryption method

    // $query = "SELECT randSalt FROM users";
    // $select_randSalt_query = mysqli_query($connection,$query);

    // if(!$select_randSalt_query) {

    //     die("Query Failed" . mysqli_error($connection));

    // }

    // $row = mysqli_fetch_array($select_randSalt_query); // amikor csak 1 sor van (result set)

    // $salt = $row['randSalt']; // amikor csak 1 sor van (result set)

    //echo "$salt";

    // $password = crypt($password, $salt); // encrypting password

    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber')"; // default value subscriber

    $register_user_query = mysqli_query($connection,$query);

    /*if(!$register_user_query) {

        die("QUERY FAILED ". mysqli_error($connection)) . ' ' . mysqli_errno($connection);

    }*/

    confirmQuery($register_user_query);

    // $message = "Your Registration has been submitted";

}

function login_user($username, $password){

	global $connection;

	$username = trim($username);
	$password = trim($password);


	$username = mysqli_real_escape_string($connection,$username); // cleaning input to avoid mysql injection
	$password = mysqli_real_escape_string($connection,$password); // cleaning input to avoid mysql injection

	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	$select_user_query = mysqli_query($connection, $query);

	if(!$select_user_query) {

		die("QUERY FAILED" . mysqli_error($connection));

	}


	while ($row = mysqli_fetch_array($select_user_query)) {

		$db_user_id = $row['user_id'];
		$db_username = $row['username'];
		$db_user_password = $row['user_password'];
		$db_user_firstname = $row['user_firstname'];
		$db_user_lastname = $row['user_lastname'];
		$db_user_role = $row['user_role'];

		if(password_verify($password, $db_user_password)) { // new encryption method

			$_SESSION['user_id'] = $db_user_id;

			$_SESSION['username'] = $db_username;
			$_SESSION['firstname'] = $db_user_firstname;
			$_SESSION['lastname'] = $db_user_lastname;
			$_SESSION['user_role'] = $db_user_role;

			//header("Location: ../admin");
			redirect("/cms/admin");

		} else {

			//header("Location: ../index.php"); // ha nincs ilyen fiók
			//redirect("index.php");

			return false;
			
		}

	}

	return true;

	// $password = crypt($password, $db_user_password);

	// if($username === $db_username && $password === $db_user_password) { // ha a credential-ök megegyeznek/helyesek, akkor login

	// 	// setting sessions

	// 	$_SESSION['username'] = $db_username;
	// 	$_SESSION['firstname'] = $db_user_firstname; // so we can personalize the admin page...
	// 	$_SESSION['lastname'] = $db_user_lastname;
	// 	$_SESSION['user_role'] = $db_user_role;

	// 	header("Location: ../admin");

	// } else {

	// 	header("Location: ../index.php"); // ha nincs ilyen fiók

	// }

}

?>