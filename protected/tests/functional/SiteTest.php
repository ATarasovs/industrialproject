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
        }
        
        protected function setUp() {
            //parent::setUp();
            $this->setBrowserUrl("http://localhost/industrialproject/index.php");
        }

        public function testLoggingIn()
	{
            SiteTest::$driver->get("http://localhost/industrialproject/index.php");
            SiteTest::$driver->wait()->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains("Login"));
            /*
            //Test no details
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            $em = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username_em_'));
            $this->assertEquals('Username cannot be blank.', $em->getText());
            $em = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Password cannot be blank.', $em->getText());
            
            //Test incorrect details
            $lgUser = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->sendKeys("wrongLogin");
            $lgPass->sendKeys("wrongPass");
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            $em = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Incorrect username or password.', $em->getText());
            */
            //Test correct details
            $lgUser = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->clear();
            $lgPass->clear();
            $lgUser->sendKeys("admin");
            $lgPass->sendKeys("admin");
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            SiteTest::$driver->wait(10)->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains('My Web Application'));
            
            $this->assertEquals('http://localhost/industrialproject/index.php?r=sales/dashboard/admin', SiteTest::$driver->getCurrentURL());
	}
        /*
        public function testCreateUser() {
            SiteTest::$driver->get("http://localhost/industrialproject/index.php?r=users/user/create");
            
            $formArray = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className('form-control'));
            
            for ($i=0; $i<count($formArray); $i++) {
                $formArray[$i]->sendKeys("testing".$i);
            }
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $this->assertStringStartsWith("http://localhost/industrialproject/index.php?r=users/user/view", SiteTest::$driver->getCurrentURL());
        }
        
        public function testUpdateUser() {
            SiteTest::$driver->get("http://localhost/industrialproject/index.php?r=users/user/update&id=1");
            
            $pass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('password'));
            $pass->sendKeys("root");
            
            $phone = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('User_phone'));
            $phone->clear();
            $phone->sendKeys("1234");
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $results = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector("td"));
            
            $this->assertEquals("1234", $results[5]->getText());
        }
        */
        public function testSaleFilters() {
            SiteTest::$driver->get("http://localhost/industrialproject/index.php?r=sales/sale/admin");
            $filterElementNameArray = array(
                "filterByYear"/*,
                "filterByMonth"/*,
                "filterByWeekdayFrom"/*,
                "filterByWeekdayTo"/*,
                "filterByDateFrom"/*,
                "filterByDateTo"/*,
                "filterByTimeFrom"/*,
                "filterByTimeTo"/*,
                "filterByTotalAmountFrom"/*,
                "filterByTotalAmountTo"/*,
                //"filterByRetailerName",
                "filterByOutletName"/*,
                "filterByTransactionType"/*,
                "filterByUserId"*/);
            
            
            for ($i=0; $i<count($filterElementNameArray); $i++) {
                $filter = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id($filterElementNameArray[$i]));
                
                switch ($i) {
                    //year
                    case 0:
                        $filter->click();
                        $options = $filter->findElements(\Facebook\WebDriver\WebDriverBy::tagName('option'));
                        $options[2]->click();
                        break;
                    //month
                    case 1:
                        break;
                    //weekday
                    case 2:
                    case 3:
                        break;
                    //date
                    case 4:
                    case 5:
                        break;
                    //time
                    case 6:
                    case 7:
                        break;
                    default:
                }
                SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('searchBtn'))->click();
                /*
                for ($i=0; $i<10; $i++) {
                    
                }
                */
            }
            
        }
          
        public static function tearDownAfterClass() {
            self::$driver->quit();
            echo "\ntearDownAfterClass\n";
        }
}
