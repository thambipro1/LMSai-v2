<?php include('student_navbar.php');?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();
;

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database = "eb_lms";

$db = new mysqli($servername, $dbUsername, $dbPassword, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$search = "";
$filter = "book_title";
$book_id = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_GET['search']) && isset($_GET['filter'])) {
    $search = $_GET['search'];
    $filter = $_GET['filter'];
}

function displaySearchForm($search, $filter) {
    echo '<div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by title, author, ISBN, or keyword" value="' . htmlspecialchars($search) . '" required>
            <select name="filter">
                <option value="book_title"' . ($filter == "book_title" ? " selected" : "") . '>Title</option>
                <option value="author"' . ($filter == "author" ? " selected" : "") . '>Author</option>
                <option value="isbn"' . ($filter == "isbn" ? " selected" : "") . '>ISBN</option>
                <option value="category_id"' . ($filter == "category_id" ? " selected" : "") . '>Category</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>';
}

function displaySearchResults($db, $search, $filter) {
    $query = "SELECT * FROM book";
    $params = [];

    if (!empty($search)) {
        $query .= " WHERE $filter LIKE ?";
        $params[] = '%' . $search . '%';
    }

    $stmt = $db->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param("s", ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    echo "<div class='catalog-container'>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book-entry' data-id='" . $row['book_id'] . "'>";

            if (!empty($row['book_image'])) {
                echo "<img src='" . htmlspecialchars($row['book_image']) . "' alt='Book Image' style='width:100px;height:150px;'>";
            } else {
                echo "<img src='placeholder.png' alt='No Image' style='width:100px;height:150px;'>";
            }

            echo "<h3>" . htmlspecialchars($row['book_title']) . "</h3>";
            echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
            echo "<button class='view-details' data-id='" . $row['book_id'] . "'>View Details</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No books available at the moment.</p>";
    }
    echo "</div>";
}

function displayBookDetails($db, $book_id) {
    $stmt = $db->prepare("SELECT * FROM book WHERE book_id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {
        echo "<div class='book-details'>";
        
        if (!empty($book['book_image'])) {
            echo "<img src='" . htmlspecialchars($book['book_image']) . "' alt='Book Image' style='width:150px;height:200px;'>";
        } else {
            echo "<img src='placeholder.png' alt='No Image' style='width:150px;height:200px;'>";
        }

        echo "<h2>" . htmlspecialchars($book['book_title']) . "</h2>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($book['author']) . "</p>";
        echo "<p><strong>Publisher:</strong> " . htmlspecialchars($book['publisher_name']) . "</p>";
        echo "<p><strong>ISBN:</strong> " . htmlspecialchars($book['isbn']) . "</p>";
        echo "<p><strong>Category ID:</strong> " . htmlspecialchars($book['category_id']) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars($book['status']) . "</p>";
        echo "<p><strong>Copyright Year:</strong> " . htmlspecialchars($book['copyright_year']) . "</p>";
        echo "<p><strong>Date Added:</strong> " . htmlspecialchars($book['date_added']) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Book not found.</p>";
    }
}

if ($book_id) {
    displayBookDetails($db, $book_id);
} else {
    displaySearchForm($search, $filter);
    displaySearchResults($db, $search, $filter);
}

$db->close();
ob_end_flush();
?>

<!-- Inline CSS for Koha-like styling -->
<style>
/* General Body Styling */
body {
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f4f8;
    color: #333;
    animation: fadeInPage 1s ease-in;
}

/* Page Fade-In Animation */
@keyframes fadeInPage {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Search Container Styling */
.search-container {
    margin: 20px auto;
    text-align: center;
    width: 80%;
    animation: slideDown 0.8s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.search-container form {
    display: flex;
    justify-content: center;
    gap: 10px;
}

input[type="text"] {
    padding: 12px; /* Increased padding for a larger clickable area */
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px; /* Keep font size unchanged */
    width: 3000px; /* Set a specific width for the input */
    max-width: 100%; /* Ensure it doesn't overflow */
}

select {
    padding: 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px; /* Keep font size unchanged */
    width: 150px; /* Set a specific width for the select */
}

button {
    padding: 12px 20px; /* Increased padding for buttons */
    border-radius: 5px;
    border: none;
    background-color: #337ab7;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #286090;
}

/* Catalog Container Styling */
.catalog-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin: 20px auto;
    width: 80%;
}

/* Individual Book Entry Styling */
.book-entry {
    width: 200px;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    opacity: 0;
    animation: fadeInSlide 0.8s ease forwards;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.book-entry:hover {
    transform: translateY(-10px);
}

.book-entry img {
    display: block;
    margin: 0 auto 10px;
    border-radius: 5px;
}

.book-entry h3 {
    font-size: 18px;
    color: #337ab7;
    margin-bottom: 10px;
}

.book-entry p {
    font-size: 14px;
    color: #555;
    margin: 5px 0;
}

/* Modal Styling */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 90%;
    max-width: 500px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    animation: zoomIn 0.5s ease;
}

@keyframes zoomIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.close-modal {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close-modal:hover {
    color: #000;
}

/* Book Details Styling Inside Modal */
.book-details img {
    display: block;
    margin-bottom: 20px;
    border-radius: 5px;
}

.book-details h2,
.book-details p {
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.createElement('div');
    modal.classList.add('modal');
    modal.innerHTML = `
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modalDetails"></div>
        </div>
    `;
    document.body.appendChild(modal);

    const viewDetailsButtons = document.querySelectorAll('.view-details');
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const bookId = this.getAttribute('data-id');
            fetch(`opac.php?id=${bookId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('modalDetails').innerHTML = data;
                    modal.style.display = 'flex';
                });
        });
    });

    document.querySelector('.close-modal').addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
</script>
