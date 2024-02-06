<?php

class Authentication
{
    function login()
    {
        // Step 2: connect to the database
        $database = connectToDB();

        // Step 3: get all the data from the form using $_POST
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Step 4: error checking
        if ( empty( $email ) || empty( $password ) ) {
            setError( "All the fields are required.", "/login" );
        } else {
            // Step 5: login the user
            // 5.1 - retrieve the user data from your users table using the email provided by the user
            // 5.1.1 - sql command (recipe)
            $sql = "SELECT * FROM users WHERE email = :email";
            // 5.1.2 - prepare
            $query = $database->prepare($sql);
            // 5.1.3 - execute
            $query->execute([
                'email' => $email
            ]);
            // 5.1.4 - fetch 
            $user = $query->fetch(); // get only one row of data
            
            // 5.2 - make sure the $user is not empty
            if ( empty( $user ) ) {
                setError( "The email provided does not exists", "/login" );
            } else {
                // 5.3 - make sure the password is correct
                if ( password_verify( $password, $user["password"] ) ) {
                // 5.4 - if password is valid, login the user
                $_SESSION["user"] = $user;

                // Step 6: redirect back to home page
                header("Location: /");
                exit;
                } else {
                    setError( "The password provided is incorrect", "/login" );
                }
            }
        }
    }

    function signup()
    {
        // Step 2: connect to the database
        $database = connectToDB();

        // Step 3: get all the data from the form using $_POST
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Step 4: error checking
            // 4.1 make sure all the fields are not empty
        if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
                setError( "All the fields are required.", '/signup' );
        } else if ( $password !== $confirm_password ) {
                // 4.2 - make sure password is match
                setError( "The password is not match", '/signup' );
        } else if ( strlen( $password ) < 8 ) {
                // 4.3 - make sure the password length is at least 8 chars
                setError( "Your password must be at least 8 characters", '/signup' );
        } else {
            // step 5: create the user account
                // 5.1 - sql command (recipe)
                $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";
                // 5.2 - prepare (put everything into th bowl)
                $query = $database->prepare( $sql );
                // 5.3 - execute (cook it)
                $query->execute([
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash( $password, PASSWORD_DEFAULT )
                ]);

            // Step 6: redirect back to login
            header("Location: /login");
            exit;
        }
    }

    function logout()
    {
        // remove user session
        unset( $_SESSION['user'] );

        // redirect the user back to home page
        header("Location: /");
        exit;
    }
}