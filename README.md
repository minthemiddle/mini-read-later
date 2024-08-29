# Mini Read Later

Send a URL to read later to a GET endpoint.  
Title, URL, and markdown of content get saved to SQLite.  
All read later items get exposed via RSS and a web-based library.  

## Service

- Clone repo to site that will serve service and link to URL (called `SERVICEURL.com` from now)
- Create fresh database on the commandline with:
`sqlite3 sites.sqlite "CREATE TABLE sites (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, link TEXT, content TEXT, date_created_at TEXT);"`
- Post URL to read later with a token (e.g. `SERVICEURL.com/save.php?url=https://example.com&token=your_unique_token`). Ensure you replace `your_unique_token` with your actual token.
- Subscribe to RSS to see all read later items (`SERVICEURL.com/rss.php`)
- View all saved items in a web-based library (`SERVICEURL.com/library.php`)
- Adjust `SERVICEURL.com` to real URL in bookmarklet and ensure the token is correctly set in `bookmarklet.js`. Replace `your_unique_token` with your actual token in `bookmarklet.js`.
- Save bookmarklet to every browser to save as read me later

## Features

- **Environment Variable for Token**:
  - The application reads the secret token from the environment variable `TOKEN`. To set this variable, use the following command in your shell:
    ```bash
    export TOKEN=your_unique_token
    ```
  - Replace `your_unique_token` with your actual token. This environment variable is used in `save.php` to authenticate requests.

- **Token-Based Authentication**:
  - A unique token is required to authenticate requests to the `save.php` endpoint. This token should be included as a query parameter in the URL. Ensure you replace `your_unique_token` with your actual token in both the `save.php` endpoint and `bookmarklet.js`.

- **Token-Based Authentication**:
  - A unique token is required to authenticate requests to the `save.php` endpoint. This token should be included as a query parameter in the URL.

1. Save URLs for later reading
2. RSS feed of saved items
3. Web-based library to view all saved items
4. Bookmarklet for easy saving from any browser
