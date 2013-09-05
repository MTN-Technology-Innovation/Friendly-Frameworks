<?php

    // First we execute our common code to connection to the database and start the session
    require("common.php");
    
    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: index.php");
        
        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to index.php");
    }
    
    // Everything below this point in the file is secured by the login system
    
    // We can display the user's username to them by reading it from the session array.  Remember that because
    // a username is user submitted content we must use htmlentities on it before displaying it to the user.  The
    // fact that we retrieved it from a database and not directly from the user does not matter.
?>
<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="menustyle.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<div class="head">
	
					
				
								<script>
								var whatever = "<?php echo $_SESSION['user']['username']; ?>";
								alert(whatever);
								
								$.ajax({
										  url: "classes/customerdata.php",
										  dataType: 'json',
										  success: function(data){
											var username = data.username;
											var userid = data.userid;
											var userbalance = data.userbalance;
										//	$('#cust_name').html('Username: ' + username);
										//	$('#cust_id').html('User ID: ' + userid);
											$('#cust_balance').html('Credits: '+  userbalance);
										  },
										  error: function(data){
											alert('fail.');
										  }
										});

								</script>
						
								
							<!--	<span id = "cust_name" class = "custdata"></span>
								<span id = "cust_id" 	class = "custdata"></span>-->
								<span id = "cust_balance" class = "custdata"></span>
	</div>



<div id="wrapper">

	
	
    <div class="post">
			
					
					<ul id="panel">
						<li><h1>SMS Portal</h1></li>
						<li class="animation"><a href="#">Link 1</a></li>
						<li class="animation"><a href="#">Link 2</a></li>
						<li class="animation"><a href="#">Link 3</a></li>
						<li class="animation"><a href="#">Link 4</a></li>
						<li class="animation"><a href="logout.php">Logout</a></li>
						
					</ul>	
					
		
					
				
			

	</div>
	
   
	
	<div class = "main">
					<div id="content">
					Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, secret content!<br />
					Your Current ID is <?php echo htmlentities($_SESSION['user']['id'], ENT_QUOTES, 'UTF-8'); ?><br />
					Your Current Balance in php is <?php echo htmlentities($_SESSION['user']['balance'], ENT_QUOTES, 'UTF-8'); ?>, and you are a poes<br />
					
					</div>
	</div>
	
    
</div>








</body>
</html>