<?php
namespace EmailCampaignManager;

use App\Models\EmailCampaign;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendCampaignEmailJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class EmailCampaignManager {
    public function createCampaign(array $data) {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $campaign = EmailCampaign::create($data);
        return $campaign;
    }

    public function filterAudience($status = null, $planExpiryDays = null) {
        Log::info("Filtering customers with status: $status, plan expiry days: $planExpiryDays");

        $customers = Customer::query();

        if ($status) {
            $customers->where('status', $status);
        }

        if ($planExpiryDays) {
            $customers->whereBetween('plan_expiry_date', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays($planExpiryDays)->endOfDay()
            ]);
        }

        $result = $customers->get();
        Log::info("Filtered customers count: " . $result->count());

        return $result;
    }

    public function sendCampaign(EmailCampaign $campaign, $customers) {
        Log::info("Dispatching job to send campaign: " . $campaign->title);
        foreach ($customers as $customer) {
            Log::info("Dispatching job for customer: " . $customer->email);
            SendCampaignEmailJob::dispatch($customer, $campaign);
        }
        return "Emails are being sent to the selected audience.";
    }
}
