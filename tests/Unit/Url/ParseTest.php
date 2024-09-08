<?php

namespace Tests\Unit\Url;

use Tests\TestCase;
use Zerotoprod\Url\Url;

class ParseTest extends TestCase
{

    /**
     * @test
     *
     * @dataProvider urlProvider
     */
    public function parse(string $input, array $expected): void
    {
        $Url = BaseUrl::from(parse_url($input));

        $this->assertEquals($expected[Url::scheme], $Url->scheme);
        $this->assertEquals($expected[Url::host], $Url->host);
        $this->assertEquals($expected[Url::port], $Url->port);
        $this->assertEquals($expected[Url::user], $Url->user);
        $this->assertEquals($expected[Url::pass], $Url->pass);
        $this->assertEquals($expected[Url::path], $Url->path);
        $this->assertEquals($expected[Url::query], $Url->query);
        $this->assertEquals($expected[Url::fragment], $Url->fragment);
    }

    public function urlProvider(): array
    {
        return [
            [
                'https://user:pass@host.com:443/path?query#fragment',
                [
                    Url::scheme => 'https',
                    Url::host => 'host.com',
                    Url::port => 443,
                    Url::user => 'user',
                    Url::pass => 'pass',
                    Url::path => '/path',
                    Url::query => 'query',
                    Url::fragment => 'fragment',
                ]
            ],
            [
                'google.com',
                [
                    Url::scheme => null,
                    Url::host => null,
                    Url::port => null,
                    Url::user => null,
                    Url::pass => null,
                    Url::path => 'google.com',
                    Url::query => null,
                    Url::fragment => null,
                ]
            ],
        ];
    }

    /**
     * @test
     */
    public function fluent(): void
    {
        $url = parse_url('https://user:pass@host.com:443/path?query#fragment');
        $Url = BaseUrl::new()
            ->set_scheme($url['scheme'])
            ->set_host($url['host'])
            ->set_port($url['port'])
            ->set_user($url['user'])
            ->set_pass($url['pass'])
            ->set_path($url['path'])
            ->set_query($url['query'])
            ->set_fragment($url['fragment']);

        $this->assertEquals($url[Url::scheme], $Url->scheme);
        $this->assertEquals($url[Url::host], $Url->host);
        $this->assertEquals($url[Url::port], $Url->port);
        $this->assertEquals($url[Url::user], $Url->user);
        $this->assertEquals($url[Url::pass], $Url->pass);
        $this->assertEquals($url[Url::path], $Url->path);
        $this->assertEquals($url[Url::query], $Url->query);
        $this->assertEquals($url[Url::fragment], $Url->fragment);
    }

    /**
     * @test
     *
     * @see Url
     */
    public function to_protocol(): void
    {
        $Url = BaseUrl::from(parse_url('example.com'));
        $this->assertEquals('ssl://example.com:443', $Url->toProtocol('ssl', 443));
    }

    /**
     * @test
     *
     * @see Url
     */
    public function to_protocol_with_custom_port(): void
    {
        $Url = BaseUrl::from(parse_url('example.com'));
        $this->assertEquals('ssl://example.com:444', $Url->toProtocol('ssl', 444));
    }

    /**
     * @test
     *
     * @see Url
     */
    public function to_protocol_from_uri(): void
    {
        $Url = BaseUrl::from(parse_url('ssl://example.com:443'));
        $this->assertEquals('ssl://example.com:443', $Url->toProtocol());
    }

    /**
     * @test
     *
     * @see Url
     */
    public function to_protocol_from_uri_with_custom_port(): void
    {
        $Url = BaseUrl::from(parse_url('ssl://example.com:444'));
        $this->assertEquals('ssl://example.com:444', $Url->toProtocol());
    }

    /**
     * @test
     *
     * @see Url
     */
    public function toSsl(): void
    {
        $Url = BaseUrl::from(parse_url('example.com'));
        $this->assertEquals('ssl://example.com:443', $Url->toSsl('443'));
    }
}