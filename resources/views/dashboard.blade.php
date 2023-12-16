
@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <div class="card">
        <div class="card-header">Sales Figures</div>
        <div class="card-body">
            <ul>
                <li>Today: ${{ number_format($salesToday, 2) }}</li>
                <li>Yesterday: ${{ number_format($salesYesterday, 2) }}</li>
                <li>This Month: ${{ number_format($salesThisMonth, 2) }}</li>
                <li>Last Month: ${{ number_format($salesLastMonth, 2) }}</li>
            </ul>
        </div>
    </div>
@endsection
