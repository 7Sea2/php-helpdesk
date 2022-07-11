<?php
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
			$_SESSION["loggedin"] = false;			die();
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

	function need_admin()
	{
		need_login();
		$user = $GLOBALS['current_user'];
		if ($user['rollID'] != '1')
		{
			alert('unauthorized admin', 'warning');
			die();
		}
	}

	function need_user($userID, $allowAdmin = false)
	{
		need_login();
		$c_user = $GLOBALS['current_user'];
		if ($allowAdmin && ($c_user['rollID'] == 1)) return;
		if ($c_user['userID'] != $userID)
		{
			alert('unauthorized user', 'warning');
			die();
		}
	}
