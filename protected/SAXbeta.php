<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SAXbeta
 *
 * @author jimi westerholm
 */
class SAXbeta {
    
    
    /**
     * Make new array of hourly spending for SAX to work with. Can also be each X hours per value, see segLength for options
     * Assumes payments only, since although redemptions and reversals could be handled, treating them as the same kinds of data is not reasonable
     * 
     * @param startDT - the Date_Time object for the beginning of the time period
     * @param days - the number of days the time period covers
     * @param records - the data for the time period, arranged records[student][sale]
     * @param segLength - the number of hours per segment (should be 1, 2, 3, 4, 6, 8, 12 or 24)
     */
    public function getSegmentedData($startDT, $days, $records, $segLength) {
        for ($i=0; $i<$records->count(); $i++) {
            $recordsCon = array(
            array (),
            array()
            );
            
            $hour2 = 0;
            $record = 0;
            $counter = 0;
            $segments = $days * (24 / $segLength);
            $dt2 = $startDT;
            
            
            for ($j=0; $j<$records[$i]->count(); $j++) {
                $dt = $records[$i][$j]->getDate_Time();
                $dif = $dt->diff->$dt2->hours;
                
                
                
                /*
                $hour = $dt->format('H');
                $hour = ($hour - $hour % $segLength) / $segLength; 
                
                $dif = $hour - $hour2;
                */
                
                if ($dif == 0) {
                    $record += $records[$i][$j]->getTotal_Amount();
                } else {
                    for ($k=0; $k<$dif; $k++) {
                        $recordsCon[$i][$counter] = $record;
                        $counter++;
                        //$hour2 = $counter % 24;
                        
                        $record = 0;
                    }
                }
            }
            
            //Fill any values at the end
            for ($counter;$counter<$segments; $counter++) {
                $recordsCon[$i][$counter] = 0;
            }
            
        }
        return $recordsCon;
    }
    
    /**
     * Writes records to files the SAX program can use
     * 
     * @param array[][] $records data to save (segment first)
     */
    public function writeToFiles($records) {
        for ($i=0; $i<count($records); $i++) {
            $file = fopen(dirname(__FILE__).'/'.$i, "w") or die ("Failed to write to file");
            
            for ($j=0; $j<count($records[$i]); $j++) {
                fwrite($file, $records[$i][$j]);
                fwrite($file, "\n");
            }
            
            fclose($file);
        }
    }
    
    /**
     * Runs the SAX program through command line
     * 
     * @param int $count number of files to go through
     * @param int $window window size - should be the same as the length of individual records
     * @param int $paa word size - how many symbols to split the data into
     */
    public function runSAX($count, $window, $paa) {
        $return = array(
            array(),
            array()
        );
        
        for ($i=0; $i<$count; $i++) {
            //exec("java -jar ".dirname(__FILE__)."/vendor/SAX-master/target/jmotif-sax-1.1.3-SNAPSHOT-jar-with-dependencies.jar -d ".dirname(__FILE__)."/".$i." -o ".dirname(__FILE__)."/".$i."out -w ".$window." 1 -a 5 -p ".$paa);
            exec("java -jar ".dirname(__FILE__)."/../vendor/vendor/SAX-master/target/jmotif-sax-1.1.3-SNAPSHOT-jar-with-dependencies.jar -d ".dirname(__FILE__)."/".$i." -o ".dirname(__FILE__)."/".$i."out -w ".$window." 1 -a 20 -p ".$paa, $return[$i]);
        }
        
        return $return;
    }
    
    
    public function readSAXResults($count) {
        $return = array();
        for ($i=0; $i<$count; $i++) {
            $file = fopen(dirname(__FILE__)."/".$i."out", "r") or die ("Failed to open file");
            $return[$i] = fgets($file);
            fclose($file);
        }
        
        return $return;
    
    }

}
