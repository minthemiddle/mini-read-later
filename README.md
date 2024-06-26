# Mini Read Later

Send an URL to read later to a GET endpoint.  
Title, URL, and markdown of content get saved to SQLite.  
All read later items get exposed via RSS.  

## Service

- Clone repo to site that will serve service and link to URL (called `SERVICEURL.com` from now)
- Create fresh database on the commandline with:
`sqlite3 sites.sqlite "CREATE TABLE sites (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, link TEXT, content TEXT, date_created_at TEXT);"`
- Post URL to read later (e.g. `SERVICEURL.com/save.php?url=https://example.com`)
- Subscribe to RSS to see all read later items (`SERVICEURL.com/rss.php`)
- Adjust `SERVICEURL.com` to real URL in bookmarklet
- Save bookmarklet to every browser to save as read me later
