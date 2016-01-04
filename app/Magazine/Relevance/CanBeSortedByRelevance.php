<?php

namespace App\Magazine\Relevance;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class CanBeSortedByRelevance
 * @package App\Magazine\Relevance
 *
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property EloquentCollection $categories
 */
trait CanBeSortedByRelevance
{
    /**
     * @var float
     */
    private $relevance = null;

    public function relevance()
    {
        if ($this->relevance == null) {
            $this->relevance = $this->calculateRelevance();
        }

        return $this->relevance;
    }

    protected function calculateRelevance() : int
    {
        $likeFactor = $this->likeFactor();
        $ageFactor = $this->ageFactor();
        $clicksFactor = $this->clicksFactor();

        return intval($likeFactor / 2 + $ageFactor + $clicksFactor);
    }

    private function ageFactor() : float
    {
        $created_at = $this->created_at;

        $daysDiff = floatval($created_at->diffInHours(Carbon::now())) / 24;

        $factor = max((30 - $daysDiff) * 10, 0);

        return $factor;
    }

    private function likeFactor() : float
    {
        $user = Auth::user();

        if (!$user) return 0;

        $categories = $this->categories;

        $relevances = 0;
        foreach ($categories as $category) {
            $relevances += Auth::user()->relevanceOfCategory($category);
        }

        return $relevances;
    }

    private function clicksFactor() : float
    {
        if (!$this->clicks) return 0;

        return floatval(min($this->clicks / 5, 150));

    }
}