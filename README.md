# LMS Pro - Library Management System

![LMS Pro Banner](https://socialify.git.ci/shiroonigami23-ui/lms-pro/image?description=1&descriptionEditable=Responsive%20Library%20Management%20System%20for%20institutions%20and%20school%20projects.&font=Raleway&forks=1&issues=1&language=1&name=1&pattern=Floating%20Cogs&stargazers=1&theme=Dark)

![LMS Pro Demo](lms_demo.gif)

## Live URL

`https://sobran.lovestoblog.com/library/User/index.php`

## Overview

LMS Pro is a responsive PHP + MySQL library management system with dedicated user and admin workflows for catalog, issue/return, requests, and monitoring operations.

## Core Features

- Responsive landing experience and dashboard layouts.
- Admin control center with analytics cards, quick actions, tabs, and collapsible sections.
- User and admin authentication with password reset support.
- Catalog management for books, categories, and authors.
- Request and issue tracking with due/late monitoring.
- PWA-ready assets (`manifest` + service worker) for faster repeat visits.
- Config-driven deployment setup for cleaner environment management.

## Tech Stack

- PHP
- MySQL
- Bootstrap 4
- JavaScript

## Project Structure

- `Admin/` - admin portal modules.
- `User/` - user-facing portal modules.
- `config/` - centralized app and database configuration.
- `database/` - SQL patch and optimization scripts.
- `deploy/` - hosting setup checklist.
- `builds/` - APK/EXE wrapper build guidance.

## Deployment (InfinityFree, Subfolder)

Target path: `htdocs/library`

1. Upload project files to `htdocs/library`.
2. Update database values in `config/app.php`.
3. Import `database/library_management_patch.sql` in phpMyAdmin.
4. Open `https://sobran.lovestoblog.com/library/User/index.php`.
5. Run `https://sobran.lovestoblog.com/library/Admin/seed_admin.php` once.
6. Remove `Admin/seed_admin.php` after initialization.

## Hosting Isolation Note

If another project appears when opening `/library/User/index.php`, your hosted files are mixed.

Use this structure exactly:

- `htdocs/library/Admin/...`
- `htdocs/library/User/...`
- `htdocs/library/bootstrap-4.4.1/...`
- `htdocs/library/config/...`
- `htdocs/library/index.php`
- `htdocs/library/.htaccess`

Then clear browser cache and reopen:
`https://sobran.lovestoblog.com/library/`

## Packaging

This project is a hosted web app. Android and Windows distributions are generated as wrappers:

- Android: TWA/Bubblewrap flow.
- Windows: Nativefier/Electron wrapper.

See `builds/README.md` for exact commands.

## License

MIT
