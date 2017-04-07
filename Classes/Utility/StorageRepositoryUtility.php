<?php

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

namespace Gilbertsoft\Lib\Utility;


/**
 * Use declarations
 */
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * GS Storage Repository Utility class.
 */
class StorageRepositoryUtility
{
	/**
	 * @const string Suffix added to storage name
	 */
	const STORAGE_SUFFIX = '/ (auto-created)';

	/**
	 * Creates a local storage if not exists.
	 *
	 * @param string $name Local storage name
	 */
	public static function createLocalStorage($extensionKey, $name, $message = '')
	{
		if (!is_string($extensionKey) || empty($extensionKey)) {
			throw new \InvalidArgumentException('$extensionKey must be a non empty string.', 1491580810);
		}

		/** @var $storage \TYPO3\CMS\Core\Resource\ResourceStorage */
		$storage = self::findStorageRepository($name);

		if ($storage === null)
		{
			// create the directory if missing
			if (!@is_dir(PATH_site . $name . '/')) {
				// If the directory is missing, try to create it
				GeneralUtility::mkdir(PATH_site . $name . '/');
			}

			// create the Resource Storage 
			self::getStorageRepository()->createLocalStorage(
				$name . self::STORAGE_SUFFIX,
				$name,
				'relative',
				'This is the local ' . $name . '/ directory. This storage mount has been created automatically by ' . $extensionKey . '.' . (is_string($message) && !empty($message) ? ' ' . $message : ''),
				false
			);

			// add Flash Message that the repository has been created
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' successfully created.' . (is_string($message) && !empty($message) ? ' ' . $message : ''),
				'Local storage created'
			);
		} else {
			// add Flash Message that the repository exists 
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' was found.' . (is_string($message) && !empty($message) ? ' ' . $message : ''),
				'Local storage found',
				FlashMessage::NOTICE
			);
		}
	}

	/**
	 * Removes a local storage.
	 *
	 * @param string $name Local storage name
	 */
	public static function removeLocalStorage($extensionKey, $name)
	{
		if (!is_string($extensionKey) || empty($extensionKey)) {
			throw new \InvalidArgumentException('$extensionKey must be a non empty string.', 1491580839);
		}

		/** @var $storage \TYPO3\CMS\Core\Resource\ResourceStorage */
		$storage = self::findStorageRepository($name);

		if ($storage !== null) {
			// add Flash Message that the repository must be removed by admin
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' must be removed by an admin from the root line in the backend and web root directory.',
				'Remove local storage',
				FlashMessage::NOTICE
			);
		}
	}

	/**
	 * Searches for a local storage.
	 *
	 * @param string $name Local storage name
	 * @return NULL|\TYPO3\CMS\Core\Resource\ResourceStorage
	 */
	public static function findStorageRepository($name)
	{
		/** @var $storageObjects \TYPO3\CMS\Core\Resource\ResourceStorage[] */
		$storageObjects = self::getStorageRepository()->findAll();

		if (isset($storageObjects)) {
			foreach ($storageObjects as $storage) {
				//if ($storage->getName() == $name . self::STORAGE_SUFFIX) {
				if ($storage->getConfiguration()['basePath'] == $name . '/') {
					return $storage;
				}
			}
		}

		return null;
	}

	/**
	 * Get the storage repository
	 *
	 * @return \TYPO3\CMS\Core\Resource\StorageRepository
	 */
	protected static function getStorageRepository()
	{
		return GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\StorageRepository::class);
	}
}
