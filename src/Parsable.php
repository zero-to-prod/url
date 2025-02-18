<?php

namespace Zerotoprod\Url;

/**
 * Trait for parsing and validating URL strings.
 *
 * Ensures a URL starts with a supported protocol and parses it into a `Url` object.
 * If the URL lacks a protocol, a default is prepended.
 *
 * Example:
 * ```
 * Url::parse('example.com'); // Returns Url for 'https://example.com'
 * ```
 *
 * @see https://github.com/zero-to-prod/url
 */
trait Parsable
{
    /**
     * Parses a URL string and ensures that it starts with a supported protocol.
     *
     * This method takes a URL as a string and checks if it begins with one of the
     * supported protocols. If the URL does not start with any of the supported
     * protocols, the method will prepend a default protocol to the URL before
     * parsing it. The method then returns a `Url` object created from the parsed URL.
     *
     * Example:
     * ```
     * Url::parse('example.com'); // Defaults to 'https://example.com'
     * Url::parse('example.com', ['http://', 'custom://'], 'custom://');
     * ```
     *
     * @param  string  $url               The URL string to parse. If it does not start with a supported protocol,
     *                                    the default protocol will be prepended.
     *
     * @param  string  $default_protocol  The default protocol to prepend if the URL does not start with
     *                                    list of common protocols will be used. Examples include 'http://',
     *                                    'https://', 'ssl://', 'ftp://', etc.
     *
     * @param  array   $protocols         An optional array of supported protocols. If not provided, a default
     *                                    a supported protocol. Defaults to 'https://'.
     *
     * @return Url An instance of the `Url` class representing the parsed URL.
     *
     * @see  Url
     * @link https://github.com/zero-to-prod/url
     */
    public static function parse(string $url, string $default_protocol = 'https://', array $protocols = []): Url
    {
        $protocols = $protocols === []
            ? [
                'http://',
                'https://',
                'ssl://',
                'ftp://',
                'ftps://',
                'sftp://',
                'smtp://',
                'pop3://',
                'imap://',
                'tcp://',
                'udp://',
                'tls://',
                'gopher://',
                'ws://',
                'wss://',
            ]
            : $protocols;

        $has_protocol = false;

        foreach ($protocols as $protocol) {
            if ($protocol !== '' && strpos($url, $protocol) === 0) {
                $has_protocol = true;
                break;
            }
        }

        return self::from(parse_url($has_protocol ? $url : "$default_protocol$url"));
    }
}
