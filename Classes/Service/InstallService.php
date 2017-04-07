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

namespace Gilbertsoft\Lib\Service;


/**
 * Use declarations
 */
use TYPO3\CMS\Core\Messaging\FlashMessage;


/**
 * GS Install Service class.
 */
class InstallService extends \Gilbertsoft\Lib\Service\AbstractInstallService
{
	/**
	 * Executes the setup tasks if extension is installed.
	 *
	 * @param string $extensionKey Installed extension key
	 */
	public function afterInstall($extensionKey)
	{
		if ($extensionKey == $this->extensionKey)
		{
			// insert custom code here
		}
	}

	/**
	 * Executes the setup tasks if extension is uninstalled.
	 *
	 * @param string $extensionKey Uninstalled extension key
	 */
	public function afterUninstall($extensionKey)
	{
		if ($extensionKey == $this->extensionKey)
		{
			// insert custom code here
		}
	}
}
