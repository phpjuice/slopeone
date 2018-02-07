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
  protected $diffs;

  /**
   * $freqs Ratings count matrix.
   * @var Array
   */
  protected $freqs;

  /**
   * Reset the instance.
   */
  public function clear(){
    $this->diffs = null;
    $this->freqs = null;
  }

  /**
   * Update matrices with user preference data, accepts an Array.
   * @param Array $userPrefs user preference data
   */
  public function add($userPrefs){
    foreach ($userPrefs as $item => $rating) {
      foreach ($userPrefs as $item2 => $rating2) {
        // Check if we are calculating an item against it self
        if( $item  == $item2 ){
          continue;
        }
        // if this item is not already set we initialize it
        if(!isset($this->freqs[$item][$item2])){
          $this->freqs[$item][$item2] = 0;
        }
        // if this item is not already set we initialize it
        if(!isset($this->diffs[$item][$item2])){
          $this->diffs[$item][$item2] = 0;
        }

        // here we increment the freqs matrix
        $this->freqs[$item][$item2] += 1;
        // add the new diff to the diffs array
        $this->diffs[$item][$item2] += $rating - $rating2;
      }
    }
    return $this;
  }

  /**
   * Recommend new items given known item ratings.
   * @param Array $userPrefs user preference data
   * @return Array predictions
   */
  public function predict($userPrefs){
        // Calculate Diffs Matrix
    $this->calculateDiffsMatrix();
    $freq = 1;
    $preds= [];
    $freqs= [];
    $results = [];
    foreach ($userPrefs as $item => $rating) {
      foreach ($this->diffs as $diff_item => $diff_ratings) {
        // if this item is not already set we initialize it
        if(
          !isset($this->freqs[$diff_item]) ||
          !isset($diff_ratings[$item]) ||
          !isset($this->freqs[$diff_item][$item])
        ){
          continue;
        }
        // we get the frequency for this item
        // from the frequencies matrix
        $freq = $this->freqs[$diff_item][$item];


        // if this item is not already set we initialize it
        if(!isset($preds[$diff_item])){
          $preds[$diff_item] = 0;
        }
        // if this item is not already set we initialize it
        if(!isset($freqs[$diff_item])){
          $freqs[$diff_item] = 0;
        }

        $preds[$diff_item] += $freq * ( $diff_ratings[$item] + $rating);
        $freqs[$diff_item] += $freq;
      }
    }

    foreach ($preds as $item => $rating) {
      if( isset($data[$item]) && $freqs[$item] > 0 ) {
        continue;
      }
      $results[$item] = $rating / $freqs[$item];
    }
    return $results;
  }

  private function calculateDiffsMatrix(){
    $tempArray = [];
    foreach ($this->diffs as $item => $ratings) {
      foreach ($ratings as $item2 => $rating2) {
        $tempArray[$item][$item2] = $this->diffs[$item][$item2] / $this->freqs[$item][$item2];
      }
    }
    $this->diffs = $tempArray;
    return $this;
  }

}
