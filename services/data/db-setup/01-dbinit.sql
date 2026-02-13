-- Docker-optimized database initialization
-- Note: MYSQL_DATABASE env var already creates the database, but this ensures it exists
CREATE DATABASE IF NOT EXISTS tmbo CHARACTER SET utf8 COLLATE utf8_bin;

-- Grant permissions to tmbo user from any host (Docker containers)
-- Changed from 'tmbo'@'localhost' to 'tmbo'@'%' for Docker networking
GRANT ALL ON tmbo.* TO 'tmbo'@'%';
FLUSH PRIVILEGES;
