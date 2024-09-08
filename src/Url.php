<?php

namespace Zerotoprod\Url;

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

    /**
     * Represents the components of a parsed URL.
     * ```
     *  Url::from([
     *      Url::host = 'google.com',
     *      // additional keys
     *  ]);
     *  Url::from(parse_url('google.com'));
     * ```
     *
     * @see     Parsable::parse()
     * @see     https://www.php.net/manual/en/function.parse-url.php
     * @see     https://github.com/zero-to-prod/url
     */
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

    /**
     * Constructs a URL string based on the provided scheme, port, and host.
     *
     * This method will use the URL components (`scheme`, `host`, `port`) from
     * the current instance if they are available. If not, the provided `$scheme`
     * and `$port` parameters will be used instead.
     *
     * @param  string|null  $scheme  The scheme to use (e.g., "http", "https").
     * @param  int|null     $port    The port number to use (e.g., 80, 443).
     *
     * @return string  The constructed URL in the format "{scheme}://{host}:{port}".
     *
     * @see     https://github.com/zero-to-prod/url
     */
    public function toProtocol(string $scheme = null, int $port = null): string
    {
        $scheme = $this->scheme ?? $scheme;
        $port = $this->port ?? $port;
        $host = $this->host ?? $this->path;

        return $scheme.'://'.$host.':'.$port;
    }

    /**
     * Constructs a URL string with the "ssl" scheme and the provided port.
     *
     * This method will generate a URL using the "ssl" scheme, defaulting to port 443.
     * It leverages the `toProtocol` method to construct the full URL.
     *
     * @param  int  $port  The port number to use (defaults to 443).
     *
     * @return string  The constructed SSL URL in the format "ssl://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toSsl(int $port = 443): string
    {
        return $this->toProtocol('ssl', $port);
    }

    /**
     * Constructs a URL string with the "ftp" scheme and the provided port.
     *
     * This method generates a URL using the "ftp" scheme, defaulting to port 21.
     * It leverages the `toProtocol` method to construct the full URL.
     *
     * @param  int  $port  The port number to use for the FTP connection (defaults to 21).
     *
     * @return string  The constructed FTP URL in the format "ftp://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toFtp(int $port = 21): string
    {
        return $this->toProtocol('ftp', $port);
    }

    /**
     * Constructs a URL string with the "ftps" scheme and the provided port.
     *
     * This method generates a URL using the "ftps" (FTP Secure) scheme, defaulting to port 990.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the FTPS connection (defaults to 990).
     *
     * @return string  The constructed FTPS URL in the format "ftps://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toFtps(int $port = 990): string
    {
        return $this->toProtocol('ftps', $port);
    }

    /**
     * Constructs a URL string with the "sftp" scheme and the provided port.
     *
     * This method generates a URL using the "sftp" (SSH File Transfer Protocol) scheme, defaulting to port 22.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the SFTP connection (defaults to 22).
     *
     * @return string  The constructed SFTP URL in the format "sftp://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toSftp(int $port = 22): string
    {
        return $this->toProtocol('sftp', $port);
    }

    /**
     * Constructs a URL string with the "tcp" scheme and the provided port.
     *
     * This method generates a URL using the "tcp" (Transmission Control Protocol) scheme, defaulting to port 80.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the TCP connection (defaults to 80).
     *
     * @return string  The constructed TCP URL in the format "tcp://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toTcp(int $port = 80): string
    {
        return $this->toProtocol('tcp', $port);
    }

    /**
     * Constructs a URL string with the "udp" scheme and the provided port.
     *
     * This method generates a URL using the "udp" (User Datagram Protocol) scheme, defaulting to port 53.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the UDP connection (defaults to 53).
     *
     * @return string  The constructed UDP URL in the format "udp://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toUdp(int $port = 53): string
    {
        return $this->toProtocol('udp', $port);
    }

    public function toTls(int $port = 443): string
    {
        return $this->toProtocol('tls', $port);
    }

    /**
     * Constructs a URL string with the "tls" scheme and the provided port.
     *
     * This method generates a URL using the "tls" (Transport Layer Security) scheme, defaulting to port 443.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the TLS connection (defaults to 443).
     *
     * @return string  The constructed TLS URL in the format "tls://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toWs(int $port = 80): string
    {
        return $this->toProtocol('ws', $port);
    }

    /**
     * Constructs a URL string with the "wss" scheme and the provided port.
     *
     * This method generates a URL using the "wss" (WebSockets Secure) scheme, defaulting to port 443.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the WSS connection (defaults to 443).
     *
     * @return string  The constructed WSS URL in the format "wss://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toWss(int $port = 443): string
    {
        return $this->toProtocol('wss', $port);
    }

    /**
     * Constructs a URL string with the "pop3" scheme and the provided port.
     *
     * This method generates a URL using the "pop3" (Post Office Protocol version 3) scheme, defaulting to port 110.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the POP3 connection (defaults to 110).
     *
     * @return string  The constructed POP3 URL in the format "pop3://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toPop3(int $port = 110): string
    {
        return $this->toProtocol('pop3', $port);
    }

    /**
     * Constructs a URL string with the "imap" scheme and the provided port.
     *
     * This method generates a URL using the "imap" (Internet Message Access Protocol) scheme, defaulting to port 143.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the IMAP connection (defaults to 143).
     *
     * @return string  The constructed IMAP URL in the format "imap://{host}:{port}".
     *
     * @link     self::toProtocol()
     * @see      https://github.com/zero-to-prod/url
     */
    public function toImap(int $port = 143): string
    {
        return $this->toProtocol('imap', $port);
    }

    /**
     * Constructs a URL string with the "smtp" scheme and the provided port.
     *
     * This method generates a URL using the "smtp" (Simple Mail Transfer Protocol) scheme, defaulting to port 25.
     * It uses the `toProtocol` method to create the full URL string.
     *
     * @param  int  $port  The port number to use for the SMTP connection (defaults to 25).
     *
     * @return string  The constructed SMTP URL in the format "smtp://{host}:{port}".
     *
     * @see      self::toProtocol()
     * @link     https://github.com/zero-to-prod/url
     */
    public function toSmtp(int $port = 25): string
    {
        return $this->toProtocol('smtp', $port);
    }
}