#!/bin/bash

# --- Muutujad ---
BACKUP_DIR="/var/backups"
WEB_DIR="/var/www/kasutajatugi"              # Tee oma veebileheni
DB_USER="tugi_user"                       # Andmebaasi kasutajanimi
DB_PASS="TurvalineParool123!"                  # Andmebaasi parool
DB_NAME="kasutajatugi_db"              # Varundatav andmebaas
DB_HOST="10.0.26.10"                 # Kaugandmebaasi IP
DATE=$(date +"%Y-%m-%d_%H-%M")       # Kuupäev ja kellaaeg failinimes

# --- Tee ajutine kataloog ---
TMP_DIR="/tmp/backup_$DATE"
mkdir -p "$TMP_DIR"

# --- Kopeeri veebilehe failid ---
cp -r "$WEB_DIR" "$TMP_DIR/html"

# --- Andmebaasi dump kaugserverist ---
mysqldump -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" > "$TMP_DIR/${DB_NAME}_backup.sql"

# --- Pakime kokku üheks .tar.gz failiks ---
tar -czf "$BACKUP_DIR/backup_${DATE}.tar.gz" -C "$TMP_DIR" .

# --- Kustutame ajutise kataloogi ---
rm -rf "$TMP_DIR"

# --- Kustutame vanad failid (vanemad kui 7 päeva) ---
find "$BACKUP_DIR" -type f -name "backup_*.tar.gz" -mtime +7 -exec rm {} \;

# --- Logi ---
echo "[$(date)] Varukoopia loodud: $BACKUP_DIR/backup_${DATE}.tar.gz"
