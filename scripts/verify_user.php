<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		$_SESSION["loggedin"] = false;
	}
	
	if ($_SESSION["loggedin"])
	{
          $id=$_SESSION['userID'];
          $query = $conn->query("SELECT userID, naam, telnr, alt_telnr, email, rollID FROM users WHERE userID =".$id);
          $current_user = null;
          while ($i = $query->fetch_assoc())
          {
               $current_user = $i;
          };
          if ($current_user == null)
          {
          	session_destroy();
			$_SESSION["loggedin"] = false;
          }
	}

	function need_login()
	{

		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://";   
	    else $url = "http://";   


	    $url.= $_SERVER['HTTP_HOST'];   
	    

	    $url.= $_SERVER['REQUEST_URI'];  

		$_SESSION["page"] = $url;

		if (!$_SESSION["loggedin"])
		{
			header("location: inlog.php");
			die();
		}
	}

	function need_admin($user)
	{
		need_login();
		if ($user['rollID'] != '1')
		{
			header("location: unauthorized_admin.php");
			die();
		}
	}

