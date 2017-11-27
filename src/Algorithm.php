<?php

namespace PHPJuice\Slopeone;

/**
 * Slope One collaborative filtering for rated resources.
 *
 * @package    PHPJuice\Slopeone
 * @author     ElHaouari Mohammed <dzstormers@gmail.com>
 * @link       https://github.com/PHPJuice/slopeone
 * @license    MIT
 */
class Algorithm implements \PHPJuice\Slopeone\Contracts\Slopeone
{

  /**
   * $diffs Differential ratings matrix.
   * @var Array
   */
  private $diffs;

  /**
   * $freqs Ratings count matrix.
   * @var Array
   */
  private $freqs;

  /**
   * Reset the instance.
   */
  public function clear(){

  }

  /**
   * Update matrices with user preference data, accepts an Array.
   * @param Array $userPrefs user preference data
   */
  public function add($userPrefs){

  }


  /**
   * Recommend new items given known item ratings.
   * @param Array $userPrefs user preference data
   * @return Array predictions
   */
  public function predict($userPrefs){

  }

}
