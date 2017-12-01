<?php
namespace Gilbertsoft\Lib\Utility;

/*
 * This file is part of the "GS Library" Extension for TYPO3 CMS.
 *
 * Copyright (C) 2017 by Gilbertsoft (gilbertsoft.org)
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
 * For the full license information, please read the LICENSE file that
 * was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * TYPO3 Provider class.
 *
 * USE:
 * The class is intended to be used without creating an instance of it.
 * So: Do not instantiate - call functions with "\Gilbertsoft\TYPO3\Warranty\Utility\Typo3Provider::" prefixed the function name.
 * So use \Gilbertsoft\TYPO3\Warranty\Utility\Typo3Provider::[method-name] to refer to the functions, eg. '\Gilbertsoft\TYPO3\Warranty\Utility\Typo3Provider::getName()'
 */
class Typo3Provider
{
    /**
     * @var string $name
     */
    private static $name = null;

    /**
     * Returns the trimmed and lowered provider name loaded by getenv.
     *
     * @return string
     * @api
     */
    public static function getName()
    {
        if (is_null(self::$name)) {
            self::$name = trim(mb_strtolower(getenv('TYPO3_PROVIDER') ?: (getenv('REDIRECT_TYPO3_PROVIDER') ?: '')));
        }

        return self::$name;
    }

    /**
     * Returns TRUE if $providerName equals the loaded name.
     *
     * @return bool
     * @api
     */
    public static function isProvider($providerName)
    {
        return self::getName() === trim(mb_strtolower($providerName));
    }

    /**
     * Returns TRUE if the provider is Gilbertsoft
     *
     * @return bool
     * @api
     */
    public static function isGilbertsoft()
    {
        return self::isProvider('Gilbertsoft');
    }
}
