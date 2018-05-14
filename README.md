# Laravel Practice Project

The goal was to build a sample Laravel application for practice that manages users and posts, with access roles, all in one weekend.

## Installation

I used sqlite3 during development instead of MySQL firstly as a challenge for myself because I've never used it with a PHP application before, and secondly because I didn't feel like setting up MySQL for a simple project just to get started.

I had the following PHP extensions installed (may or may not be required):

    ext-zip
    ext-mbstring
    ext-xml
    ext-intl
    ext-sqlite3

Run the following commands to set up the project and seed the database:

    cp .env.example .env
    # Configure your .env as appropriate, e.g. for the database, app URL, etc.
    composer install
    php artisan key:generate
    php artisan migrate:fresh --seed

## Functionality

This application follows the following concepts:

### Accounts

- Anybody can register a new account (doesn't confirm email currently)
- Users can edit their own accounts (Top Right > Username > Profile > Edit)
- Admin users can edit and delete any account, change user roles
- Publishers act like regular users for the purposes of accounts
- Anyone can see anyone's profile (if they find a link via posts author links)
- Users can reset their own passwords (sends an email to confirm the reset)
- Seeded users' default password is `secret`

### Addresses

- Currently set to be publicly visible (logged in only), for lack of a better system for it
- Admins can edit anyone's address
- Users can edit their own address (as above)

### Posts

- There's a posts page with a chronological list of all the posts
- Anyone can view posts
- Publishers (and Admins) can create new posts
- Publishers can only edit their own posts
- Admins can edit any post
- Unpublished posts can be found listed on the user's own profile page
- Unpublished posts don't appear in the post index

## Backend API

There is a REST API implemented using Laravel resources, but it's probably currently unusable. I spent time trying to set up Laravel Passport to get the API auth functionality working, but I gave up for lack of time.

I was planning to write the application as an SPA (Single Page App) with Vue.js, but after running into the issues with Laravel Passport and envisioning trouble getting it working around other Laravel quirks (API middleware by default doesn't use sessions, adding session to the API would make it stateful, so that's no good), I decided to cut my losses and just implement the bulk of the application with most of the logic on the backend.

In addition, I thought that Laravel resources would make it harder for me to continue because HTML forms don't support all the HTTP verbs such as `PUT` and `DELETE`. I later learned that it is possible to spoof the verbs in Laravel using a `_method` field in the requests (See https://laravel.com/docs/5.6/controllers#resource-controllers). If I were to go back and spend more time, I'd refactor to properly use resources for both the REST API and admin backend.

## Frontend

As mentioned above, I decided to focus mostly on the backend (MVC aspects) rather than the frontend, so I used very little JS. I did use Bootstrap 4 (default with new Laravel installs) for building the views. I didn't spend much time customizing the theme/layout, to keep things as simple as possible. I wanted to switch to a sidebar nav as is usually ideal in admin panels. There's often too many menus and submenus to fit on the top nav, but it wasn't a problem here because there was only two menus in the end (Users for admins, and Posts for everyone) plus the login widget.

Ideally I would've used Vue.js and used the REST API for implementing all the CRUD logic, using axios for HTTP and vue-router for frontend navigation routing. I've never set up an SPA before (although I understand all the underlying concepts), so I thought that it would be too big a task to learn all that for a weekend project. My experience with Vue.js is mainly with separate dynamic pages that are not linked by Vue routing, updating the view with websockets as the data source and simple AJAX requests.

## Closing Words

I had a fun time doing this, it was a challenge that I didn't really push myself to do in the past, to build a simple web app with a handful of features outside of work hours. It was like a little solo hackathon! :smile: I think this at least proves to myself that I know my way around Laravel and most backend concepts. It also made me realize I still need to spend a lot more time learning SPA concepts, using VueX, Vue-Router, etc.