<?php

declare(strict_types=1);

/*
 * This file is part of the Composer package "eliashaeussler/cache-warmup".
 *
 * Copyright (C) 2022 Elias Häußler <elias@haeussler.dev>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace EliasHaeussler\CacheWarmup\Tests\Unit\Result;

use EliasHaeussler\CacheWarmup\Result;
use EliasHaeussler\CacheWarmup\Sitemap;
use GuzzleHttp\Psr7;
use PHPUnit\Framework;

/**
 * ParserResultTest.
 *
 * @author Elias Häußler <elias@haeussler.dev>
 * @license GPL-3.0-or-later
 */
final class ParserResultTest extends Framework\TestCase
{
    private Result\ParserResult $subject;

    protected function setUp(): void
    {
        $this->subject = new Result\ParserResult();
    }

    /**
     * @test
     */
    public function addAddsSitemapToResult(): void
    {
        $sitemap = new Sitemap(new Psr7\Uri('https://www.example.com'));

        self::assertSame([], $this->subject->getSitemaps());

        $this->subject->add($sitemap);

        self::assertSame([$sitemap], $this->subject->getSitemaps());
    }

    /**
     * @test
     */
    public function addAddsUrlToResult(): void
    {
        $url = new Psr7\Uri('https://www.example.com');

        self::assertSame([], $this->subject->getUrls());

        $this->subject->add($url);

        self::assertSame([$url], $this->subject->getUrls());
    }

    /**
     * @test
     */
    public function addSitemapAddsSitemapToResult(): void
    {
        $sitemap = new Sitemap(new Psr7\Uri('https://www.example.com'));

        self::assertSame([], $this->subject->getSitemaps());

        $this->subject->addSitemap($sitemap);

        self::assertSame([$sitemap], $this->subject->getSitemaps());
    }

    /**
     * @test
     */
    public function addUrlAddsUrlToResult(): void
    {
        $url = new Psr7\Uri('https://www.example.com');

        self::assertSame([], $this->subject->getUrls());

        $this->subject->addUrl($url);

        self::assertSame([$url], $this->subject->getUrls());
    }
}