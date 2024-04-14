<!DOCTYPE html>
<html>

<head>
    <title>Book List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* Responsive card layout */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 100%;
        max-width: 300px;
        margin: 10px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .container {
        padding: 2px 16px;
    }

    /* Responsive layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    @media screen and (max-width: 600px) {
        .row {
            flex-direction: column;
        }
    }
    </style>
</head>

<body>
    <?php
    // Include the database connection and book functions
    include 'db.php';
    include 'book.php';

    // Get all books
    $books = getAllBooks();
  ?>

    <h1>Book List</h1>

    <div class="row">
        <?php foreach($books as $book): ?>
        <div class="card">
            <img src="<?php echo $book['book_image']; ?>" alt="<?php echo $book['name']; ?>" style="width:100%">
            <div class="container">
                <h4><b><?php echo $book['name']; ?></b></h4>
                <p>Number of Copies: <?php echo $book['number_copies']; ?></p>
                <p>Author: <?php echo $book['author_name']; ?></p>
                <p>Publisher: <?php echo $book['publisher_name']; ?></p>
                <p>Section: <?php echo $book['section_name']; ?></p>
                <p>Language: <?php echo $book['language_name']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>