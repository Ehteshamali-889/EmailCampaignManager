<?php
namespace EmailCampaignManager\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignEmail extends Mailable {
    use Queueable, SerializesModels;

    public $campaign;
    public $customer;

    public function __construct($campaign, $customer) {
        $this->campaign = $campaign;
        $this->customer = $customer;
    }

    public function build() {
        return $this->subject($this->campaign->subject)
                    ->view('emails.campaign')
                    ->with([
                        'body' => $this->campaign->body,
                        'name' => $this->customer->name
                    ]);
    }
}
