<?php

namespace Tests\Unit\Url;

use Tests\TestCase;
use Zerotoprod\Url\Url;

class UrlTest extends TestCase
{

    /**
     * @test
     *
     * @dataProvider urls
     */
    public function from(string $input, array $expected): void
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

    public static function urls(): array
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
}