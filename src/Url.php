<?php

namespace Zerotoprod\Url;

use Zerotoprod\DataModel\DataModel;
use Zerotoprod\DynamicSetter\DynamicSetter;

/**
 * Represents the components of a parsed URL.
 * ```
 *  Url::new()
 *      ->set_host('google.com')
 *      ->set_scheme('https')
 *      ->set_path('/search')
 *      ->set_query('q=openai');
 *
 *  Url::from(parse_url('google.com'));
 * ```
 *
 * @see     Parsable::parse()
 * @see     https://www.php.net/manual/en/function.parse-url.php
 * @see     https://github.com/zero-to-prod/url
 *
 * @method self set_scheme(string|null $scheme)
 * @method self set_host(string|null $host)
 * @method self set_port(int|null $port)
 * @method self set_user(string|null $user)
 * @method self set_pass(string|null $pass)
 * @method self set_path(string|null $path)
 * @method self set_query(string|null $query)
 * @method self set_fragment(string|null $fragment)
 */
class Url
{
    use DynamicSetter;
    use DataModel;
    use ProtocolHelper;

    /**
     * The scheme component of the URL (e.g., "http" or "https").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const scheme = 'scheme';
    /**
     * The host component of the URL (e.g., "www.example.com").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const host = 'host';
    /**
     * The port component of the URL (e.g., "80" or "443").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const port = 'port';
    /**
     * The user component of the URL (e.g., "username" in "username:password@example.com").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const user = 'user';
    /**
     * The password component of the URL (e.g., "password" in "username:password@example.com").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const pass = 'pass';
    /**
     * The path component of the URL (e.g., "/path/to/page").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const path = 'path';
    /**
     * The query component of the URL (e.g., "query=string" in "?query=string").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const query = 'query';
    /**
     * The fragment component of the URL (e.g., "section1" in "#section1").
     *
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public const fragment = 'fragment';

    /**
     * The scheme component of the URL (e.g., "http" or "https").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $scheme;

    /**
     * The host component of the URL (e.g., "www.example.com").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $host;

    /**
     * The port component of the URL (e.g., "80" or "443").
     *
     * @var int|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $port;

    /**
     * The user component of the URL (e.g., "username" in "username:password@example.com").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $user;

    /**
     * The password component of the URL (e.g., "password" in "username:password@example.com").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $pass;

    /**
     * The path component of the URL (e.g., "/path/to/page").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $path;

    /**
     * The query component of the URL (e.g., "query=string" in "?query=string").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $query;

    /**
     * The fragment component of the URL (e.g., "section1" in "#section1").
     *
     * @var string|null
     * @link https://php.net/manual/en/function.parse-url.php
     * @see  https://github.com/zero-to-prod/url
     */
    public $fragment;
}