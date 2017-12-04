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
 * Extension configuration interface.
 *
 * Configuration entry points for extensions, currently from ext_localconf.php and ext_tables.php
 * The class is intended to be used without creating an instance of it.
 * So: Do not instantiate - call functions with "\Gilbertsoft\Warranty\Utility\Adapter::" prefixed the function name.
 * So use \Gilbertsoft\Warranty\Utility\Adapter::[method-name] to refer to the functions, eg. '\Gilbertsoft\Warranty\Utility\Adapter::run($_EXTNAME)'
 */
interface ConfiguratorInterface
{
    /**
     * Called from ext_localconf.php
     *
     * @param string $extensionKey Extension key
     * @return void
     * @api
     */
    public static function localconf($extensionKey);

    /**
     * Called from ext_tables.php
     *
     * @param string $extensionKey Extension key
     * @return void
     * @api
     */
    public static function tables($extensionKey);
}
