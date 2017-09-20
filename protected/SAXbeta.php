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
            
            
            for ($j=0; $j<$records[i]->count(); $j++) {
                $dt = $records[i][j]->getDate_Time();
                $dif = $dt->diff->$dt2->hours;
                
                
                
                /*
                $hour = $dt->format('H');
                $hour = ($hour - $hour % $segLength) / $segLength; 
                
                $dif = $hour - $hour2;
                */
                
                if ($dif == 0) {
                    $record += $records[i][j].getTotal_Amount();
                } else {
                    for ($k=0; $k<$dif; $k++) {
                        $recordsCon[i][counter] = $record;
                        $counter++;
                        //$hour2 = $counter % 24;
                        
                        $record = 0;
                    }
                }
            }
            
            //Fill any values at the end
            for ($counter;$counter<$segments; $counter++) {
                $recordsCon[i][counter] = 0;
            }
            
        }
        return $recordsCon;
    }
    
    public function writeToFiles($records) {
        for ($i=0; $i<count($records); $i++) {
            $file = fopen($i, "w");
            
            for ($j=0; $j<count($records[$i]); $j++) {
                fwrite($file, $records[$i][$j]);
                fwrite($file, "\n");
            }
            
            fclose($file);
        }
    }
    
    public function runSAX() {
        
    }
    
    public function readSAXResults() {
        /*
        $finished = false;
        while (!$finished) {
            try {
                
            } catch (Exception $ex) {

            }
            
            for ($j=0; $j<$records[i]->count(); $j++) {
                //Sanitise input, 
            }
            
            fclose($file);
        }*/
    }

}
