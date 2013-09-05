<?php

    
    require("common.php");
    
    if(!empty($_POST))
    {
     
        if(empty($_POST['username']))
        {
          die("Please enter a username.");
        }
        
        
        if(empty($_POST['password']))
        {
            die("Please enter a password.");
        }
    
     
        $query = "
            SELECT
                id
            FROM users
            WHERE
                username = :username
        ";
        
    
        $query_params = array(
            ':username' => $_POST['username']
        );
        
        try
        {
         
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.
        $row = $stmt->fetch();
        
        // If a row was returned, then we know a matching username was found in
        // the database already and we should not allow the user to continue.
        if($row)
        {
            die("This username is already in use");
        }
        
        // This query is used to create a new user record in the database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        $query = "
            INSERT INTO users (
                username,
                password,
				balance,
                salt
            ) VALUES (
                :username,
                :password,
				:balance,
                :salt
            )
        ";
        
        // A salt is randomly generated here to protect again brute force attacks
        // and rainbow table attacks.  The following statement generates a hex
        // representation of an 8 byte salt.  Representing this in hex provides
        // no additional security, but makes it easier for humans to read.
        // For more information:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        
        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex
        // string representing the 32 byte sha256 hash of the password.  The original
        // password cannot be recovered from the hash.  For more information:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $password = hash('sha256', $_POST['password'] . $salt);
        
        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form).
        $query_params = array(
            ':username' => $_POST['username'],
            ':password' => $password,
			':balance' => 0,
            ':salt' => $salt
        );
        
        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code. 
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // This redirects the user back to the login page after they register
        header("Location: index.php");
        
        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        die("Redirecting to index.php");
    }
    
?>
<h1>Register</h1>
<form action="register.php" method="post">
    Username:<br />
    <input type="text" name="username" value="" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" />
    <br /><br />
    <input type="submit" value="Register" />
</form>