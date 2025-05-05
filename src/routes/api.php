<?php
use Illuminate\Support\Facades\Route;
use EmailCampaignManager\Http\Controllers\CampaignController;

Route::post('/campaigns', [CampaignController::class, 'create']);
Route::post('/campaigns/filter', [CampaignController::class, 'filter']);
Route::post('/campaigns/send', [CampaignController::class, 'send']);
