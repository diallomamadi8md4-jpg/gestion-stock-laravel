# 📦 BAROUELI-TECH — Application de Gestion de Stock

![Laravel](https://img.shields.io/badge/Laravel-Framework-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-4169E1?logo=postgresql)
![GitHub](https://img.shields.io/badge/GitHub-Version%20Control-black?logo=github)

**BAROUELI-TECH** est une application web de gestion commerciale et de gestion de stock développée avec Laravel, PHP et PostgreSQL.

Elle permet de centraliser les opérations commerciales d'un magasin, de gérer les produits, de suivre les stocks, d'effectuer des ventes et de surveiller les approvisionnements.

---

## 📸 Aperçu de l'application

Application disposant d'une interface de gestion avec un menu de navigation permettant d'accéder aux différents modules.

*Les captures d'écran seront ajoutées prochainement.*

---

## 🚀 Fonctionnalités principales

### 1. Gestion des produits
- Consultation de la liste des produits.
- Ajout de nouveaux produits.
- Modification des informations des produits.
- Suppression des produits.
- Organisation des produits par catégories.

### 2. Gestion des stocks
- Consultation de la liste des stocks.
- Ajout de stock.
- Suivi des quantités disponibles.
- Système d'alertes pour les stocks faibles.
- Augmentation des quantités lors des approvisionnements.
- Diminution automatique des quantités après les ventes.

### 3. Point de vente
- Interface dédiée aux opérations de vente.
- Gestion des transactions commerciales.
- Mise à jour des quantités en stock après les ventes.

### 4. Gestion des ventes
- Suivi des ventes.
- Consultation des opérations commerciales.
- Gestion des transactions.

### 5. Gestion des commandes
- Suivi des commandes.
- Consultation des informations relatives aux commandes.

### 6. Gestion des réapprovisionnements
- Suivi des besoins en approvisionnement.
- Gestion des opérations de réapprovisionnement.

### 7. Objectifs commerciaux
- Gestion des objectifs commerciaux.
- Suivi des performances commerciales.

### 8. Activités commerciales
- Suivi des activités commerciales.
- Consultation des opérations réalisées.

---

## 🛠️ Technologies utilisées

| Technologies | Utilisation |
|---|---|
| PHP | Langage backend |
| Laravel | Framework de développement |
| PostgreSQL | Système de gestion de base de données |
| HTML / CSS | Structure et présentation des interfaces |
| JavaScript | Interactivité des interfaces |
| Git | Gestion de versions |
| GitHub | Hébergement du code source |
| Composer | Gestion des dépendances PHP |

---

## ⚙️ Installation et configuration

### Prérequis

Avant de commencer, assurez-vous de disposer de :

- PHP avec les extensions nécessaires à Laravel et PostgreSQL.
- Composer.
- PostgreSQL.
- Node.js et npm si le projet utilise Vite.

### 1. Cloner le dépôt

```bash
git clone https://github.com/diallomamadi8md4-jpg/gestion-stock-laravel.git
```

### 2. Accéder au dossier

```bash
cd gestion-stock-laravel
```

### 3. Installer les dépendances

```bash
composer install
```

Si le projet utilise npm :

```bash
npm install
```

### 4. Configurer le fichier d'environnement

```bash
cp .env.example .env
```

Générer la clé de l'application :

```bash
php artisan key:generate
```

### 5. Configurer PostgreSQL

Créer une base de données PostgreSQL, puis renseigner les informations de connexion dans le fichier `.env` :

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gestion_stock
DB_USERNAME=postgres
DB_PASSWORD=votre_mot_de_passe
```

Remplacer les valeurs par les paramètres de votre installation PostgreSQL.

### 6. Exécuter les migrations

```bash
php artisan migrate
```

Si le projet dispose de seeders nécessaires :

```bash
php artisan db:seed
```

### 7. Compiler les ressources frontend

Si le projet utilise Vite :

```bash
npm run build
```

### 8. Démarrer l'application

```bash
php artisan serve
```

Accéder à l'application depuis votre navigateur :

http://127.0.0.1:8000

---

## 🔐 Sécurité

Quelques précautions importantes :

- Ne jamais publier le fichier `.env`.
- Ne jamais exposer les mots de passe de la base de données.
- Ne jamais partager les clés secrètes de l'application.
- Utiliser le fichier `.env.example` pour documenter la configuration.

---

## 📁 Structure du projet

```text
gestion-stock-laravel/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── vendor/
│
├── artisan
├── composer.json
├── package.json
├── .env.example
└── README.md
```

---

## 🎯 Objectif du projet

Ce projet a été réalisé dans le but de concevoir une solution web permettant de simplifier la gestion quotidienne d'un commerce.

Il met en pratique plusieurs compétences en développement web, notamment :

- Le développement backend avec Laravel et PHP.
- La gestion des bases de données relationnelles avec PostgreSQL.
- La conception d'applications web.
- La gestion des opérations commerciales.
- L'automatisation du suivi des stocks.

---

## 👨‍💻 Développeur

**AHMA DEV**

Développeur web passionné par la conception et le développement de solutions informatiques modernes.

**Compétences :** PHP, Laravel, PostgreSQL, JavaScript, HTML, CSS, Python, Java, C/C++.

---

## 🔗 Liens du projet

- **Dépôt GitHub :** https://github.com/diallomamadi8md4-jpg/gestion-stock-laravel
- **Projet :** BAROUELI-TECH
- **Statut :** Application développée et disponible localement.

---

⭐ Merci de visiter mon projet !

N'hésitez pas à consulter le code source et à découvrir les différentes fonctionnalités de cette application.
