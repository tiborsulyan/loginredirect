# Login Redirect

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/tiborsulyan/loginredirect.svg)](https://packagist.org/packages/tiborsulyan/loginredirect)

A [Flarum](http://flarum.org) extension. Redirect unauthenticated users to the Flarum login modal on 404 errors

Features:
- Protect user profile pages (`/u/*`)
- Enable direct links to areas requiring authentication (for example `https://your-flarum-forum.com/d/some-protected-discussion`)

Roadmap:
- Add permission to view user profile pages
- Support `/admin` links

### Installation

Install manually with composer:

```sh
composer require tiborsulyan/loginredirect
```

### Updating

```sh
composer update tiborsulyan/loginredirect
php flarum cache:clear
```

### Links

- [Packagist](https://packagist.org/packages/tiborsulyan/loginredirect)
- [Source code on GitHub](https://github.com/tiborsulyan/loginredirect)
- [Report an issue](https://github.com/tiborsulyan/loginredirect/issues)
