<?php

namespace App\Helpers;

use App\Repositories\Ad\AdInterface;

class AdHelper
{
    public static function getAd($position)
    {
        $adInterface = app(AdInterface::class);
        $ad = $adInterface->getAdForPosition($position);
        
        if ($ad) {
            $adInterface->recordImpression($ad);
        }
        
        return $ad;
    }
}