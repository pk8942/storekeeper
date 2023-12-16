
@extends('layouts.app')

@section('content')
    <h2>Create a New Product</h2>
    <form method="post" action="{{ url('/products/store') }}">
        @csrf
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <label for="price">Price:</label>
        <input type="number" name="price" required>

        <button type="submit">Add Product</button>
    </form>
@endsection
