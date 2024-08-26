# Zerotoprod URL

A PHP class for representing URL components.

## Installation

You can install the package via Composer:

```bash
composer require zerotoprod/url
```

** Usage
```php
use Zerotoprod\Url\Url;

$url = Url::from(
    parse_url('example.com')
); 

echo $url->host // 'example.com'

// From array 
$url = Url::from(
    [
        Url::scheme => 'https',
        Url::host => 'example.com',
        Url::port => 443,
        Url::path => '/path',
        Url::query => 'key=value',
    ]
);

echo $url->host; // 'example.com'
```
