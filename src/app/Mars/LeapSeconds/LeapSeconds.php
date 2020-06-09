<?php


namespace App\Mars\LeapSeconds;


class LeapSeconds implements LeapSecondsInterface
{
    public function getLeapSecondsSince(string $time): float
    {
        $leapDates = [
            strtotime('2015/06/30 23:59:59'),
            strtotime('2012/06/30 23:59:59'),
            strtotime('2008/12/30 23:59:59'),
            strtotime('2005/12/30 23:59:59'),
            strtotime('1998/12/30 23:59:59'),
            strtotime('1997/06/30 23:59:59'),
            strtotime('1995/12/30 23:59:59'),
            strtotime('1994/06/30 23:59:59'),
            strtotime('1993/06/30 23:59:59'),
            strtotime('1992/06/30 23:59:59'),
            strtotime('1990/12/31 23:59:59'),
            strtotime('1989/12/31 23:59:59'),
            strtotime('1987/12/31 23:59:59'),
            strtotime('1985/06/30 23:59:59'),
            strtotime('1983/06/30 23:59:59'),
            strtotime('1982/06/30 23:59:59'),
            strtotime('1981/06/30 23:59:59'),
            strtotime('1976/12/31 23:59:59'),
            strtotime('1976/12/31 23:59:59'),
            strtotime('1976/12/31 23:59:59'),
            strtotime('1976/12/31 23:59:59'),
            strtotime('1975/12/31 23:59:59'),
            strtotime('1974/12/31 23:59:59'),
            strtotime('1973/12/31 23:59:59'),
            strtotime('1972/12/31 23:59:59'),
            strtotime('1972/06/30 23:59:59'),
        ];

        $unixTime = strtotime($time);

        for ($i = 0; $i < count($leapDates); $i++) {
            if ($unixTime > $leapDates[$i]) {
                $totalOfSeconds = count($leapDates) - $i + 10;

                return $totalOfSeconds + 32.184;
            }
        }

        return 0;
    }
}
