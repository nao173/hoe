@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="product-container">
    <div class="sidebar">
        @if(!empty($keyword))
            <h2>“{{ $keyword }}”の商品一覧</h2>
        @else
            <h2>商品一覧</h2>
        @endif

        {{-- 🔍 検索フォーム --}}
        <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="商品名で検索" value="{{ $keyword }}">
            <button type="submit" class="btn-search">検索</button>

            <label class="sort-label">価格順で表示</label>
            <select name="sort" onchange="this.form.submit()">
                <option value="">価格順で並び替え</option>
                <option value="asc">安い順</option>
                <option value="desc">高い順</option>
            </select>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <a href="{{ route('products.create') }}" class="btn-add">+ 商品を追加</a>
        </div>

        {{-- 商品カード一覧 --}}
        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                    <div class="card-body">
                        <p class="name">{{ $product->name }}</p>
                        <p class="price">¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
            @empty
                <p class="no-result">該当する商品は見つかりませんでした。</p>
            @endforelse
        </div>

        {{-- ページネーション --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
