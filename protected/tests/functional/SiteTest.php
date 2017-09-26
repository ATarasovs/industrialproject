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
            
            //(filter_element, test_filter_value, table_element
            $filterElementNameArray = array(
                array("filterByYear", 2, "datetime"),
                array("filterByMonth", 4, "datetime"),
                array("filterByWeekdayFrom", 1, "datetime"),
                array("filterByWeekdayTo", 6, "datetime"),
                array("filterByOutletName", 8, "outletname"),
                array("filterByTransactionType", 3, "transactiontype")/*,
                array("filterByDateFrom", "", "datetime")/*,
                array("filterByDateTo", "", "datetime")/*,
                array("filterByTimeFrom", "", "datetime")/*,
                array("filterByTimeTo", "", "datetime")/*,
                array("filterByTotalAmountFrom", 5, "cashspent")/*,
                array("filterByTotalAmountTo", 10, "cashspent")/*,
                //array("filterByRetailerName", "Dundee Students Association", "retailername"),
                array("filterByUserId", "dusa-5537", "userid")*/
            );
            
            $weekdaysToInt = array(
                "Monday" => 0,
                "Tuesday" => 1,
                "Wednesday" => 2,
                "Thursday" => 3,
                "Friday" => 4,
                "Saturday" => 5,
                "Sunday" => 6,
            );
            
            //used to make sure no infinite loops happen
            $infLoop = false;
            
            for ($i=0; $i<count($filterElementNameArray); $i++) {
                SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id("advancedFiltersBtn"))->click();
                $correct = true;
                $filter = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id($filterElementNameArray[$i][0]));
                $valueChosen = null;
                switch ($i) {
                    //year:
                    case 0:
                    //month:
                    case 1:
                    //weekday from/to:
                    case 2:
                    case 3:
                    //outlet:
                    case 4:
                    //transaction type:
                    case 5:
                        $filter->click();
                        $options = $filter->findElements(\Facebook\WebDriver\WebDriverBy::tagName('option'));
                        $valueChosen = $options[$filterElementNameArray[$i][1]]->getText();
                        $options[$filterElementNameArray[$i][1]]->click();
                        break;
                    //date:
                    case 6:
                    case 7:
                        break;
                    //time:
                    case 8:
                    case 9:
                        break;
                    default:
                }
                SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('searchBtn'))->click();
                
                $tableRecords = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className($filterElementNameArray[$i][2]));
                
                //If too few records, unset and try again
                if (!isset($tableRecords) || count($tableRecords) < 10) {
                    SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id("unsetFiltersBtn"))->click();
                    if (!$infLoop) {
                        $infLoop = true;
                        $i--;
                        continue;
                    } else {
                        throwException("Infinite loop prevented, make sure each filter gets at least ten records on its own!");
                    }
                }
                
                $infLoop = false;
                for ($j=0; $j<10; $j++) {
                    switch ($i) {
                        //year
                        case 0:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($dateTime->format('Y') != $valueChosen) $correct = false;
                            break;
                        //month
                        case 1:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($dateTime->format('F') != $valueChosen) $correct = false;
                            break;
                        //weekday from
                        case 2:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($weekdaysToInt[$dateTime->format('l')][1] < $weekdaysToInt[$valueChosen][1]) $correct = false;
                            break;
                        //weekdays to
                        case 3:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($weekdaysToInt[$dateTime->format('l')][1] > $weekdaysToInt[$valueChosen][1]) $correct = false;
                            break;
                        //outlet/transaction type
                        case 4:
                        case 5:
                            if ($tableRecords[$j]->getText() != $valueChosen) $correct = false;
                        //date
                        case 6:
                        case 7:
                            break;
                        //time
                        case 8:
                        case 9:
                            break;
                        default:
                    }
                }
                $this->assertTrue($correct, $filterElementNameArray[$i][0]." did not pass");
            }
            
        }
          
        public static function tearDownAfterClass() {
            self::$driver->quit();
            echo "\ntearDownAfterClass\n";
        }
}
