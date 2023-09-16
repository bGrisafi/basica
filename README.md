# Basica Portfolio

Projet Basica Portfolio pour le cours de projet web.

- Symfony 4
- FOSUserBundle
- EasyAdminBundle
- Vich uploaderBundle

# Changelog

## 2.1.2
- Frontend:
    - Meilleure gestion de la pagination ajax:
        - Désactivation du bouton next sur la dernière page
        - Refactor d'une partie du code js
    - Suppression de la vue 'articles/indexByCatégorie.html.twig', car trop peu différente de la vue 'articles/liste.html.twig'
    - Modification de la vue 'articles/liste.html.twig' pour la rendre utilisable lors de l'affichage du détail d'une catégorie

- Backend:
    - Modification de la geston des dates de création:
        - La date de création est désormais générée à la création
        - Elle n'est pas éditable
    - Gestion d'une erreur à la suppression d'un work
    - Modification des champs affichés dans le listage et le formulaire de création/édition des différentes entités

## 2.1.1
- Frontend
    - Détail d'un tag
    - Gestion de l'affichage des articles et projets rédigés en WYSIWYG

- Backend
    - Gestion d'un problème ou les liaisons n à m ne marchaient que dans un sens pour l'ajout
    - Ajout d'une interface WYSIWYG pour les textes


## 2.1.0
- Frontend
    - Gestion des erreurs du flux RSS
    - Gestion des limits et offsets des différentes routes/vues/requètes Ajax
    - Gestion de la fin de pagination (dernière page) en Ajax

- Backend
    - Ajout de l'upload d'images pour les projets (portfolio) et les articles (blog)
    - Amélioration des formulaires ajout/edition/Liste
    - Ajout d'un lien vers le frontend dans la navigation latérale

- Divers
    - Ajout de traductions statiques

## 2.0.0
**Bakend Fonctionnel**

- Creation du backend
- Login/logout
- Choix des works dans le slider (enVitrine)
- Gestion des erreurs du flux RSS

## 1.0.0
**Partie frontend intégralement fonctionnelle :**

- Détail d'une catégorie
- Projets similaire
- Slider
- Contact
- Flux rss provenant d'un compte Twitter
- Requète ajax pour l'index des projets (portfolio)
- Requète ajax pour la pagination des articles de blog


## 0.5.0
- Page index des portfolio dynamique
- Page index des articles dynamique
- Détail d'un article dynamique
- Sidebar des articles dynamique
- Diverses traduction statique, dont le footer

## 0.4.0
- Menu dynamique avec highlight
- Changement de langue sur la même page
- Seconde zone dynamique du template créée
- Liste des derniers articles dynamique
- Correction de bugs:
    - Erreur dans les liaisons N a M en ORM

## 0.3.0
- Page d'accueil dynamique pour la liste des Works
- Gestion multilingue:
    - Changement de locale par lien
    - Traduction statique dans les fichiers yaml
- Détail des works

## 0.2.0
- Route par défaut créée (mène vers une vue vide, extends base)
- Template ajouté et partials mis en place
- Mise en place des paramètres de locale

## 0.1.0
- Version de départ.
- Entity générées
- FOSUserBundle installé
- EasyAdminBundle installé

***

### Bruno Grisafi - IEPS Fléron - 2019 &copy
