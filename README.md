# NOVA PRESTIGE — Site vitrine

**Bureau d'études techniques · Conseil industriel · Formation**

## 🚀 Démarrage rapide

```bash
cd nova-prestige/
docker compose up -d          # Démarrer (restart: always)
npm run build                 # Compiler le CSS Tailwind
```

**URLs locales :**
- 🌐 Site : http://localhost:8086
- 🗄️ PhpMyAdmin : http://localhost:8087
- 🔑 Admin : Triple clic sur le logo

## 🔧 Commandes

```bash
npm run dev                                         # CSS watch
npm run build                                       # CSS prod (minifié)
docker compose restart                              # Redémarrer
docker compose logs -f nova_app                     # Logs
docker exec -it nova_app sh                         # Shell PHP
docker exec -it nova_db mariadb -u nova_user -pnova_secret_2024 nova_prestige
```

## 🔑 Admin
- Accès : Triple-clic sur le logo
- Login : `admin` / voir create-admin.php

## 💾 Sauvegarde
```bash
docker exec nova_db mariadb-dump -u root -pnova_root_2024 nova_prestige > backup_$(date +%Y%m%d).sql
```

## 🚢 VPS
Configurer .env puis `composer install --no-dev && npm run build`
