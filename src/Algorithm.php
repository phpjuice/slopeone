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
class Algorithm implements \PHPJuice\Slopeone\Contracts\Slopeone {

  /**
  * $diffs Differential ratings matrix.
  * @var array
  */
  protected $diffs;

  /**
   * $freqs Ratings count matrix.
   * @var array
   */
  protected $freqs;

  /**
   * Reset the instance.
   */
  public function clear() {
      $this->diffs = null;
      $this->freqs = null;
  }

  /**
   * Update matrices with user preference data, accepts an Array.
   * @param array $userPrefs user preference data
   * @return Algorithm
   */
  public function update($userData) {
    foreach($userData as $ratings){
      foreach($ratings as $item1=>$rating1){
        isset($this->freqs[$item1]) || $this->freqs[$item1] = [];
        isset($this->diffs[$item1]) || $this->diffs[$item1] = [];
        foreach($ratings as $item2=>$rating2){
          isset($this->freqs[$item1][$item2]) || $this->freqs[$item1][$item2] = 0;
          isset($this->diffs[$item1][$item2]) || $this->diffs[$item1][$item2] = 0.0;
          $this->freqs[$item1][$item2] += 1;
          $this->diffs[$item1][$item2] += $rating1 - $rating2;
        }
      }
    }
    foreach($this->diffs as $item1 => &$ratings){
      foreach($ratings as $item2=>$rating){
        $diff = ( $ratings[$item2] / $this->freqs[$item1][$item2] );
        $ratings[$item2] = round($diff,2);
      }
    }
  }

  /**
   * Recommend new items given known item ratings.
   * @param array $userPrefs user preference data
   * @return array predictions
   */
  public function predict($userPrefs) {
    $preds = [];
    $freqs = [];
    $results = [];
    foreach ($userPrefs as $item=>$rating){
      foreach($this->diffs as $diffItem=>$diffRatings){
        if(
          isset($this->freqs[$diffItem]) &&
          isset($this->freqs[$diffItem][$item])
        ){
          $freq = $this->freqs[$diffItem][$item];
          isset($preds[$diffItem]) || $preds[$diffItem] = 0.0;
          isset($freqs[$diffItem]) || $freqs[$diffItem] = 0;
          $preds[$diffItem] += $freq * ($diffRatings[$item] + $rating);
          $freqs[$diffItem] += $freq;
        }
      }
    }
    foreach($preds as $item => $value){
      if (!isset($userPrefs[$item]) && $freqs[$item] > 0){
        $results[$item] = round ( $value/$freqs[$item] , 2);
      }
    }
    return $results;
  }

  public function getModel(){
    return $this->diffs;
  }
}
