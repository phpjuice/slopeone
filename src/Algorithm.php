<?php

namespace PHPJuice\Slopeone;

use PHPJuice\Slopeone\Contracts\Slopeone;

class Algorithm implements Slopeone
{
    /**
     * Differential rating matrix.
     *
     * @var array
     */
    protected array $diffs;

    /**
     * Ratings count matrix.
     * @var array
     */
    protected array $freqs;

    /** @inheritDoc */
    public function clear(): Algorithm
    {
        $this->diffs = [];
        $this->freqs = [];

        return $this;
    }


    /** @inheritDoc */
    public function update(array $data): Algorithm
    {
        foreach ($data as $ratings) {
            foreach ($ratings as $item1 => $rating1) {
                isset($this->freqs[$item1]) || $this->freqs[$item1] = [];
                isset($this->diffs[$item1]) || $this->diffs[$item1] = [];
                foreach ($ratings as $item2 => $rating2) {
                    isset($this->freqs[$item1][$item2]) || $this->freqs[$item1][$item2] = 0;
                    isset($this->diffs[$item1][$item2]) || $this->diffs[$item1][$item2] = 0.0;
                    ++$this->freqs[$item1][$item2];
                    $this->diffs[$item1][$item2] += $rating1 - $rating2;
                }
            }
        }
        foreach ($this->diffs as $item1 => &$ratings) {
            foreach ($ratings as $item2 => $rating) {
                $diff = ($rating / $this->freqs[$item1][$item2]);
                $ratings[$item2] = round($diff, 2);
            }
        }

        return $this;
    }

    /** @inheritDoc */
    public function predict(array $preferences): array
    {
        $predictions = [];
        $freqs = [];
        $results = [];

        foreach ($preferences as $item => $rating) {
            foreach ($this->diffs as $diffItem => $diffRatings) {
                if (
                    isset($this->freqs[$diffItem]) &&
                    isset($this->freqs[$diffItem][$item])
                ) {
                    $freq = $this->freqs[$diffItem][$item];
                    isset($predictions[$diffItem]) || $predictions[$diffItem] = 0.0;
                    isset($freqs[$diffItem]) || $freqs[$diffItem] = 0;
                    $predictions[$diffItem] += $freq * ($diffRatings[$item] + $rating);
                    $freqs[$diffItem] += $freq;
                }
            }
        }

        foreach ($predictions as $item => $value) {
            if (!isset($preferences[$item]) && $freqs[$item] > 0) {
                $results[$item] = round($value / $freqs[$item], 2);
            }
        }

        return $results;
    }

    /** @inheritDoc */
    public function getModel(): array
    {
        return $this->diffs;
    }
}
