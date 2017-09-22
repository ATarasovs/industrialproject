<?php
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

$variable=dirname(__FILE__).'/../../../vendor/vendor/autoload.php';
require_once($variable);

class SiteTest extends WebTestCase
{
    
        protected function setUp() {
            parent::setUp();
            $host = 'http://localhost:4444/wd/hub';
            $capabilities = DesiredCapabilities::microsoftEdge();
            $driver = RemoteWebDriver::create($host, $capabilities, 5000);
        }
        
        public function testIndex()
	{
            $driver->get("http://localhost");
            // adding cookie
            // close the Firefox
//            $driver->quit();
               // $host = 'http://localhost:4444/wd/hub'; // this is the default
//$capabilities = DesiredCapabilities::firefox();
//                $driver = RemoteWebDriver::create($host, $capabilities, 5000);
// navigate to 'http://www.seleniumhq.org/'
//                $driver->get('http://www.seleniumhq.org/');
                // adding cookie
//                $driver->manage()->deleteAllCookies();

//		$this->open('');
//		$this->assertTextPresent('Welcome');
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
}
