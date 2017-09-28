<?php
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

$variable=dirname(__FILE__).'/../../../vendor/vendor/autoload.php';
require_once($variable);

/*
 * Test all major functionality
 * To run, go to CLI, cd to project/vendor/selenium_bins and enter 'java -jar selenium-server-standalone-3.5.3.jar -port 5555 -enablePassThrough false'
 * Then run the test (change URL if needed). If you are using Netbeans, make sure you have the development version, phpunit won't work otherwise.
 * 
 */
class SiteTest extends WebTestCase
{
        protected static $driver;
        protected static $testURL;
        
        public static function setUpBeforeClass() {
            $host = 'http://localhost:5555/wd/hub';
            $capabilities = DesiredCapabilities::firefox();
            self::$driver = RemoteWebDriver::create($host, $capabilities, 5000);
            self::$testURL = 'http://localhost/industrialproject/';
            echo "\nsetUpBeforeClass\n";
        }
        
        protected function setUp() {
            parent::setUp();
            $this->setBrowserUrl($this::$testURL."index.php");
        }

        public function testLoggingIn()
	{
            $this::$driver->get($this::$testURL."index.php");
            $this::$driver->wait()->until(\Facebook\WebDriver\WebDriverExpectedCondition::titleContains("Login"));
            
            //Test no details
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            $em = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username_em_'));
            $this->assertEquals('Username cannot be blank.', $em->getText(), 'Error message did not match expected');
            $em = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Password cannot be blank.', $em->getText(), 'Error message did not match expected');
            $this->assertEquals($this::$testURL."index.php?r=site/login", $this::$driver->getCurrentURL(), 'Login validation error - Should stay on page if incorrect details');
            
            //Test incorrect details
            $lgUser = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->sendKeys("wrongLogin");
            $lgPass->sendKeys("wrongPass");
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            $em = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password_em_'));
            $this->assertEquals('Incorrect username or password.', $em->getText(), 'Error message did not match expected');
            
            $this->assertEquals($this::$testURL."index.php?r=site/login", $this::$driver->getCurrentURL(), 'Login validation error - Should stay on page if incorrect details');
            
            //Test correct details
            $lgUser = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_username'));
            $lgPass = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('LoginForm_password'));
            $lgUser->clear();
            $lgPass->clear();
            $lgUser->sendKeys("admin");
            $lgPass->sendKeys("admin");
            
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $this->assertEquals($this::$testURL."index.php?r=sales/dashboard/admin", $this::$driver->getCurrentURL(), "Redirection failed");
	}
        
        public function testCreateUser() {
            $this::$driver->get($this::$testURL."index.php?r=users/user/create");
            
            $formArray = $this::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className('form-control'));
            
            for ($i=0; $i<count($formArray); $i++) {
                $formArray[$i]->sendKeys("testingUser");
            }
            
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $this->assertStringStartsWith($this::$testURL."index.php?r=users/user/view", $this::$driver->getCurrentURL(), "Redirection failed");
            
            $results = $this::$driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector("td")); 
            for ($i=1; $i<count($results)-2; $i++) {
                $this->assertEquals("testingUser", $results[$i]->getText());
            }
        }
        
        public function testUpdateUser() {
            $this::$driver->get($this::$testURL."index.php?r=users/user/update&id=1");
            
            $pass = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('password'));
            $pass->sendKeys("root");
            
            $phone = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('User_phone'));
            $phone->clear();
            $phone->sendKeys("1234");
            
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::name('yt0'))->click();
            
            $results = $this::$driver->findElements(\Facebook\WebDriver\WebDriverBy::cssSelector("td"));
            
            $this->assertEquals("1234", $results[5]->getText(), "Updated value incorrect");
        }
        
        public function testSaleFilters() {
            $this::$driver->get($this::$testURL."index.php?r=sales/sale/admin");
            
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
                array("filterByUserId", 'dusa-0204', "userid")
                
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
                "Sunday" => 6
            );
            
            //used to make sure no infinite loops happen
            $infLoop = false;
            
            for ($i=0; $i<count($filterElementNameArray); $i++) {
                //stores additional error information
                $em = "";
                
                $correct = true;
                $filter = $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id($filterElementNameArray[$i][0]));
                $valueChosen = null;
                
                if ($i < 6) {
                    //$filter->click();
                    $options = $filter->findElements(\Facebook\WebDriver\WebDriverBy::tagName('option'));
                    $valueChosen = $options[$filterElementNameArray[$i][1]]->getText();
                    $options[$filterElementNameArray[$i][1]]->click();
                } else {
                    $filter->sendKeys($filterElementNameArray[$i][1]);
                }
                
                $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id('searchBtn'))->click();
                
                $tableRecords = $this::$driver->findElements(\Facebook\WebDriver\WebDriverBy::className($filterElementNameArray[$i][2]));
                
                //If no records, unset and try again
                if (!isset($tableRecords) || count($tableRecords) == 0){
                    $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::id("unsetFiltersBtn"))->click();
                    if (!$infLoop) {
                        $infLoop = true;
                        $i--;
                        continue;
                    } else {
                        $this->assertTrue(false, "Make sure each test filter finds at least some records on its own. Check filter: ".$filterElementNameArray[$i][0]);
                    }
                }
                
                $infLoop = false;
                for ($j=0; $j< count($tableRecords); $j++) {
                    switch ($i) {
                        //year
                        case 0:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($dateTime->format('Y') != $valueChosen) {
                                $correct = false;
                                $em .= "Expected year: ".$valueChosen." Failing year: ".$dateTime->format('Y')."\n";
                            }
                        break;
                        //month
                        case 1:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($dateTime->format('F') != $valueChosen) {
                                $correct = false;
                                $em .= "Expected month: ".$valueChosen." Failing month: ".$dateTime->format('F')."\n";
                            }
                        break;
                        //weekday from
                        case 2:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($weekdaysToInt[$dateTime->format('l')][1] < $weekdaysToInt[$valueChosen][1]) {
                                $correct = false;
                                $em .= "Weekday from: ".$valueChosen." Failing weekday: ".$dateTime->format('l')."\n";
                            }
                        break;
                        //weekdays to
                        case 3:
                            $dateTime = DateTime::createFromFormat("Y-m-d G:i:s", $tableRecords[$j]->getText());
                            if ($weekdaysToInt[$dateTime->format('l')][1] > $weekdaysToInt[$valueChosen][1]) {
                                $correct = false;
                                $em .= "Weekday to: ".$valueChosen." Failing weekday: ".$dateTime->format('l')."\n";
                            }
                        break;
                        //outlet/transaction type
                        case 4:
                        case 5:
                            if ($tableRecords[$j]->getText() != $valueChosen) {
                                $correct = false;
                                $em .= "Expected value: ".$valueChosen." Failing value: ".$tableRecords[$j]->getText()."\n";
                            }
                        break;
                        //total from
                        case 6:
                            //remove £ symbol
                            $result = substr($tableRecords[$j]->getText(), -1*(strlen($tableRecords[$j]->getText()) - 2));
                            if (($j + 1) % 3 === 0 && $result < $filterElementNameArray[$i][1]) {
                                $correct = false;
                                $em .= "Total from: ".$filterElementNameArray[$i][1]." Failing value: ".$result."\n";
                            }
                        break;
                        //total to
                        case 7:
                            $result = substr($tableRecords[$j]->getText(), -1*(strlen($tableRecords[$j]->getText()) - 2));
                            if (($j + 1) % 3 === 0 && $result > $filterElementNameArray[$i][1]) {
                                $correct = false;
                                $em .= "Total to: ".$filterElementNameArray[$i][1]." Failing value: ".$result."\n";
                            }
                        break;
                        //userid
                        case 8:
                            if ($tableRecords[$j]->getText() !== $filterElementNameArray[$i][1]) {
                                $correct = false;
                                $em .= "UserID: ".$filterElementNameArray[$i][1]." Failing value: ".$tableRecords[$j]->getText()."\n";
                            }
                    }
                }
                $this->assertTrue($correct, $filterElementNameArray[$i][0]." did not pass: ".$em);
            }
            
        }
        
        public function testGenerateTribe() {
            
        }


        public function testLoggingOut() {
            $this::$driver->findElement(\Facebook\WebDriver\WebDriverBy::className("my-sm-0"))->click();
            $this->assertEquals($this::$testURL."index.php?r=site/login", $this::$driver->getCurrentURL(), 'Not redirected correctly');
            $this::$driver->get($this::$testURL."index.php?r=sales/sale/admin");
            $this->assertEquals($this::$testURL."index.php?r=site/login", $this::$driver->getCurrentURL(), 'Got access after logging out');
        }
        
        public static function tearDownAfterClass() {
            self::$driver->quit();
            echo "\ntearDownAfterClass\n";
        }
}
