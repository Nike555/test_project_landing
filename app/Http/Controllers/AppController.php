<?php

namespace App\Http\Controllers;

use App\Services\JsonRpcClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class AppController extends Controller
{

    public function __construct()
    {
        $this->sendVisit();
    }

    /**
     * Send visit to activity tracker API
     */
    protected function sendVisit()
    {
        $currentUrl = url()->full();
        $currentTime = Carbon::now()->toDateTimeString();

        $sendData = [
            'url' => $currentUrl,
            'date' => $currentTime,
        ];
        $client = new JsonRpcClient();
        $client->send('store', $sendData);
    }

}
