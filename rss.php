<?php
// Connect to SQLite database
$db_file = "sites.sqlite";

try {
    $pdo = new PDO("sqlite:" . $db_file);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    exit("Failed to connect to database!");
}

// Fetch data from the database
$stmt = $pdo->prepare("SELECT * FROM sites ORDER BY date_created_at DESC");
$stmt->execute();
$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate the RSS feed
header("Content-Type: application/xml; charset=utf-8");
echo <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>Read Later</title>
        <link>https://readlater.martinbetz.eu</link>
        <description>RSS feed of sites to read later</description>
        <language>en-us</language>
XML;

function sanitize($var)
{
    return htmlspecialchars($var, ENT_QUOTES);
}

foreach ($sites as $site) {
    echo "<item>" . PHP_EOL;
    echo "<title>" . sanitize($site["title"]) . "</title>" . PHP_EOL;
    echo "<link>" . $site["link"] . "</link>" . PHP_EOL;
    echo "<pubDate>" .
        date("r", strtotime($site["date_created_at"])) .
        "</pubDate>" .
        PHP_EOL;
    echo "<description>" . $site["content"] . "</description>" . PHP_EOL;
    echo "</item>" . PHP_EOL;
}

echo <<<XML
    </channel>
</rss>
XML;
