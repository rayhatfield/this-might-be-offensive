# Database Initialization Scripts

This directory contains SQL scripts that are automatically executed by the MySQL Docker container on first startup.

## Execution Order

The MySQL Docker image runs scripts in `/docker-entrypoint-initdb.d` in alphabetical order:

1. `01-dbinit.sql` - Creates database and sets up user permissions (Docker-optimized)
2. `02-schema.sql` - Creates all database tables
3. `03-populate.sql` - Seeds initial test users

## Files Source

- `01-dbinit.sql` - Modified version of `web/src/admin/database/dbinit.sql` (changed user grant for Docker networking)
- `02-schema.sql` - Direct copy of `web/src/admin/database/schema.sql`
- `03-populate.sql` - Direct copy of `web/src/admin/database/populate.sql`

## First Startup Behavior

These scripts ONLY run when MySQL's data directory is empty (fresh container).

To trigger re-initialization:
```bash
docker compose down
rm -rf ./temp/mysql/*
docker compose up
```

## Test Users Created

- **admin** (userid: 1) - Account status: admin
- **asdf** (userid: 2) - Account status: normal

Password hashes are SHA1. Refer to application code for actual passwords.
