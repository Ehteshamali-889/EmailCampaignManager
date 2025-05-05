<?php
namespace EmailCampaignManager\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $fillable = ['name', 'email', 'status', 'plan_expiry_date'];
    protected $table = 'customers';
}
