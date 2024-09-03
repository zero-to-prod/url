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
}