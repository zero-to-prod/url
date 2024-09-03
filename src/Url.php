<?php

namespace Zerotoprod\Url;


/**
 * Represents the components of a parsed URL.
 * ```
 *  Url::from([
 *      Url::host = 'google.com',
 *      // additional keys
 *  ]);
 *  Url::from(parse_url('google.com'));
 * ```
 * @see Parsable::parse()
 * @see https://www.php.net/manual/en/function.parse-url.php
 */
class Url
{

    public const scheme = 'scheme';
    public const host = 'host';
    public const port = 'port';
    public const user = 'user';
    public const pass = 'pass';
    public const path = 'path';
    public const query = 'query';
    public const fragment = 'fragment';

    /**
     * The scheme component of the URL (e.g., "http" or "https").
     *
     * @var string|null
     */
    public $scheme;

    /**
     * The host component of the URL (e.g., "www.example.com").
     *
     * @var string|null
     */
    public $host;

    /**
     * The port component of the URL (e.g., "80" or "443").
     *
     * @var int|null
     */
    public $port;

    /**
     * The user component of the URL (e.g., "username" in "username:password@example.com").
     *
     * @var string|null
     */
    public $user;

    /**
     * The password component of the URL (e.g., "password" in "username:password@example.com").
     *
     * @var string|null
     */
    public $pass;

    /**
     * The path component of the URL (e.g., "/path/to/page").
     *
     * @var string|null
     */
    public $path;

    /**
     * The query component of the URL (e.g., "query=string" in "?query=string").
     *
     * @var string|null
     */
    public $query;

    /**
     * The fragment component of the URL (e.g., "section1" in "#section1").
     *
     * @var string|null
     */
    public $fragment;

    public static function from($items = null): self
    {
        $self = new self;
        foreach ($items as $key => $value) {
            if (property_exists($self, $key)) {
                $self->{$key} = $value;
            }
        }

        return $self;
    }
}