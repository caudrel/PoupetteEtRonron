# PROJET PoupetteEtRonron

## Description

This repository is the last project I developed in 2 weeks time for the most part, during my Wild Code School bootcamp in PHP. I had to do it in parallel to a group project, so I had to manage my time well.

This is a website for a restaurant that allow the owner (and the admin-Role users) to administrate part of its content.
The menu, the users, the FAQ, the subjects of the contact form, and the opening hours are editable.

As this project was part of my evaluation, we all have been asked to do the CRUD manually (vs via Symfony) and not use EasyAdminBundle.
Also, I used this project for my exam "Titre Professionnel : Développeur Web et Web Mobile". 

## Steps

- Clone the repo from GitHub
- Duplicate the `.env` file and rename it `.env.local` and name the database `poupette_et_ronron`
- run the command `composer install`
- run the command `composer require symfony/webpack-encore-bundle`
- run the command `yarn install`
- run the command `composer require gedmo/doctrine-extensions'
- run the command `composer require symfonycasts/verify-email-bundle'
- run the command `npm install @popperjs/core`
- run the command `composer update`
- run the command `php bin/console doctrine:database:create`
- run the command `php bin/console doctrine:migrations:migrate`
- run the command `php bin/console doctrine:fixtures:load`
- run the command `symfony server:start`

to come

## Contributor

- Aurélie Lozach          https://www.linkedin.com/in/aurelielozach/

I coded this desktop and mobile app with PHP 8.2, with Symfony.

It uses some cool vendors/libraries such as Twig and Grumphp.

## Demo on YouTube

to come

## Database

to come

blabla