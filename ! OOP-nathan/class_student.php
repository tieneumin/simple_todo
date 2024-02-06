<?php

class Student
{
    function add()
    {
        // Step 2: connect to the database
        $database = connectToDB();

        // Step 3: grab the name from $_POST
        $student_name = $_POST["student_name"];

        // do error checking and check if $student_name is empty or not
        if ( empty( $student_name ) ) {
        setError( 'Please enter a name', '/' );
        } else {
        // Step 4: add the name into the database
            // 4.1 - sql command
            $sql = 'INSERT INTO students (`name`) VALUES (:name)';
            // 4.2 - prepare 
            $query = $database->prepare($sql);
            // 4.3 - execute
            $query->execute([
                'name' => $student_name
            ]);

        // Step 5: redirect the user back to home page
            header("Location: /");
            exit;
        }
    }

    function update()
    {
        // Step 2: connect to the database
        $database = connectToDB();

        // step 3: get student id and updated name from $_POST
        $student_name = $_POST["student_name"];
        $student_id = $_POST["student_id"];

        // do error checking. Check if student name is empty or not
        if ( empty( $student_name ) ) {
        setError( 'Please enter a name', '/' );
        } else {
        // Step 4: update the name in database
            // 4.1 - sql command (recipe)
            $sql = "UPDATE students SET name = :name WHERE id = :id";
            // 4.2 - prepare (put everything into the bowl)
            $query = $database->prepare( $sql );
            // 4.3 - execute (cook it)
            $query->execute([
                'name' => $student_name,
                'id' => $student_id
            ]);

        // Step 5: redirect back to home page
        header("Location: /");
        exit;

        }
    }

    function delete()
    {
        // Step 2: connect to the database
        $database = connectToDB();

        // step 3: get student ID from the $_POST
        $student_id = $_POST["student_id"];

        // step 4: delete the student from the database using student ID
            // 4.1 - sql command (recipe)
            $sql = "DELETE FROM students where id = :id";
            // 4.2 - prepare (put everything into the bowl)
            $query = $database->prepare($sql);
            // 4.3 - execute (cook it)
            $query->execute([
                'id' => $student_id
            ]);

        // Step 5: redirect back to home page
        header("Location: /");
        exit;
    }
}