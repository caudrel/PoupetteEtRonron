# PROJET PoupetteEtRonron

## Description

This repository is the last project I developed in 2 weeks time for the most part, during my Wild Code School bootcamp in PHP. I had to do it in parallel to a group project, so I had to manage my time well.

This is a website for a restaurant that allow the owner (and the admin-Role users) to administrate part of its content.
The menu, the users, the FAQ, the subjects of the contact form, and the opening hours are editable.

As this project was part of my evaluation, we all have been asked to do the CRUD manually (vs via Symfony) and not use EasyAdminBundle.
Also, I used this project for my exam "Titre Professionnel : Développeur Web et Web Mobile". 

## Steps

- Clone the repo from GitHub
- Duplicate the `.env` file and rename it `.env.local` and name the database as you like (add a sdn for the test environment)
- run the command `composer install`
- run the command `yarn install`
- run the command `yarn encore dev`
- run the command `php bin/console doctrine:database:create`
- run the command `php bin/console make:migration`
- run the command `php bin/console doctrine:migrations:migrate`
- run the command `php bin/console doctrine:fixtures:load`
- run the command `symfony server:start`
- Run `yarn run dev --watch` to compile assets when needed


## Accessing the administration part
- login as admin : admin@poupetteetronron.com
- password : Password41#
- url : /login

## Author

- Aurélie Lozach          https://www.linkedin.com/in/aurelielozach/

I coded this desktop and mobile app with PHP 8.2, with Symfony.

## Demo on YouTube

to come

## Database schema

https://app.diagrams.net/#G1i2gdS42nB3vc_iYVMWac88OfoPDkSx-g