# Zerotoprod\Url

![](./art/logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/url)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/url/test.yml?label=test)](https://github.com/zero-to-prod/url/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/url/backwards_compatibility.yml?label=backwards_compatibility)](https://github.com/zero-to-prod/url/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/url?color=blue)](https://packagist.org/packages/zero-to-prod/url/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/url?color=f28d1a)](https://packagist.org/packages/zero-to-prod/url)
[![GitHub repo size](https://img.shields.io/github/repo-size/zero-to-prod/url)](https://github.com/zero-to-prod/url)
[![License](https://img.shields.io/packagist/l/zero-to-prod/url?color=red)](https://github.com/zero-to-prod/url/blob/main/LICENSE.md)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/url?branch=master)](https://hitsofcode.com/github/zero-to-prod/url/view?branch=master)

## Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
    - [Helper Methods](#helper-methods)
- [Suggested Traits](#suggested-traits)
- [Local Development](./LOCAL_DEVELOPMENT.md)
- [Contributing](#contributing)

## Introduction

Parse and access url components with a class.

## Requirements

- PHP 7.1 or higher.

## Installation

Install `Zerotoprod\Url` via [Composer](https://getcomposer.org/):

```bash
composer require zero-to-prod/url
```

This will add the package to your project’s dependencies and create an autoloader entry for it.

## Usage

Use the `from()` static method to map array keys to class properties.

It is recommended to extend your own Url class with the `\Zerotoprod\Url\Url` class.

```php
class Url extends \Zerotoprod\Url\Url
{
}

$url = Url::from(
    parse_url('example.com')
); 

$url->host // 'example.com'

// Passing an array 
$url = Url::new()
        ->set_host('example.com')
        ->set_scheme('https')
        ->set_path('/search')
        ->set_query('q=openai');

$url->host; // 'example.com'
```

### Helper Methods

The `Url` class includes several helper methods for constructing URLs with specific schemes and ports.

```php
<?php

use Zerotoprod\Url\Url;

// Create a new URL instance and set the host
$url = Url::new()->set_host('example.com');

// Using the toProtocol method with custom schemes and ports
echo $url->toProtocol('http');  // Outputs: "http://example.com:8080"
echo $url->toProtocol('https', 8081);  // Outputs: "https://example.com:8081"


// Using different helper methods to generate URLs for various schemes
echo $url->toSsl();      // Outputs: "ssl://example.com:443"
echo $url->toFtp();      // Outputs: "ftp://example.com:21"
echo $url->toFtps();     // Outputs: "ftps://example.com:990"
echo $url->toSftp();     // Outputs: "sftp://example.com:22"
echo $url->toTcp();      // Outputs: "tcp://example.com:80"
echo $url->toUdp();      // Outputs: "udp://example.com:53"
echo $url->toTls();      // Outputs: "tls://example.com:443"
echo $url->toWs();       // Outputs: "ws://example.com:80"
echo $url->toWss();      // Outputs: "wss://example.com:443"
echo $url->toPop3();     // Outputs: "pop3://example.com:110"
echo $url->toImap();     // Outputs: "imap://example.com:143"
echo $url->toSmtp();     // Outputs: "smtp://example.com:25"

// Optionally, you can pass a custom port to any of these methods
echo $url->toSsl(8443);  // Outputs: "ssl://example.com:8443"
echo $url->toFtp(2121);  // Outputs: "ftp://example.com:2121"
```

## Suggested Traits

### Parsable

The Parsable trait provides a method for parsing a URL string and ensuring that it starts with a supported protocol. This is useful when you want to
handle various types of URLs and ensure they conform to a specific format before processing.

#### Installation

The Parsable trait is included within this package, so no additional installation is required.

#### Usage

To use the `Zerotoprod\Url\Parsable` trait in your class, simply include it:

```php
class Url extends \Zerotoprod\Url\Url
{
    use \Zerotoprod\Url\Parsable;
}

Url::parse('example.com'); // Defaults to 'https://example.com'
Url::parse('example.com', 'custom://', ['http://', 'custom://']);
```

## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues](https://github.com/zero-to-prod/url/issues) page if you want to contribute.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.
