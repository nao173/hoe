@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-detail">
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
        <h2>{{ $product->name }}</h2>
        <p>価格: ¥{{ number_format($product->price) }}</p>
        <p>{{ $product->description }}</p>

        <a href="{{ route('products.index') }}" class="btn-back">一覧に戻る</a>
    </div>
</div>
@endsection
