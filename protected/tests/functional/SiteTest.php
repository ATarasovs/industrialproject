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
            $this->assertEquals('Username cannot be blank.', $em->getText(), 'Error message did not match expected');
            $em = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Password cannot be blank.', $em->getText(), 'Error message did not match expected');
            $this->assertNotEquals('http://localhost/industrialproject/index.php?r=sales/dashboard/admin', SiteTest::$driver->getCurrentURL(), 'Login validation error - Got access despite no login information given');
            
            //Test incorrect details
            $lgUser = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->sendKeys("wrongLogin");
            $lgPass->sendKeys("wrongPass");
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            $em = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Incorrect username or password.', $em->getText(), 'Error message did not match expected');
            
            $this->assertNotEquals('http://localhost/industrialproject/index.php?r=sales/dashboard/admin', SiteTest::$driver->getCurrentURL(), 'Login validation error - Got access despite wrong details given');
            */
            //Test correct details
            $lgUser = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->clear();
            $lgPass->clear();
            $lgUser->sendKeys("admin");
            $lgPass->sendKeys("admin");
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $this->assertEquals('http://localhost/industrialproject/index.php?r=sales/dashboard/admin', SiteTest::$driver->getCurrentURL(), "Redirection failed");
	}
        /*
        public function testCreateUser() {
            SiteTest::$driver->get("http://localhost/industrialproject/index.php?r=users/user/create");
            
            $formArray = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className('form-control'));
            
            for ($i=0; $i<count($formArray); $i++) {
                $formArray[$i]->sendKeys("testing".$i);
            }
            
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $this->assertStringStartsWith("http://localhost/industrialproject/index.php?r=users/user/view", SiteTest::$driver->getCurrentURL(), "Redirection failed");
            
            $results = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector("td")); 
            $this->assertEquals("1234", $results[5]->getText());
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
            
            //(filter_element, test_filter_value_or_index, table_element
            $filterElementNameArray = array(
                array("filterByYear", 2, "datetime"),
                array("filterByMonth", 4, "datetime"),
                array("filterByWeekdayFrom", 1, "datetime"),
                array("filterByWeekdayTo", 6, "datetime"),
                array("filterByOutletName", 8, "outletname"),
                array("filterByTransactionType", 3, "transactiontype"),
                array("filterByTotalAmountFrom", 5, "cashspent"),
                array("filterByTotalAmountTo", 10, "cashspent"),
                array("filterByUserId", "dusa-5537", "userid")
                
                /*array("filterByDateFrom", "", "datetime"),
                array("filterByDateTo", "", "datetime"),
                array("filterByTimeFrom", "", "datetime"),
                array("filterByTimeTo", "", "datetime"),
                array("filterByRetailerName", "Dundee Students Association", "retailername")*/
                
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
            
            for ($i=6; $i<count($filterElementNameArray); $i++) {
                $correct = true;
                $filter = SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id($filterElementNameArray[$i][0]));
                $valueChosen = null;
                
                if ($i < 6) {
                    $filter->click();
                    $options = $filter->findElements(\Facebook\WebDriver\WebDriverBy::tagName('option'));
                    $valueChosen = $options[$filterElementNameArray[$i][1]]->getText();
                    $options[$filterElementNameArray[$i][1]]->click();
                } else {
                    $filter->sendKeys($filterElementNameArray[$i][1]);
                }
                
                SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('searchBtn'))->click();
                
                $tableRecords = SiteTest::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className($filterElementNameArray[$i][2]));
                
                //If too few records, unset and try again
                if (!isset($tableRecords) || count($tableRecords) == 0){
                    SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id("unsetFiltersBtn"))->click();
                    if (!$infLoop) {
                        $infLoop = true;
                        $i--;
                        continue;
                    } else {
                        echo "Infinite loop prevented, make sure each test filter finds at least ten records on its own! Check filter: ";
                        echo $filterElementNameArray[$i][0];
                        return;
                    }
                }
                
                $infLoop = false;
                for ($j=0; $j< count($tableRecords); $j++) {
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
                            break;
                        case 6:
                            //if ($tableRecords[2 + ($j*3)]->getText() < $filterElementNameArray[$i][1]) $correct = false;
                            echo "(tableRecords[2 + (j*3)]->getText():\n".$tableRecords[2 + ($j*3)]->getText();
                            echo "(tableRecords[j]->getText():\n".$tableRecords[$j]->getText();
                            echo "(tableRecords[j*3]->getText():\n".$tableRecords[$j*3]->getText();
                            break;
                        case 7:
                            //if ($tableRecords[2 + ($j*3)]->getText() > $filterElementNameArray[$i][1]) $correct = false;
                            break;
                        case 8:
                            if ($tableRecords[$j]->getText() == $filterElementNameArray[$i][1]) $correct = false;
                    }
                }
                $this->assertTrue($correct, $filterElementNameArray[$i][0]." did not pass");
            }
            
        }
        
        public function testLoggingOut() {
            SiteTest::$driver->findElement(\Facebook\WebDriver\WebDriverBy::className('btn btn-outline-danger my-2 my-sm-0'))->click();
            SiteTest::$driver->get("http://localhost/industrialproject/index.php?r=sales/sale/admin");
        }
        
        public static function tearDownAfterClass() {
            self::$driver->quit();
            echo "\ntearDownAfterClass\n";
        }
}
