<?php

namespace Tests\Unit\Parsable;

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
        $Url = BaseUrl::parse($input);

        $this->assertEquals($expected[Url::scheme], $Url->scheme);
        $this->assertEquals($expected[Url::host], $Url->host);
        $this->assertEquals($expected[Url::port], $Url->port);
        $this->assertEquals($expected[Url::user], $Url->user);
        $this->assertEquals($expected[Url::pass], $Url->pass);
        $this->assertEquals($expected[Url::path], $Url->path);
        $this->assertEquals($expected[Url::query], $Url->query);
        $this->assertEquals($expected[Url::fragment], $Url->fragment);
    }

    public static function urlProvider(): array
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
                    Url::scheme => 'https',
                    Url::host => 'google.com',
                    Url::port => null,
                    Url::user => null,
                    Url::pass => null,
                    Url::path => null,
                    Url::query => null,
                    Url::fragment => null,
                ]
            ],
        ];
    }

    /**
     * @test
     */
    public function parse_with_protocols(): void
    {
        $Url = BaseUrl::parse('example.com', 'https://', ['custom://']);

        $this->assertEquals('https', $Url->scheme);
        $this->assertEquals('example.com', $Url->host);
    }

    /**
     * @test
     */
    public function custom_protocols(): void
    {
        $Url = BaseUrl::parse('custom://example.com', 'https://', ['custom://']);

        $this->assertEquals('custom', $Url->scheme);
        $this->assertEquals('example.com', $Url->host);
    }

    /**
     * @test
     */
    public function parse_with_default_protocol(): void
    {
        $result = BaseUrl::parse('example.com', 'custom://', ['custom://']);

        $this->assertEquals('custom', $result->scheme);
        $this->assertEquals('example.com', $result->host);
    }
}