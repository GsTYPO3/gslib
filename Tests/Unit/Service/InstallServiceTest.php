<?php
namespace Gilbertsoft\Lib\Tests\Unit\Service;

use Gilbertsoft\Lib\Service\InstallService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class InstallServiceTest extends UnitTestCase
{
	/**
	 * @var InstallService
	 */
	protected $installService;

	/**
	 * Returns a new InstallService instance.
	 */
	protected static function createInstallService($extensionKey)
	{
		return $this->installService = GeneralUtility::makeInstance(InstallService::class, $extensionKey);
	}

	protected function setUp()
	{
		$this->installService = self::createInstallService($this->getUniqueId('foobar'));
	}

	/*
	protected function tearDown()
	{
		unset($this->installService);
	}
	*/

	/**
	 * @test
	 */
	public function canBeCreatedWithExtensionKey()
	{
		$this->assertInstanceOf(
			InstallService::class,
			self::createInstallService($this->getUniqueId('foobar'))
		);
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionCode 1491494798
	 */
	public function canNotBeCreatedWithoutExtensionKey()
	{
		self::createInstallService();
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function canNotBeCreatedWithExtensionKeyNull()
	{
		self::createInstallService(null);
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function canNotBeCreatedWithExtensionKeyEmpty()
	{
		self::createInstallService('');
	}

	/**
	 * @test
	 * @expectedException \InvalidArgumentException
	 */
	public function canNotBeCreatedWithExtensionKeyNumeric()
	{
		self::createInstallService(0);
	}

	/**
	 * @test
	 */
	public function showFlashMessage()
	{
		$this->assertNull($this->installService->showFlashMessage('test'));
	}
}
