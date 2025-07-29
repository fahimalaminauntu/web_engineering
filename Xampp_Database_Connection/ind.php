<?php
$title = $author = $description = "";
$submitted = false;

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'books';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBook'])) {
    $title = htmlspecialchars(trim($_POST['title']));
    $author = htmlspecialchars(trim($_POST['author']));
    $description = htmlspecialchars(trim($_POST['description']));

    $stmt = $conn->prepare("INSERT INTO books_info (title, author, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $description);

    if ($stmt->execute()) {
        $submitted = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $submitted ? "Book Added" : "Add Book"; ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            padding: 30px 40px;
            max-width: 480px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .container:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #4a3aff;
            font-weight: 700;
            font-size: 1.9rem;
            letter-spacing: 1.5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 1rem;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.8px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
            resize: vertical;
            min-height: 42px;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4a3aff;
            box-shadow: 0 0 5px #4a3aff;
        }

        textarea {
            min-height: 100px;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 25px;
            background: #4a3aff;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(74, 58, 255, 0.5);
        }

        button:hover,
        button:focus {
            background: #6c5eff;
            box-shadow: 0 6px 20px rgba(108, 94, 255, 0.7);
            outline: none;
        }

        .description-text {
            white-space: pre-wrap;
            margin-top: 6px;
            background: #f9f9ff;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
            color: #555;
        }

        a.button-link {
            display: block;
            margin-top: 30px;
            text-decoration: none;
        }

        a.button-link button {
            width: 100%;
        }

        @media (max-width: 520px) {
            .container {
                padding: 25px 20px;
                width: 95%;
            }

            h1 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            button {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (!$submitted): ?>
            <h1>Add a New Book</h1>
            <form action="" method="POST" novalidate>
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" required />

                <label for="author">Author:</label>
                <input type="text" id="author" name="author" placeholder="Enter author name" required />

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="5" placeholder="Write a brief description"
                    required></textarea>

                <button type="submit" name="addBook">Add Book</button>
            </form>
        <?php else: ?>
            <h1>Book Added Successfully</h1>
            <p><strong>Title:</strong> <?php echo $title; ?></p>
            <p><strong>Author:</strong> <?php echo $author; ?></p>
            <p><strong>Description:</strong></p>
            <div class="description-text"><?php echo nl2br($description); ?></div>
            <a href="" class="button-link"><button>Add Another Book</button></a>
        <?php endif; ?>
    </div>
</body>

</html>