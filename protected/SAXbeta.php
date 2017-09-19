<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SAXbeta
 *
 * @author jimi
 */
class SAXbeta {
    
    public $recordsHourly = array(
            array (),
            array()
            );
    
    /**
     * Make new array of hourly spending for SAX to work with. Can also be each X hours per value, see segLength for options
     * 
     * @param startDT - the Date_Time object for the beginning of the time period
     * @param days - the number of days the time period covers
     * @param records - the data for the time period, arranged records[student][sale]
     * @param segLength - the number of hours per segment (should be 1, 2, 3, 4, 6, 8, 12 or 24)
     */
    public function getHourly($startDT, $days, $records, $segLength) {
        for ($i=0; $i<$records->count(); $i++) {
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
                    $record += $records[i][j];
                } else {
                    for ($k=0; $k<$dif; $k++) {
                        $recordsHourly[i][counter] = $record;
                        $counter++;
                        //$hour2 = $counter % 24;
                        
                        $record = 0;
                    }
                }
            }
            
            //Fill any values at the end
            for ($counter;$counter<$segments; $counter++) {
                $recordsHourly[i][counter] = 0;
            }
            
        }
        return $recordsHourly;
    }
    
}
