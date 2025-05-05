<?php
namespace EmailCampaignManager\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model {
    protected $fillable = ['title', 'subject', 'body'];
}
