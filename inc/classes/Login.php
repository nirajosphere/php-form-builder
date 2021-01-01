<?php
class Login{
	/**
	 * A function to generate the HTML login form on front-end
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_login_form(){
		global $application_url,$logo_uri;
		?>
		<div class="d-flex justify-content-center">
			<?php 
			if(isset($error)){
				echo $error;
			}
			?>
			<div class="p-5 login-wrapper">
				<a href="<?=$application_url?>" class="logo-wrapper">
					<img src="<?=$application_url.$logo_uri?>" id="logo">
				</a>
				<form action = "" method = "post">
					<div class="form-group">
						<label for="usr">Username:</label>
						<input type="text" class="form-control" id="usr" name = "username">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd" name = "password">
					</div>
					<input type = "submit" value = " Submit " class="btn btn-primary" /><br/>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * A function to validate the login
	 * 
	 * catchs and validates login information and setting current user when the user submits the login form
	 * 
	 * @uses $_POST varibales;
	 * 
	 * @return boolean if the current user is set, false if credentials are invalid
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function validate_login(){
		global $db_enc_key,$conn;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$myusername = $_POST['username'];
			$mypassword = $_POST['password']; 
			$login_sql=$conn->prepare('SELECT * FROM user WHERE username = ? and password =AES_ENCRYPT(?,?)');
			$login_sql->bind_param('sss',$myusername,$mypassword,$db_enc_key);
			$login_sql->execute();
			$result=$login_sql->get_result();
			$row = $result->fetch_assoc();
			$count = $result->num_rows;
			if($count == 1) {
				$_SESSION['username'] = $myusername;
				$_SESSION['fname']=$row['fname'];
				$_SESSION['lname']=$row['lname'];
				$_SESSION['email']=$row['email'];
				return true;
			} else {
				return false;
			}
		}
	}
	
	/**
	 * A function to check if user is logged in
	 * 
	 * @uses $_SESSION varibales;
	 * 
	 * @return boolean if the user is set, false if not
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function is_user_logged_in(){
		if(isset($_SESSION)&&isset($_SESSION['username'])){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * A function to unset the current user
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function logout(){
		unset($_SESSION);
		session_destroy();
	}
	
	/**
	 * A function to get the current user
	 * 
	 * @uses is_user_logged_in
	 * 
	 * @return Object - information of the current user.
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_current_user(){
		if(Login::is_user_logged_in()){
			return (object)$_SESSION;
		}
		else{
			return false;
		}
	}
}
?>