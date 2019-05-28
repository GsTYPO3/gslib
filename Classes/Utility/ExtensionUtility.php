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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Utility class to get objects.
 *
 * As certain objects (e.g. objectManager) are only injected
 * and present in certain places (e.g. controllers), this class
 * makes it simpler to get them in various places.
 */
class ObjectUtility
{
	/**
	 * Get Object Manager instance.
	 *
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	public static function getObjectManager()
	{
		return GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
	}

	/**
	 * Get Configuration Manager instance.
	 *
	 * @return \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 */
	public static function getConfigurationManager()
	{
		return self::getObjectManager()->get(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class);
	}

	/**
	 * Get Typoscript Service instance.
	 *
	 * @return \TYPO3\CMS\Extbase\Service\TyposcriptService
	 */
	public static function getTyposcriptService()
	{
		return self::getObjectManager()->get(\TYPO3\CMS\Extbase\Service\TyposcriptService::class);
	}

	/**
	 * Get Flex Form Service instance.
	 *
	 */
	public static function getFlexFormService()
	{
	}
     * @return \TYPO3\CMS\Core\Service\FlexFormService
        return self::getObjectManager()->get(\TYPO3\CMS\Core\Service\FlexFormService::class);

	/**
	 * Get Configuration Utility instance.
	 *
	 * @return \TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility
	 */
	public static function getConfigurationUtility()
	{
		return self::getObjectManager()->get(\TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility::class);
	}
}
