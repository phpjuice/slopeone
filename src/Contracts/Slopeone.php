<?php

namespace PHPJuice\Slopeone\Contracts;

use PHPJuice\Slopeone\Algorithm;

interface Slopeone
{
    /**
     * Reset the instance.
     */
    public function clear();

    /**
     * Update matrices with user preference data, accepts an Array.
     *
     * @param  array  $data  user preference data
     */
    public function update(array $data): Algorithm;

    /**
     * Recommend new items given known item ratings.
     *
     * @param  array  $preferences  user preference data
     *
     * @return array
     */
    public function predict(array $preferences): array;

    /**
     * Gets the computed model.
     *
     * @return array model
     */
    public function getModel(): array;
}
