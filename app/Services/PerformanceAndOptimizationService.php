<?php

namespace App\Services;

use App\Helpers\NumbersHelper;

class PerformanceAndOptimizationService
{
    /**
     * @param int $start
     * @param int $end
     *
     * @return int
     */
    public function sumOfNumbersPrimes(int $start, int $end): int
    {
        $sum = 0;
        if ($start <= 2) {
            $sum += 2;
            $start = 3;
        } elseif ($start % 2 == 0) {
            $start++;
        }
        for ($i = $start; $i <= $end; $i += 2) {
            if (app(NumbersHelper::class)->isPrime($i)) {
                $sum += $i;
            }
        }
        return $sum;
    }
}
