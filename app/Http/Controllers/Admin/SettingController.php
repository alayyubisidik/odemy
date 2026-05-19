<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    use FileUploadTrait;
    function index()
    {
        return view("admin.dashboard.setting.sections.general-settings");
    }

    function store(Request $request)
    {
        $validatedData = $request->validate([
            "site_name" => ["required", "string", "max:255"],
            "site_email" => ["nullable", "email", "max:255"],
            "site_phone" => ["nullable", "string", "max:255"],
            "site_location" => ["nullable"],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ["key" => $key],
                ["value" => $value],
            );
        }

        Cache::forget('settings');

        notyf()->success("Update Successfully!");

        return redirect()->back();
    }

    function commissionSettingIndex()
    {
        return view("admin.dashboard.setting.sections.commission-settings");
    }

    public function commissionSettingStore(Request $request)
    {
        $validatedData = $request->validate([
            "commission_rate" => ["required", "numeric", "max:100"],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ["key" => $key],
                ["value" => $value],
            );
        }

        Cache::forget('settings');

        AlertService::updated("Commission Settings Updated Successfully");
        return to_route("admin.settings.commission.index");
    }
}
