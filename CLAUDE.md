# CLAUDE.md — This Might Be Offensive (TMBO)

## Project Overview

TMBO is a legacy PHP web application (image/content sharing community). The codebase is a full-stack monolith with PHP 7.4, MySQL, Redis, Nginx, and a Node.js real-time service (Socket.IO).

- **Repo**: `git@github.com:rayhatfield/this-might-be-offensive.git`
- **Upstream**: `git@github.com:numist/this-might-be-offensive.git`

## Development Setup

### Docker (recommended)
```sh
cd services
docker compose up
```
Services: nginx (port 80), php (PHP 7.4-FPM, port 9000), db (MySQL, port 3306).

### Vagrant (legacy)
```sh
vagrant up
# Browse to https://localhost:8080/offensive
# Login: admin/[nsfw] or asdf/[tmbo]
```

## Project Structure

```
services/
├── compose.yaml              # Docker Compose config
├── nginx/                    # Nginx reverse proxy
│   ├── Dockerfile
│   └── src/default.conf
└── web/                      # PHP application
    ├── Dockerfile            # php:7.4-fpm + mysqli/PDO
    └── src/                  # ← Web root
        ├── offensive/        # Main application
        │   ├── index.php     # Main entry point
        │   ├── api.php       # API endpoints
        │   ├── assets/       # Core includes (header.inc, functions.inc, classes.inc, core.inc)
        │   ├── classes/      # Domain models (user, upload, comment, token, link, tmbo, etc.)
        │   ├── content/      # Page content modules (main, comments, search, settings, etc.)
        │   ├── templates/    # HTML templates
        │   ├── ui/           # UI API endpoints
        │   ├── js/           # JavaScript (jQuery 1.7.1, offensive.js, tmbolib.js)
        │   ├── pages/        # Static-ish pages
        │   └── docs/         # ~90 doc files
        ├── admin/            # Admin tools, DB schemas, config
        │   ├── database/     # schema.sql, migrations
        │   └── mysqlConnectionInfo.inc
        ├── realtime/         # Node.js Socket.IO service (port 1337)
        ├── b/                # Alt board-style UIs (burichan, futaba, yotsuba)
        ├── contact/          # Contact form
        ├── gis/              # GIS/mapping module
        └── styles/           # CSS (main, grid, thumbs, map, oldskool, sparse)
```

## Coding Standards (from HACKING file)

- **Indentation**: Hard tabs (`\t`) for code blocks. Use spaces for alignment beyond tab stops.
- **Braces**: Opening brace shares line with condition. Function opening braces get their own line.
- **File conventions**:
  - `.php` — user-navigable files
  - `.inc` — include files, generally in `offensive/assets/`
- **Every `.php` entry point** must start with:
  ```php
  set_include_path("relative/path/to/webroot");
  require_once("offensive/assets/header.inc");
  ```
- **No leading/trailing whitespace** outside `<? ?>` blocks in pure PHP files.

## Key Functions & Patterns

- `tmbo_query()` — All DB queries must use this (instrumentation + error reporting).
- `sqlEscape($string)` — SQL injection prevention (handles magic_quotes).
- `htmlEscape($string)` — XSS prevention for DB output.
- `trigger_error($msg, E_USER_*)` — Error reporting. Admins see errors on page; all go to Apache log.
- `me()` — Returns the current logged-in user object.
- `get_include_path()` — Returns path to web root for file resolution.

## Architecture Notes

- **MVC-ish**: Models in `classes/`, views in `templates/`, controllers in `content/`.
- **Caching**: Redis via Predis PHP client. Per-object caching in class instances.
- **Real-time**: Socket.IO (Node.js) on port 1337, uses Redis + MySQL for auth.
- **Auth**: Session-based with token support.
- **Frontend**: jQuery 1.7.1, jQuery UI 1.8.17, Google Maps v3.

## Database

- MySQL with schema in `admin/database/schema.sql`
- Migrations in `admin/database/` (SQL files dated 2011-2012, plus versioned r*.sql)
- Docker default creds: user=tmbo, pass=shortbus, db=tmbo

## .gitignore (notable entries)

```
offensive/data/comments.db*
offensive/quarantine
offensive/uploads
offensive/zips
admin/.config
admin/certificates
temp/
```
