# WP API Plugin

A simple API plugin for WordPress.

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install the plugin.

```bash
composer init-project
```

## Requirements
Make sure all dependencies have been installed before moving on:

```
→ WordPress
→ PHP >= 7.1
→ DOM extension
→ CURL extension
→ Composer
→ Node.js
→ npm
```

## PHP Coding Standard
To Test PHP Coding Standard (PHPCS) using a CLI:

```
composer phpcs
```

## PHP Unit Tests
For running PHP Unit tests use a CLI command:

```
vendor/bin/phpunit
```

## JS Coding Standard
To Test JS Coding Standard (JSCS) using a CLI: We use a default WordPress JSCS, but you can modify it in the .eslintrc file.

```
npm run eslint
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)