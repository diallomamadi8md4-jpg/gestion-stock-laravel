# 📦 Gestion de Stock – Laravel

Application web de gestion de stock développée avec **Laravel, PHP et PostgreSQL**.

Ce projet a pour objectif de faciliter la gestion et le suivi des stocks à travers une interface web simple et organisée.

## 🛠️ Technologies utilisées

- **Backend :** PHP, Laravel
- **Base de données :** PostgreSQL
- **Frontend :** Blade, HTML, CSS, JavaScript
- **Outils :** Git, GitHub, Composer, Vite

## ✨ Présentation du projet

Cette application permet de centraliser les opérations liées à la gestion des stocks et de faciliter le suivi des produits.

## 📸 Captures d'écran

*Les captures d'écran de l'application seront ajoutées prochainement.*

## ⚙️ Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/diallomamadi8md4-jpg/gestion-stock-laravel.git
```

### 2. Accéder au projet

```bash
cd gestion-stock-laravel
```

### 3. Installer les dépendances

```bash
composer install
npm install
```

### 4. Configurer l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Configurer ensuite les paramètres PostgreSQL dans le fichier `.env` :

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gestion_stock
DB_USERNAME=postgres
DB_PASSWORD=
```

Créer au préalable la base de données PostgreSQL correspondante.

### 5. Exécuter les migrations

```bash
php artisan migrate
```

### 6. Compiler les ressources frontend

```bash
npm run build
```

### 7. Démarrer le serveur

```bash
php artisan serve
```

L'application sera accessible à l'adresse :

`http://127.0.0.1:8000`

## 🔐 Sécurité

Ne jamais publier le fichier `.env`, les mots de passe ou les clés secrètes sur GitHub.

## 👨‍💻 Développeur

Projet personnel réalisé dans le cadre de mes activités de développement web.

**Technologies : Laravel | PHP | PostgreSQL**

## 📂 Dépôt GitHub

https://github.com/diallomamadi8md4-jpg/gestion-stock-laravel
