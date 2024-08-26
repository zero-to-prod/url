<?php

namespace Zerotoprod\Url;


/**
 * Class Url
 *
 * Represents the components of a parsed URL.
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
    public ?string $scheme;

    /**
     * The host component of the URL (e.g., "www.example.com").
     *
     * @var string|null
     */
    public ?string $host;

    /**
     * The port component of the URL (e.g., "80" or "443").
     *
     * @var int|null
     */
    public ?int $port;

    /**
     * The user component of the URL (e.g., "username" in "username:password@example.com").
     *
     * @var string|null
     */
    public ?string $user;

    /**
     * The password component of the URL (e.g., "password" in "username:password@example.com").
     *
     * @var string|null
     */
    public ?string $pass;

    /**
     * The path component of the URL (e.g., "/path/to/page").
     *
     * @var string|null
     */
    public ?string $path;

    /**
     * The query component of the URL (e.g., "query=string" in "?query=string").
     *
     * @var string|null
     */
    public ?string $query;

    /**
     * The fragment component of the URL (e.g., "section1" in "#section1").
     *
     * @var string|null
     */
    public ?string $fragment;

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