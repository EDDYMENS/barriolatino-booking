<?php

if(!function_exists('build_calendar')) {
    function build_calendar($month,$year, $calData) {

        // Create array containing abbreviations of days of week.
        $daysOfWeek = array('SUN', 'MON','TUE','WED','THU','FRI','SAT');
   
        // What is the first day of the month in question?
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
   
        // How many days does this month contain?
        $numberDays = date('t',$firstDayOfMonth);
   
        // Retrieve some information about the first day of the
        // month in question.
        $dateComponents = getdate($firstDayOfMonth);
   
        // What is the name of the month in question?
        $monthName = $dateComponents['month'];
   
        // What is the index value (0-6) of the first day of the
        // month in question.
        $dayOfWeek = $dateComponents['wday'];
   
        // Create the table tag opener and day headers
   
        $calendar = "<span class='calendar-title center-text'>$monthName $year</span>";
        $calendar .= "<table class='table calendar'>";
        $calendar .= "<tr>";
   
        // Create the calendar headers
   
        foreach($daysOfWeek as $day) {
             $calendar .= "<th class='header'>$day</th>";
        } 
   
        // Create the rest of the calendar
   
        // Initiate the day counter, starting with the 1st.
   
        $currentDay = 1;
   
        $calendar .= "</tr><tr>";
   
        // The variable $dayOfWeek is used to
        // ensure that the calendar
        // display consists of exactly 7 columns.
   
        if ($dayOfWeek > 0) { 
             $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
        }
        
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
     
        while ($currentDay <= $numberDays) {
   
             // Seventh column (Saturday) reached. Start a new row.
   
             if ($dayOfWeek == 7) {
   
                  $dayOfWeek = 0;
                  $calendar .= "</tr><tr>";
   
             }
             
             $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
             
             $date = "$year-$month-$currentDayRel";
             $isAvailable = isset($calData['availableSlots'][$currentDay]);
             $slotState = ($isAvailable) ? 'active-slot' : 'inactive';
             $openReserveModal = ($isAvailable) ? "onclick='openModal($currentDay)'" : '';
             $calendar .= "<td class='day $slotState text-center' rel='$date' $openReserveModal>$currentDay</td>";
   
             // Increment counters
    
             $currentDay++;
             $dayOfWeek++;
   
        }
        
        
   
        // Complete the row of the last week in month, if necessary
   
        if ($dayOfWeek != 7) { 
        
             $remainingDays = 7 - $dayOfWeek;
             $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 
   
        }
        
        $calendar .= "</tr>";
   
        $calendar .= "</table>";
   
        return $calendar;
   
   }
}

if(!function_exists('sortSlots')) {
    function sortSlots($rawSorts) {
        $sortedSlots = [];
            foreach($rawSorts as $eachRawSort) {
                $day = (int)explode('-',$eachRawSort->date)[2];
                $sortedSlots[$day][] = $eachRawSort->time;
            }
        return $sortedSlots;
    }
}