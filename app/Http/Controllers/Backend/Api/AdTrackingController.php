<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad\Ad;
use App\Repositories\Ad\AdInterface;
use Illuminate\Http\Request;

class AdTrackingController extends Controller
{
    protected $adInterface;

    public function __construct(AdInterface $adInterface)
    {
        parent::__construct();
        $this->adInterface = $adInterface;
    }

    public function recordClick(Ad $ad)
    {
        $this->adInterface->recordClick($ad);
        return response()->json(['success' => true]);
    }
}