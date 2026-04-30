-- Tambah kolom gambar jika belum ada
ALTER TABLE berita ADD COLUMN IF NOT EXISTS gambar VARCHAR(191) NULL AFTER kategori;

-- Copy data dari foto ke gambar
UPDATE berita SET gambar = foto WHERE foto IS NOT NULL AND gambar IS NULL;

-- Update migrations table
INSERT IGNORE INTO migrations (migration, batch) VALUES ('2026_04_30_090000_rename_foto_to_gambar_in_berita_table', (SELECT COALESCE(MAX(batch), 0) + 1 FROM (SELECT MAX(batch) as batch FROM migrations) as t));

