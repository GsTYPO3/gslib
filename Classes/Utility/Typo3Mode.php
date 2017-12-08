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
 * Typo3Mode class.
 *
 * USE:
 * The class is intended to be used without creating an instance of it.
 * So: Do not instantiate - call functions with "\Gilbertsoft\TYPO3\Warranty\Utility\Provider::" prefixed the function name.
 * So use \Gilbertsoft\TYPO3\Warranty\Utility\Provider::[method-name] to refer to the functions, eg. '\Gilbertsoft\TYPO3\Warranty\Utility\Provider::getName()'
 */
class Typo3Mode
{
    /**
     * Returns TRUE if mode is set.
     *
     * @return bool
     * @api
     */
    public static function checkMode()
    {
        return defined('TYPO3_MODE');
    }

    /**
     * Returns TRUE if request type is set.
     *
     * @return bool
     * @api
     */
    public static function checkRequestType()
    {
        return defined('TYPO3_REQUESTTYPE');
    }

    /**
     * Returns TRUE if called in frontend mode.
     *
     * @return bool
     * @api
     */
    public static function isFrontend()
    {
        return (self::checkMode() && (TYPO3_MODE == 'FE')) || (self::checkRequestType() && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_FE));
    }

    /**
     * Returns TRUE if called in backend mode.
     *
     * @return bool
     * @api
     */
    public static function isBackend()
    {
        return (self::checkMode() && (TYPO3_MODE == 'BE')) || (self::checkRequestType() && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_BE));
    }

    /**
     * Returns TRUE if called in CLI mode.
     *
     * @return bool
     * @api
     */
    public static function isCli()
    {
        return (defined('TYPO3_cliMode') && TYPO3_cliMode === true) || (self::checkRequestType() && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_CLI));
    }

    /**
     * Returns TRUE if called in ajax mode.
     *
     * @return bool
     * @api
     */
    public static function isAjax()
    {
        return ($GLOBALS['TYPO3_AJAX']) || (self::checkRequestType() && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_AJAX));
    }

    /**
     * Returns TRUE if called in install mode.
     *
     * @return bool
     * @api
     */
    public static function isInstall()
    {
        return (defined('TYPO3_enterInstallScript') && TYPO3_enterInstallScript) || (self::checkRequestType() && (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL));
    }

    /**
     * Returns TRUE if called in composer mode.
     *
     * @return bool
     * @api
     */
    public static function isComposerMode()
    {
        return (defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE);
    }
}
