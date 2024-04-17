# Security Policy

This document outlines security procedures and general policies for the Norldverse App

## Reporting a Vulnerability

If you discover a security vulnerability within this project, please send an email to <hseal419@gmail.com>. All security vulnerabilities will be promptly addressed. Please do not disclose publically until a fix has been released.

## Security Practices

### Laravel

Laravel uses hashed and salted passwords which means your password will never be saved as plain text in the database. It also uses prepared SQL statements which make injection attacks unimaginable.

### Vue.js

Vue.js automatically escapes HTML content unless you use the `v-html` directive. Always be cautious when using `v-html` to prevent Cross-Site Scripting (XSS) attacks.

Remember, the best way to ensure the security of your application is to keep all software up to date. This includes both server software and any software your application depends on.
