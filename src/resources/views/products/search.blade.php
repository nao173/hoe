@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="product-container">
    <div class="sidebar">
        <h2>商品一覧</h2>

        {{-- 🔍 検索フォーム --}}
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit" class="btn-search">検索</button>

            {{-- 💰 並び替え --}}
            <div class="sort-box">
                <label>価格順で表示</label>
                <select name="sort" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value="low">価格が安い順</option>
                    <option value="high">価格が高い順</option>
                </select>
            </div>
        </form>
    </div>

    <div class="product-list">
        @if(!empty($keyword))
            <h2>“{{ $keyword }}”の商品一覧</h2>
        @else
            <h2>商品一覧</h2>
        @endif

        <div class="grid">
            @forelse($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="info">
                        <p class="name">{{ $product->name }}</p>
                        <p class="price">¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
            @empty
                <p>該当する商品がありません。</p>
            @endforelse
        </div>

        {{-- ページネーション --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
