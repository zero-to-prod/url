<?php

namespace Tests\Unit\ProtocolHelper;

use Tests\TestCase;
use Zerotoprod\Url\Url;

class ProtocolHelperTest extends TestCase
{

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
    public function overrides_protocol(): void
    {
        $Url = BaseUrl::from(parse_url('ssl://example.com:443'));
        $this->assertEquals('https://example.com:443', $Url->toProtocol('https'));
    }

    /**
     * @test
     *
     * @see Url
     */
    public function overrides_port(): void
    {
        $Url = BaseUrl::from(parse_url('ssl://example.com:443'));
        $this->assertEquals('https://example.com:444', $Url->toProtocol('https', 444));
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