<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "library");

// Check if connection failed
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // If connection fails, display an error message and stop the script
}

// Insert book details when 'Add Book' form is submitted
if (isset($_POST['add_book'])) {
    // Get form data
    $accession_no = $_POST['accession_no']; // Retrieve the accession number from the form
    $title = $_POST['title']; // Retrieve the title from the form
    $authors = $_POST['authors']; // Retrieve the authors from the form
    $edition = $_POST['edition']; // Retrieve the edition from the form
    $publisher = $_POST['publisher']; // Retrieve the publisher from the form

    // SQL query to insert book into database
    $sql = "INSERT INTO books (accession_no, title, authors, edition, publisher) 
            VALUES ('$accession_no', '$title', '$authors', '$edition', '$publisher')";

    // Check if insert was successful
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Book added successfully!</p>"; // Display success message if book is added
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>"; // Display error message if there is an issue
    }
}

// Search for a book when 'Search Book' form is submitted
if (isset($_POST['search_book'])) {
    $search_title = $_POST['search_title']; // Get the search term from the form
    // SQL query to search book titles that match the search input
    $search_sql = "SELECT * FROM books WHERE title LIKE '%$search_title%'";
    $search_result = $conn->query($search_sql); // Execute the query and store the result
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Information System</title>
    <style>
        /* Overall page styling */
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(231, 199, 224); /* Set background color */
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #2c3e50; /* Set color for headings */
        }
        /* Form styling */
        form {
            background-color: rgb(226, 186, 186); /* Set form background color */
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Add shadow for form */
        }
        label {
            font-weight: bold; /* Make label text bold */
        }
        input[type="text"], input[type="number"] {
            width: 95%; /* Set width of input fields */
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Set border color */
            border-radius: 5px; /* Round the corners of input fields */
        }
        input[type="submit"] {
            background-color: #3498db; /* Set button background color */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #2980b9; /* Change button color on hover */
        }
        /* Table styling for displaying search results */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd; /* Add border to table cells */
            padding: 12px;
            text-align: center; /* Center-align the content */
        }
        th {
            background-color: #3498db; /* Set table header background color */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row background color */
        }
        /* Success and error message styling */
        .success {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Form to add a new book -->
    <h2>Add Book</h2>
    <form method="POST" action="">
        <label>Accession Number:</label><br>
        <input type="number" name="accession_no" required><br>

        <label>Title:</label><br>
        <input type="text" name="title" required><br>

        <label>Authors:</label><br>
        <input type="text" name="authors" required><br>

        <label>Edition:</label><br>
        <input type="text" name="edition" required><br>

        <label>Publisher:</label><br>
        <input type="text" name="publisher" required><br>

        <input type="submit" name="add_book" value="Add Book"> <!-- Button to submit book -->
    </form>

    <!-- Form to search for a book by title -->
    <h2>Search Book</h2>
    <form method="POST" action="">
        <label>Enter Title to Search:</label><br>
        <input type="text" name="search_title" required><br>

        <input type="submit" name="search_book" value="Search"> <!-- Button to search for book -->
    </form>

    <?php
    // Display search results if a search was performed
    if (isset($search_result)) {
        if ($search_result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table>";
            echo "<tr>
                    <th>Accession No</th>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Edition</th>
                    <th>Publisher</th>
                  </tr>";

            // Output each matching book as a table row
            while ($row = $search_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['accession_no']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['authors']}</td>
                        <td>{$row['edition']}</td>
                        <td>{$row['publisher']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No book found with that title.</p>"; // Display message if no results are found
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
