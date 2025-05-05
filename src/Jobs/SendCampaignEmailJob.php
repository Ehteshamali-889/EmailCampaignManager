<?php
namespace EmailCampaignManager\Jobs;

use EmailCampaignManager\Mail\CampaignEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendCampaignEmailJob implements ShouldQueue {
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;
    protected $campaign;

    public function __construct($customer, $campaign) {
        $this->customer = $customer;
        $this->campaign = $campaign;
    }

    public function handle() {
        Mail::to($this->customer->email)->send(
            new CampaignEmail($this->campaign, $this->customer)
        );
    }
}
