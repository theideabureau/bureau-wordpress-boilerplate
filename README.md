# The Idea Bureau → WordPress Boilerplate

**Version**: 2.0.1

| Environment | Status |
| :-- | :-- |
| [Production](https://production.example.com) | ❌ |
| [Staging](https://staging.example.com) | ❌ |

---

## Template Tasks

* [ ] Add deployment status badges and environment URLs to `README.md`
* [ ] Add project details to `README.md`
* [ ] Add version number to `README.md`
* [ ] Add project details to `package.json`
* [ ] Add version number to `package.json`
* [ ] Find and replace all instances of 'project-name'
* [ ] Find and replace all instances of 'Project Name'
* [ ] Find and replace all instances of 'theme-name'
* [ ] Replace `resources/img/logo-mark.svg` with project logo
* [ ] Replace all favicons and configurations in `resources/img/favicons/`

## Project dependencies

- PHP 8.1
- [Composer](https://getcomposer.org/download/)
- [Laravel Mix](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#summary)
- [Node 20](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Project guidelines

- [Git-Flow](https://nvie.com/posts/a-successful-git-branching-model/) to be used for git branching
- [PHP PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- `.editorconfig` rules used to maintain coding styles

## Code Quality

### PHP

We use [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to enforce the [PSR12 coding style](https://www.php-fig.org/psr/psr-12/), any PHP code style issues must be resolved before committing. Buddy.works will fail a deployment if code quality checks don't pass.

## Installation and usage

### Front-end

Start by installing all npm dependencies:

```
npm install
```

Laravel Mix provides various commands to compile front-end assets:

```
npm run watch          # watch all files and compile
npm run hot            # watch all files, compile with live reload
npm run development    # compile without minify
npm run production     # compile with minify
```

#### SVG sprites

SVG files within the `/resources/svg` directory will be combined into a single SVG sprite, and can be referenced using the following snippet, where a filename of `icon-twitter.svg` is referenced as:

```
<svg><use xlink:href="#icon-twitter"></use></svg>
```

SVGs used like this can be interacted with JavaScript and styled with CSS.

All SVGs must be optimised before being added to the codebase, tools such as [svgomg](https://jakearchibald.github.io/svgomg/) can be useful for this.

### Back-end

Composer is used for back-end libraries, use the following command to install dependencies.

```
composer install
```

### Lock files

Both npm and composer lock files are to be committed.
