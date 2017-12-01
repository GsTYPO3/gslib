<?php
namespace Gilbertsoft\Lib\Extension;

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
 * Use declarations
 */
use Gilbertsoft\Lib\Extension\ConfiguratorInterface;
use Gilbertsoft\Lib\Utility\Typo3Mode;
use Gilbertsoft\Lib\Utility\Typo3Version;

/**
 * Abstract extension configuration class.
 *
 * Used as base class for the extension configuration. There are various 
 * often used functions available.
 */
abstract class AbstractConfigurator implements ConfiguratorInterface
{
    /**
     * @see Typo3Mode::isBackend()
     */
    protected static function isBackend()
    {
        return Typo3Mode::isBackend();
    }

    /**
     * @see Typo3Mode::isFrontend()
     */
    protected static function isFrontend()
    {
        return Typo3Mode::isFrontend();
    }

    /**
     * @see Typo3Version::isVersion()
     */
    protected static function isVersion($branchNumberStr)
    {
        return Typo3Version::isVersion($branchNumberStr);
    }

    /**
     * @see Typo3Version::isCompatVersion()
     */
    protected static function isCompatVersion($branchNumberStr)
    {
        return Typo3Version::isCompatVersion($branchNumberStr);
    }

    /**
     * Called from ext_localconf.php, to be implemented in derrived classes.
     *
     * @return void
     * @api
     */
    abstract public static function localconf($extKey);

    /**
     * Called from ext_tables.php, to be implemented in derrived classes.
     *
     * @return void
     * @api
     */
    abstract public static function tables($extKey);
}
