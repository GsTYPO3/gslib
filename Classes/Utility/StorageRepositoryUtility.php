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
	 * Get the storage repository
	 *
	 * @return \TYPO3\CMS\Core\Resource\StorageRepository
	 */
	public static function getStorageRepository()
	{
		return GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\StorageRepository::class);
	}

	/**
	 * Searches for a local storage.
	 *
	 * @param string $name Local storage name
	 * @return NULL|\TYPO3\CMS\Core\Resource\ResourceStorage
	 */
	public static function findLocalStorage($name)
	{
		/** @var $storageObjects \TYPO3\CMS\Core\Resource\ResourceStorage[] */
		$storageObjects = self::getStorageRepository()->findByStorageType('Local');

		foreach ($storageObjects as $storage) {
			if (isset($storage->getConfiguration()['basePath']) && ($storage->getConfiguration()['basePath'] == rtrim($name, '/') . '/')) {
				return $storage;
			}
		}

		return null;
	}

	/**
	 * Creates a directory in the web root if it is not existing.
	 *
	 * @param string $name Relative path to folder from web root, see PHP mkdir() function. Removes trailing slash internally.
	 * @return bool TRUE if mkdir went well!
	 */
	public static function createDirectoryAtWebRoot($name)
	{
		if (!@is_dir(PATH_site . $name)) {
			return GeneralUtility::mkdir(PATH_site . $name);
		}

		return true;
	}

	/**
	 * Creates a local storage if not exists.
	 *
	 * @param string $name Local storage name
	 * @return NULL|int Uid of the inserted or found record
	 * @throws \InvalidArgumentException
	 */
	public static function createLocalStorage($extensionKey, $name, $message = '')
	{
		if (!is_string($name) || empty($name)) {
			throw new \InvalidArgumentException('$name must be a non empty string.', 1491681665);
		}

		if (self::createDirectoryAtWebRoot($name) !== true) {
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' could not be created!',
				'Local storage not created',
				FlashMessage::WARNING
			);

			return null;
		}

		$message = (is_string($message) && !empty($message) ? ' ' . $message : '');
		/** @var $storage \TYPO3\CMS\Core\Resource\ResourceStorage */
		$storage = self::findLocalStorage($name);

		if ($storage !== null) {
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' was found.' . $message,
				'Local storage found',
				FlashMessage::NOTICE
			);

			return $storage->getUid();
		}

		$uid = self::getStorageRepository()->createLocalStorage(
			$name . self::STORAGE_SUFFIX,
			$name,
			'relative',
			'This is the local ' . $name . '/ directory. This storage mount has been created automatically by ' . $extensionKey . '.' . $message,
			false
		);

		FlashMessageUtility::showFlashMessage(
			$extensionKey,
			'Local storage ' . $name . ' successfully created.' . $message,
			'Local storage created'
		);

		return $uid;
	}

	/**
	 * Removes a local storage.
	 *
	 * @param string $name Local storage name
	 * @return void
	 * @throws \InvalidArgumentException
	 */
	public static function removeLocalStorage($extensionKey, $name)
	{
		if (!is_string($name) || empty($name)) {
			throw new \InvalidArgumentException('$name must be a non empty string.', 1491682406);
		}

		if (self::findLocalStorage($name) !== null) {
			FlashMessageUtility::showFlashMessage(
				$extensionKey,
				'Local storage ' . $name . ' must be removed by an admin from the root line in the backend and web root directory.',
				'Remove local storage',
				FlashMessage::NOTICE
			);
		}
	}
}