<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutGateway;
use App\Services\AlertService;
use Illuminate\Http\Request;

class PayoutGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payoutGateways = PayoutGateway::all();
        return view('admin.dashboard.payout-gateway.index', compact('payoutGateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.payout-gateway.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'required'
        ]);

        $gateway = new PayoutGateway();
        $gateway->name = $request->name;
        $gateway->status = $request->status;
        $gateway->description = $request->description;
        $gateway->save();

        AlertService::created();

        return redirect()->route('admin.payout-gateways.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayoutGateway $payoutGateway)
    {
        return view('admin.dashboard.payout-gateway.edit', compact('payoutGateway'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PayoutGateway $payoutGateway, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'description' => 'required'
        ]);

        $payoutGateway->update($data);

        AlertService::updated();

        return redirect()->route('admin.payout-gateways.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayoutGateway $payoutGateway)
    {
        $payoutGateway->delete();
        AlertService::deleted();

        return back();
    }
}
