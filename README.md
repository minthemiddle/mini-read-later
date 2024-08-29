# Mini Read Later

Send a URL to read later to a GET endpoint.  
Title, URL, and markdown of content get saved to SQLite.  
All read later items get exposed via RSS and a web-based library.  

## Service Setup

1. Clone the repository to your server (referred to as `SERVICEURL.com` in this guide).
2. Create a fresh SQLite database using the following command:
   ```
   sqlite3 sites.sqlite "CREATE TABLE sites (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, link TEXT, content TEXT, date_created_at TEXT);"
   ```
3. Set up token authentication:
   - Create a file named `token.txt` in the root directory of the project.
   - Add your unique token to this file. For example:
     ```
     echo "your_unique_token" > token.txt
     ```
4. Update the `bookmarklet.js` file:
   - Replace `SERVICEURL.com` with your actual service URL.
   - Replace `YOUR_FIXED_TOKEN_HERE` with your actual token.

## Usage

- Save a URL to read later:
  - Use the bookmarklet in your browser
  - Or manually send a GET request: `SERVICEURL.com/save.php?url=https://example.com&token=your_unique_token`
- View saved items:
  - RSS feed: `SERVICEURL.com/rss.php`
  - Web-based library: `SERVICEURL.com/library.php`

## Features

1. Token-based authentication for secure saving of URLs
2. Save URLs for later reading with title and content extraction
3. RSS feed of saved items
4. Web-based library to view all saved items
5. Bookmarklet for easy saving from any browser

## Files

- `save.php`: Handles saving of URLs
- `rss.php`: Generates RSS feed of saved items
- `library.php`: Web interface to view saved items
- `bookmarklet.js`: JavaScript code for the browser bookmarklet
- `token.txt`: Stores the authentication token (create this file manually)

## Note

Ensure all PHP files are accessible from the web server and that the SQLite database is writable by the web server process.
