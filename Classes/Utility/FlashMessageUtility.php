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
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * GS Flash Message Utility class.
 */
class FlashMessageUtility
{
	/**
	 * @var \TYPO3\CMS\Core\Messaging\FlashMessageService
	 */
	protected static $flashMessageService = null;
	/**
	 * Returns the Flash Message Service
	 *
	 * @return \TYPO3\CMS\Core\Messaging\FlashMessageService
	 */
	public static function getFlashMessageService()
	{
		if (self::$flashMessageService === null) {
			// cache the object for performance-reasons
			self::$flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
		}
		return self::$flashMessageService;
	}

	/**
	 * Returns the Flash Message Queue
	 *
	 * @param string $extensionKey
	 * @return \TYPO3\CMS\Core\Messaging\FlashMessageQueue
	 * @throws \InvalidArgumentException
	 */
	public static function getFlashMessageQueue($extensionKey)
	{
		if (!is_string($extensionKey) || empty($extensionKey)) {
			throw new \InvalidArgumentException('$extensionKey must be a non empty string.', 1491502264);
		}
		return self::getFlashMessageService()->getMessageQueueByIdentifier('gslib.flashmessages.' . $extensionKey);
	}

	/**
	 * Adds a Flash Message to the Flash Message Queue
	 *
	 * @param \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage
	 * @param string $extensionKey
	 * @return void
	 */
	public static function addFlashMessageToQueue(FlashMessage $flashMessage, $extensionKey)
	{
		if ($flashMessage) {
			self::getFlashMessageQueue($extensionKey)->enqueue($flashMessage);
		}
	}

	/**
	 * Create a Flash Message and add it to the Queue
	 *
	 * @param string $extensionKey
	 * @param string $message The message.
	 * @param string $title Optional message title.
	 * @param int $severity Optional severity, must be either of one of \TYPO3\CMS\Core\Messaging\FlashMessage constants
	 * @param bool $storeInSession Optional, defines whether the message should be stored in the session or only for one request (default)
	 * @return void
	 */
	public static function showFlashMessage($extensionKey, $message, $title = '', $severity = FlashMessage::OK, $storeInSession = true)
	{
		if (is_string($message) || !empty($message)) {
			self::addFlashMessageToQueue(
				GeneralUtility::makeInstance(
					FlashMessage::class,
					$message,
					$title,
					$severity,
					$storeInSession
				), 
				$extensionKey,
				''
			);
		}
	}
}