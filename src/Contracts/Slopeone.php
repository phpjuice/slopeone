<?php

namespace PHPJuice\Slopeone\Contracts;


/**
 * Slope One Interface.
 *
 * @package    PHPJuice\Slopeone
 * @author     ElHaouari Mohammed <dzstormers@gmail.com>
 * @link       https://github.com/PHPJuice/slopeone
 * @license    MIT
 */
interface Slopeone
{

  /**
   * Reset the instance.
   */
  public function clear();

  /**
   * Update matrices with user preference data, accepts an Array.
   * @param Array $userPrefs user preference data
   */
  public function add($userPrefs);


  /**
   * Recommend new items given known item ratings.
   * @param Array $userPrefs user preference data
   * @return Array predictions
   */
  public function predict($userPrefs);

}
