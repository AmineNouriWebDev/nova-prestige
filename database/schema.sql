-- =============================================================================
-- NOVA PRESTIGE — Base de données MySQL / MariaDB
-- Jeu de caractères : utf8mb4_unicode_ci
-- =============================================================================

CREATE DATABASE IF NOT EXISTS nova_prestige CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nova_prestige;

-- -----------------------------------------------------------------------------
-- 1. Table des contenus éditables (textes, images, enrichis, liens)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS contents (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_key   VARCHAR(60)  NOT NULL,            -- ex: home, global, contact
  field_key  VARCHAR(120) NOT NULL,            -- ex: hero.title
  lang       CHAR(2)      NOT NULL DEFAULT 'fr',
  type       ENUM('text','richtext','image','link') NOT NULL DEFAULT 'text',
  value      MEDIUMTEXT   NOT NULL,            -- texte, ou chemin d'image
  alt        VARCHAR(255) NULL,                -- texte alternatif si image
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_content (page_key, field_key, lang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 2. Table des paramètres globaux (coordonnées, réseaux, expéditeur mail)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS settings (
  k VARCHAR(80) PRIMARY KEY,
  v TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 3. Table des administrateurs
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admin_users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,           -- password_hash(PASSWORD_ARGON2ID)
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 4. Table des tentatives de connexion (anti-bruteforce)
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS login_attempts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip VARBINARY(16) NOT NULL,
  attempted_at DATETIME NOT NULL,
  success TINYINT(1) NOT NULL DEFAULT 0,
  KEY idx_ip_time (ip, attempted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------------------------------
-- 5. Table des demandes de contact et devis
-- -----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS contact_requests (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120),
  company VARCHAR(160),
  email VARCHAR(160),
  phone VARCHAR(40),
  country VARCHAR(60),
  service VARCHAR(80),
  mode VARCHAR(20),                              -- sur site / à distance / à définir
  message TEXT,
  request_type VARCHAR(20),                      -- projet / devis / contact
  ip VARBINARY(16),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
