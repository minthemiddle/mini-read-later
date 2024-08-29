<?php

// Add CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Function to connect to SQLite database
function connectToDatabase()
{
    $databasePath = __DIR__ . "/sites.sqlite";
    try {
        $pdo = new PDO("sqlite:" . $databasePath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Function to check if an entry exists in the database based on URL
function isEntryExisting(PDO $pdo, $url)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM sites WHERE link = ?");
    $stmt->execute([$url]);
    return $stmt->fetchColumn() > 0;
}

// Function to extract the title from a URL
function getPageTitle($url)
{
    $html = file_get_contents($url);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $title = $doc->getElementsByTagName("title")->item(0)->nodeValue;
    return $title;
}

// Function to fetch the Markdown content from the Jina AI endpoint
function getMarkdownContent($url)
{
    $jinaUrl = "https://r.jina.ai/" . $url;
    $content = file_get_contents($jinaUrl);
    return $content;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $url = $_GET["url"] ?? "";

    if (!empty($url)) {
        // Connect to the database
        $pdo = connectToDatabase();

        // Extract the title from the URL
        $title = getPageTitle($url);

        // Fetch the Markdown content from the Jina AI endpoint
        $content = getMarkdownContent($url);

        $currentDate = date("Y-m-d H:i:s"); // Get the current date and time in YYYY-MM-DD HH:MM:SS format

        if (!isEntryExisting($pdo, $url)) {
            try {
                $stmt = $pdo->prepare(
                    "INSERT INTO sites (title, link, content, date_created_at) VALUES (?, ?, ?, ?)"
                );
                $stmt->execute([$title, $url, $content, $currentDate]);

                // Output debugging information
                echo "Inserted: Title - $title, URL - $url, Content - $content, Date Created - $currentDate <br>";
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        } else {
            echo "Entry already exists in the database.";
        }

        // Send the URL back
        echo $url;
    } else {
        http_response_code(400); // Bad Request
        echo "Please provide a URL as a query parameter.";
    }
} else {
    // Handle cases where it's not a GET request
    http_response_code(405); // Method Not Allowed
    echo "This endpoint only accepts GET requests.";
}
