<?php

namespace App\Services;

class GradeService
{
    public static function calculateGPA($grade) 
    {
        if ($grade >= 90) return 4.0;
        if ($grade >= 85) return 3.5;
        if ($grade >= 80) return 3.0;
        if ($grade >= 75) return 2.5;
        if ($grade >= 70) return 2.0;
        if ($grade >= 65) return 1.5;
        if ($grade >= 60) return 1.0;
        return 0.0;
    }

    public static function getGradeLetter($grade) 
    {
        if ($grade >= 90) return 'A';
        if ($grade >= 85) return 'B+';
        if ($grade >= 80) return 'B';
        if ($grade >= 75) return 'C+';
        if ($grade >= 70) return 'C';
        if ($grade >= 65) return 'D+';
        if ($grade >= 60) return 'D';
        return 'F';
    }
} 