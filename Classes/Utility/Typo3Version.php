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
 * Use declarations
 */
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * Utility class to handle version comparings.
 *
 * USE:
 * The class is intended to be used without creating an instance of it.
 * So: Do not instantiate - call functions with "\Gilbertsoft\Lib\Utility\VersionUtility::" prefixed the function name.
 * So use \Gilbertsoft\Lib\Utility\VersionUtility::[method-name] to refer to the functions, eg. '\Gilbertsoft\Lib\Utility\VersionUtility::isVersion()'
 */
class Typo3Version
{
    /**
     * @var integer $version
     */
    private static $version = null;

    /**
     * Returns the TYPO3 version as integer
     *
     * @return integer
     * @api
     */
    protected static function getBranch()
    {
        if (is_null(self::$version)) {
            self::$version = VersionNumberUtility::convertVersionNumberToInteger(TYPO3_branch);
        }
        return self::$version;
    }

    /**
     * Returns TRUE if the current TYPO3 version (or compatibility version) is compatible to the input version
     * Notice that this function compares branches, not versions (4.0.1 would be > 4.0.0 although they use the same compat_version)
     *
     * @param string $branchNumberStr Minimum branch number required (format x.y / e.g. "4.0" NOT "4.0.0"!)
     * @return bool Returns TRUE if this setup is compatible with the provided version number
     * @todo Still needs a function to convert versions to branches
     */
    public static function isVersion($branchNumberStr)
    {
        return (self::getBranch() == VersionNumberUtility::convertVersionNumberToInteger($branchNumberStr));
    }

    /**
     * Returns TRUE if the current TYPO3 version (or compatibility version) is compatible to the input version
     * Notice that this function compares branches, not versions (4.0.1 would be > 4.0.0 although they use the same compat_version)
     *
     * @param string $branchNumberStr Minimum branch number required (format x.y / e.g. "4.0" NOT "4.0.0"!)
     * @return bool Returns TRUE if this setup is compatible with the provided version number
     * @todo Still needs a function to convert versions to branches
     */
    public static function isCompatVersion($branchNumberStr)
    {
        return (self::getBranch() >= VersionNumberUtility::convertVersionNumberToInteger($branchNumberStr));
    }
}
