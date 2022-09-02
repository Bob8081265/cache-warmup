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

namespace EliasHaeussler\CacheWarmup\Tests\Unit\Exception;

use EliasHaeussler\CacheWarmup\Exception;
use EliasHaeussler\CacheWarmup\Sitemap;
use GuzzleHttp\Psr7;
use PHPUnit\Framework;

use function sprintf;

/**
 * InvalidSitemapExceptionTest.
 *
 * @author Elias Häußler <elias@haeussler.dev>
 * @license GPL-3.0-or-later
 */
final class InvalidSitemapExceptionTest extends Framework\TestCase
{
    /**
     * @test
     */
    public function createReturnsExceptionForGivenSitemap(): void
    {
        $sitemap = new Sitemap\Sitemap(new Psr7\Uri('https://www.example.com'));
        $actual = Exception\InvalidSitemapException::create($sitemap);

        self::assertInstanceOf(Exception\InvalidSitemapException::class, $actual);
        self::assertSame(1660668799, $actual->getCode());
        self::assertSame(
            'The sitemap "https://www.example.com" is invalid and cannot be parsed.',
            $actual->getMessage()
        );
    }

    /**
     * @test
     */
    public function forInvalidTypeReturnsExceptionForGivenSitemap(): void
    {
        $actual = Exception\InvalidSitemapException::forInvalidType(null);

        self::assertInstanceOf(Exception\InvalidSitemapException::class, $actual);
        self::assertSame(1604055096, $actual->getCode());
        self::assertSame(
            sprintf('Sitemaps must be of type string or %s, null given.', Sitemap\Sitemap::class),
            $actual->getMessage()
        );
    }
}