<?php
namespace EmailCampaignManager\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use EmailCampaignManager\EmailCampaignManager;

class CampaignController extends Controller {
    protected $manager;

    public function __construct(EmailCampaignManager $manager) {
        $this->manager = $manager;
    }

    public function create(Request $request) {
        return $this->manager->createCampaign($request->all());
    }

    public function filter(Request $request) {
        $customers = $this->manager->filterAudience($request->status, $request->plan_expiry_days);
        return response()->json($customers);
    }

    public function send(Request $request) {
        $campaign = EmailCampaign::findOrFail($request->campaign_id);
        $customers = Customer::whereIn('id', $request->customer_ids)->get();
        return response()->json(['message' => $this->manager->sendCampaign($campaign, $customers)]);
    }
}
