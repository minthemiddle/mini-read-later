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
$stmt = $pdo->prepare(
    "SELECT title, link, date_created_at FROM sites ORDER BY date_created_at DESC"
);
$stmt->execute();
$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate the HTML
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Later Library</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            color: #0066cc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .date {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Read Later Library</h1>
    <ul>
        <?php foreach ($sites as $site): ?>
            <li>
                <a href="<?= htmlspecialchars(
                    $site["link"]
                ) ?>" target="_blank"><?= htmlspecialchars(
    $site["title"]
) ?></a>
                <span class="date">(<?= htmlspecialchars(
                    $site["date_created_at"]
                ) ?>)</span>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
