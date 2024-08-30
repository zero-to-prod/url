# `Zerotoprod\Url`

A PHP class for representing URL components.

## Installation

You can install the package via Composer:

```bash
composer require zerotoprod/url
```

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

## Suggested Traits

### Transformable

The [Transformable](https://github.com/zero-to-prod/transformable) trait provides methods to convert an object’s properties into an array or a JSON
string. This is particularly useful for serializing your data models.

```bash
composer require zerotoprod/transformable
```

#### Usage

To use the `Zerotoprod\Transformable\Transformable` trait in your class, simply include it:

```php
class Url extends \Zerotoprod\Url\Url
{
    use \Zerotoprod\Transformable\Transformable;
}

$Url = Url::from(
    parse_url('example.com')
);

$array = $Url->toArray();
$json = $Url->toJson();
```

### Parsable
The Parsable trait provides a method for parsing a URL string and ensuring that it starts with a supported protocol. This is useful when you want to handle various types of URLs and ensure they conform to a specific format before processing.

#### Installation
The Parsable trait is included within this package, so no additional installation is required.

#### Usage
To use the `Zerotoprod\Url\Parsable` trait in your class, simply include it:

```php
class Url extends \Zerotoprod\Url\Url
{
    use \Zerotoprod\Url\Parsable;
}

$url = Url::parse('example.com'); // Defaults to 'https://example.com'
$urlWithCustomProtocol = Url::parse('example.com', 'custom://', ['http://', 'custom://']);
```