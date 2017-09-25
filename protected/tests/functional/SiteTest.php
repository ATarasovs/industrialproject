<?php
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

$variable=dirname(__FILE__).'/../../../vendor/vendor/autoload.php';
require_once($variable);

class SiteTest extends WebTestCase
{
        protected static $driver;
        
        public static function setUpBeforeClass() {
            $host = 'http://localhost:5555/wd/hub';
            $capabilities = DesiredCapabilities::firefox();
            self::$driver = RemoteWebDriver::create($host, $capabilities, 5000);
            echo "\nsetUpBeforeClass\n";
            /*$driver->get("http://localhost/industrialproject/index.php");
            $driver->wait()->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains("Login"));
            echo "Loaded";
            //$this->testLoggingIn();
            //$this->tearDown();*/
        }
        
        protected function setUp() {
            //parent::setUp();
            $this->setBrowserUrl("http://localhost/industrialproject/index.php");
        }

        public function testLoggingIn()
	{
            SiteTest::$driver->get("http://localhost/industrialproject/index.php");
            SiteTest::$driver->wait()->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains("Login"));
            echo "Loaded";
            
            $lgUser = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->sendKeys("admin");
            $lgPass->sendKeys("admin");
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            SiteTest::$driver->wait(10)->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains('My Web Application'));
            
            $this->assertEquals('My Web Application', SiteTest::$driver->getTitle());
	}
/*
	public function testContact()
	{
		/*$this->open('?r=site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->click("//input[@value='Submit']");
		$this->waitForTextPresent('Body cannot be blank.');* /
	}

	public function testLoginLogout()
	{
		$this->open('');
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (demo)');

		// test login process, including validation
		$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','demo');
		$this->click("//input[@value='Login']");
		$this->waitForTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','demo');
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextNotPresent('Password cannot be blank.');
		$this->assertTextPresent('Logout');

		// test logout process
		$this->assertTextNotPresent('Login');
		$this->clickAndWait('link=Logout (demo)');
		$this->assertTextPresent('Login');
	}*/
        
        public static function tearDownAfterClass() {
            self::$driver->quit();
            echo "\ntearDownAfterClass\n";
        }
}
