
@extends('layouts.app')

@section('content')
    <h2>Sales History</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesHistory as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>${{ number_format($sale->price, 2) }}</td>
                    <td>{{ $sale->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
