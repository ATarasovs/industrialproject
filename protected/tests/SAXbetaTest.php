<?php
/*
use PHPUnit\Framework\TestCase;

/* 
 * @covers SAXbeta
 */
require(dirname(__FILE__).'/../SAXbeta.php');

class SAXbetaTest extends \PHPUnit\Framework\TestCase
{
    private $sax;
    private $records;
    
    public function getConnection() {
        //implement
    }
    
    public function getDataSet() {
        //implement
    }

    public function setUp() {
        /*$sax = new SAXbeta();
        $records = array(
            array(1.3, 4.6, 0, 0, 17.4, 0, 0, 0, 3.2, 0),
            array(11.1, 0, 0, 0, 6.4, 12.3, 4.5, 0, 0, 8.4)
        );*/
        //parent::setUp();
    }
    /*
    public function testGetSegmentedData() {
        
    }*/
    
    public function testWriteToFiles() {
        $sax = new SAXbeta();
        $records = array(
            array(1.3, 4.6, 0, 0, 17.4, 0, 0, 0, 3.2, 0),
            array(11.1, 0, 0, 0, 6.4, 12.3, 4.5, 0, 0, 8.4)
        );
        $sax->writeToFiles($records);
    }
}
