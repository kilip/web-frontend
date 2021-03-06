<?php
declare(strict_types=1);

namespace PhpList\WebFrontend\Tests\Integration\Composer;

use PHPUnit\Framework\TestCase;

/**
 * Testcase.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class ScriptsTest extends TestCase
{
    /**
     * @test
     */
    public function webDirectoryHasBeenCreated()
    {
        static::assertDirectoryExists($this->getAbsoluteWebDirectoryPath());
    }

    /**
     * @return string
     */
    private function getAbsoluteWebDirectoryPath(): string
    {
        return dirname(__DIR__, 3) . '/web/';
    }

    /**
     * @return string[][]
     */
    public function webDirectoryFilesDataProvider(): array
    {
        return [
            'production entry point' => ['app.php'],
            'development entry point' => ['app_dev.php'],
            'testing entry point' => ['app_test.php'],
            '.htaccess' => ['.htaccess'],
        ];
    }

    /**
     * @test
     * @param string $fileName
     * @dataProvider webDirectoryFilesDataProvider
     */
    public function webDirectoryFilesExist(string $fileName)
    {
        static::assertFileExists($this->getAbsoluteWebDirectoryPath() . $fileName);
    }

    /**
     * @test
     */
    public function binariesDirectoryHasBeenCreated()
    {
        static::assertDirectoryExists($this->getAbsoluteBinariesDirectoryPath());
    }

    /**
     * @return string
     */
    private function getAbsoluteBinariesDirectoryPath(): string
    {
        return dirname(__DIR__, 3) . '/bin/';
    }

    /**
     * @return string[][]
     */
    public function binariesDataProvider(): array
    {
        return [
            'Symfony console' => ['console'],
        ];
    }

    /**
     * @test
     * @param string $fileName
     * @dataProvider binariesDataProvider
     */
    public function binariesExist(string $fileName)
    {
        static::assertFileExists($this->getAbsoluteBinariesDirectoryPath() . $fileName);
    }

    /**
     * @return string
     */
    private function getBundleConfigurationFilePath(): string
    {
        return dirname(__DIR__, 3) . '/Configuration/bundles.yml';
    }

    /**
     * @test
     */
    public function bundleConfigurationFileExists()
    {
        static::assertFileExists($this->getBundleConfigurationFilePath());
    }

    /**
     * @return string[][]
     */
    public function bundleClassNameDataProvider(): array
    {
        return [
            'framework bundle' => ['Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle'],
        ];
    }

    /**
     * @test
     * @param string $bundleClassName
     * @dataProvider bundleClassNameDataProvider
     */
    public function bundleConfigurationFileContainsModuleBundles(string $bundleClassName)
    {
        $fileContents = file_get_contents($this->getBundleConfigurationFilePath());

        static::assertContains($bundleClassName, $fileContents);
    }

    /**
     * @return string
     */
    private function getModuleRoutesConfigurationFilePath(): string
    {
        return dirname(__DIR__, 3) . '/Configuration/routing_modules.yml';
    }

    /**
     * @test
     */
    public function moduleRoutesConfigurationFileExists()
    {
        static::assertFileExists($this->getModuleRoutesConfigurationFilePath());
    }

    /**
     * @test
     */
    public function parametersConfigurationFileExists()
    {
        static::assertFileExists(dirname(__DIR__, 3) . '/Configuration/parameters.yml');
    }

    /**
     * @test
     */
    public function modulesConfigurationFileExists()
    {
        static::assertFileExists(dirname(__DIR__, 3) . '/Configuration/config_modules.yml');
    }
}
