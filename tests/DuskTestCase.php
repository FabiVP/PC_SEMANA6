<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\TestFailure; // Import for handling test failures

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        if (! static::runningInSail()) {
            static::startChromeDriver(['--port=9515']);
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
            '--disable-search-engine-choice-screen',
            '--disable-smooth-scrolling',
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--disable-gpu',
                '--headless=new',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? env('DUSK_DRIVER_URL') ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * Capture a screenshot on test failure.
     *
     * @param  \Throwable  $e
     * @return void
     */
    public function onTestFailure(\Throwable $e)
    {
        // Capture the name of the test that failed
        $testName = $this->getTestName($e);

        // Take the screenshot when a test fails with a dynamic name
        $this->browse(function ($browser) use ($testName) {
            $browser->screenshot("failure-tests_browser_{$testName}");
        });

        // You can add custom logging here if needed, such as saving the failure details
    }

    /**
     * Get the test name from the Throwable.
     *
     * @param  \Throwable  $e
     * @return string
     */
    protected function getTestName(\Throwable $e)
    {
        // Extract the test name from the exception
        // You can improve this logic to customize the name based on the exception details
        return strtolower(str_replace(['::', 'Test'], ['_', ''], $e->getFile()));
    }
}


