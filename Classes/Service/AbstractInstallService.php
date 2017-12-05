<?php
namespace Gilbertsoft\Lib\Service;

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
use Gilbertsoft\Lib\Utility\FlashMessageUtility;
use Gilbertsoft\Lib\Utility\Typo3Mode;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * GS Abstract Install Service class.
 */
abstract class AbstractInstallService
{
    /**
     * @var string Extension key
     */
    protected $extensionKey;

    /**
     * Called from ext_localconf.php, to be implemented in derrived classes.
     *
     * @param string $extensionKey Extension key
     * @return null | AbstractInstallService Instance of this class
     */
    public static function registerService($extensionKey)
    {
        if (Typo3Mode::isBackend()) {
            $signalSlot = GeneralUtility::makeInstance(static::class, $extensionKey);
            $signalSlotDispatcher = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
            $signalSlotDispatcher->connect(
                \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,
                'afterExtensionInstall',
                $signalSlot,
                'afterInstall'
            );
            $signalSlotDispatcher->connect(
                \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,
                'afterExtensionUninstall',
                $signalSlot,
                'afterUninstall'
            );

            return $signalSlot;
        }

        return null;
    }

    /**
     * Initializes the install service
     *
     * @param string $extensionKey Extension key
     * @throws InvalidArgumentException 
     */
    public function __construct($extensionKey)
    {
        if (!is_string($extensionKey) || empty($extensionKey)) {
            throw new \InvalidArgumentException('$extensionKey must be a non empty string.', 1491494798);
        }

        $this->extensionKey = $extensionKey;
    }

    /**
     * Executes the setup tasks if extension is installed.
     *
     * @param string $extensionKey Installed extension key
     * @return void
     */
    abstract public function afterInstall($extensionKey);

    /**
     * Executes the setup tasks if extension is uninstalled.
     *
     * @param string $extensionKey Uninstalled extension key
     * @return void
     */
    abstract public function afterUninstall($extensionKey);

    /**
     * Create a Flash Message and add it to the Queue
     *
     * @param string $message The message.
     * @param string $title Optional message title.
     * @param int $severity Optional severity, must be either of one of \TYPO3\CMS\Core\Messaging\FlashMessage constants
     * @param bool $storeInSession Optional, defines whether the message should be stored in the session or only for one request (default)
     * @return void
     */
    protected function showFlashMessage($message, $title = '', $severity = FlashMessage::OK, $storeInSession = true)
    {
        return FlashMessageUtility::showFlashMessage($this->extensionKey, $message, $title, $severity, $storeInSession);
    }
}
