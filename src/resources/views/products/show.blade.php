@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product_show.css') }}">
@endsection

@section('content')
<div class="product-detail-container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('products.index') }}" class="back-link">商品一覧 ＞</a>
    <h2>{{ $product->name }}</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="detail-content">
            <div class="image-section">
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                <input type="file" name="image">
                <p>{{ basename($product->image) }}</p>
            </div>

            <div class="info-section">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">

                <label>値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">

                <label>季節</label>
                @php
                    $seasons = explode(',', $product->season);
                @endphp
                <div class="season-checkbox">
                    <label><input type="checkbox" name="season[]" value="春"> 春</label>
                    <label><input type="checkbox" name="season[]" value="夏"> 夏</label>
                    <label><input type="checkbox" name="season[]" value="秋"> 秋</label>
                    <label><input type="checkbox" name="season[]" value="冬"> 冬</label>
                </div>
            </div>
        </div>

        <div class="description-section">
            <label>商品説明</label>
            <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="button-section">
            <a href="{{ route('products.index') }}" class="btn back">戻る</a>
            <button type="submit" class="btn save">変更を保存</button>

            {{-- 削除フォーム --}}
            <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete" onclick="return confirm('削除しますか？')">🗑</button>
            </form>
        </div>
    </form>
</div>
@endsection
