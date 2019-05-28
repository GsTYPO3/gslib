<?php
namespace Gilbertsoft\Lib\Tests\Unit\Service;

use Gilbertsoft\Lib\Tests\Unit\Fixtures\InstallService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class InstallServiceTest extends UnitTestCase
{
    /**
     * @var InstallService
     */
    protected $installService;

    /**
     * @var string Extension key
     */
    protected $extensionKey;

    /**
     * Returns a new InstallService instance.
     */
    protected function createInstallService($extensionKey)
    {
        return $this->installService = GeneralUtility::makeInstance(InstallService::class, $extensionKey);
    }

    protected function setUp()
    {
        $this->extensionKey = $this->getUniqueId('foobar');
        $this->installService = $this->createInstallService($this->extensionKey);
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
            $this->createInstallService($this->getUniqueId('foobar'))
        );
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1491494798
     */
    public function canNotBeCreatedWithExtensionKeyNull()
    {
        $this->createInstallService(null);
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1491494798
     */
    public function canNotBeCreatedWithExtensionKeyEmpty()
    {
        $this->createInstallService('');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionCode 1491494798
     */
    public function canNotBeCreatedWithExtensionKeyNumeric()
    {
        $this->createInstallService(0);
    }

    /**
     * @test
     */
    public function showFlashMessage()
    {
        /*$this->assertNull($this->installService->afterInstall($this->extensionKey));
        $this->assertNull($this->installService->afterUninstall($this->extensionKey));*/
    }
}
