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

// Using parse_url()
$url = Url::from(
    parse_url('example.com')
); 
$url->host // 'example.com'


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
