<?php

namespace App\Console\Commands;

use App\Models\UserSubscribe;
use Illuminate\Console\Command;

class CheckPaymentNotInserted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiKey = 'sk_live_PBW7kauOIRZgl4zXfmyCNFsq';
        $url = 'https://api.tap.company/v2/charges/list';
        $startDate = \Carbon\Carbon::parse('2023-01-01'); // Replace with the start date of the period
        $endDate = \Carbon\Carbon::parse('2023-01-31'); // Replace with the end date of the period
        $startDateStr = $startDate->toIso8601ZuluString();
        $endDateStr = $endDate->toIso8601ZuluString();
        $params = [
            'created' => "{$startDateStr},{$endDateStr}",
        ];
        $headers = [
            'Authorization' => "Bearer {$apiKey}",
            'Content-Type' => 'application/json',
        ];
        $response = \Illuminate\Support\Facades\Http::withHeaders($headers)->post($url, $params);

        if ($response->ok()) {
            $response =  $response->json()['charges'];
            foreach ($response as $charge){
                if(isset($charge['metadata']['user_id'])) {
                    if ($charge['metadata']['source'] == 'Work_Net'  && $charge['status'] == 'CAPTURED'  && !\App\Models\UserSubscribe::query()
                            ->where('charge_id', $charge['id'])->where('course_id', $charge['metadata']['course_id'])
                            ->where('user_id', $charge['metadata']['user_id'])
                            ->first()) {
                        UserSubscribe::query()->create([
                            'user_id' => $charge['metadata']['user_id'],
                            'course_id' => $charge['metadata']['course_id'],
                            'charge_id' => $charge['id'],
                            'amount' => $charge['amount'],
                            'card' => $charge['card']['brand'] . "-" . $charge['card']['first_six'] . "-" . $charge['card']['last_four']
                        ]);
                    }
                }
            }
        }


    }
}
