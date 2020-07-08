<?php
// Get today's date, year, month number, and month name
$today = new DateTime();
$this_year = $today->format('Y');
$this_month = $today->format('n');
$month_name = $today->format('F');

// Create a DateTime object for the first day of the current month
$first_day = new DateTime("$this_year-$this_month-01");
// Get the day of the week as a number (Sunday is 0)
$start = $first_day->format('w');

// Calculate the number of days in the month
function getNumDays($month, $year) {
    $has30 = array(4, 6, 9, 11);
    if (in_array($month, $has30)) {
        return 30;
    } elseif ($month == 2) {
        // Leap years are equally divisible by 4
        return ($year % 4) ? 28 : 29;
    } else {
        return 31;
    }
}

// Get the number of days in the current month
$num_days = getNumDays($this_month, $this_year);
// Create an array to adjust the value of $days->getPosition()
// to produce the correct date. The getPosition() method counts
// from 0, but takes the start position of LimitIterator into
// account. If the first day of the month is Sunday, the start
// position is 0, so we add 1. If it's Monday, we add 0. For
// Tuesday add -1, and so on.
$adjustor = array(1, 0, -1, -2, -3, -4, -5);
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
$days = new ArrayIterator($days);
// Loop infinitely through the days of the week
$days = new InfiniteIterator($days);
// Restrict the range by starting on the first day of the month
// and displaying the number of days in the current month.
$days = new LimitIterator($days, $start, $num_days);
foreach ($days as $day) {
    echo $day . ' ' . ($days->getPosition() + $adjustor[$start]) . " $month_name<br>";
}