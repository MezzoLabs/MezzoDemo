<?php

namespace App\Magazine\Relevance;


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

    public function calculateRelevance()
    {

    }
}