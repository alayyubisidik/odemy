@extends('frontend.instructor.dashboard.dashboard-app')

@section('dashboard-content')
    <div class="wsus__dashboard_contant">
        <div class="wsus__dashboard_contant_top">
            <div class="wsus__dashboard_heading relative">
                <h5>Orders</h5>
                <p>Manage your orders and track their status such as pending, completed, and cancelled.</p>
            </div>
        </div>

        <div class="wsus__dash_course_table">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">

                        <table class="table">

                            <tbody>

                                <tr>
                                    <th>
                                        Course Name
                                    </th>

                                    <th>
                                        Purchase By
                                    </th>

                                    <th class="sale">
                                        Price
                                    </th>

                                    <th class="status">
                                        Commission
                                    </th>

                                    <th class="action">
                                        Earning
                                    </th>

                                </tr>

                                @forelse($orderItems as $orderItem)
                                    <tr>

                                        <td>
                                            {{ $orderItem->product->title }}
                                        </td>

                                        <td>
                                            {{ $orderItem->order->customer->name }}
                                        </td>

                                        <td>
                                            {{ rupiah($orderItem->price) }}
                                        </td>

                                        <td>
                                            {{ $orderItem->commission_rate ?? 0 }}%
                                        </td>

                                        <td>
                                            {{ rupiah($orderItem->price - calculateCommission($orderItem->price, $orderItem->commission_rate)) }}
                                        </td>


                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center py-4">
                                            No data available
                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
