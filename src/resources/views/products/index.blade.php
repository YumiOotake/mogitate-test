@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection

@section('content')
    <div class="products-page">
        <div class="product__heading">
            <h1 class="product__heading-ttl">商品一覧</h1>
            <a href="{{ route('store') }}" class="product__heading-button">
                + 商品を追加
            </a>
        </div>

        {{-- <nav class="product__nav">
            <form action="{{ route('search') }}" method="get" class="product__search-form">
                <div class="product__search-content">
                    <div class="product__search-item">
                        <input type="text" name="keyword" class="product__search-input" placeholder="商品名で検索"
                            value="{{ request('keyword') }}">
                    </div>
                    <div class="product__search-button">
                        <button class="product__search-button--submit btn" type="submit">検索</button>
                    </div>
                </div>
            </form>
            <div class="product__sort">
                <h2 class="product__sort-title">価格順で表示</h2>
                <form action="{{ route('sort') }}" method="get" class="product__sort-form">
                    <div class="product__sort-item">
                        <select name="sort" class="product__sort-select">
                            <option value="">価格で並び替え</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                                高い順に表示
                            </option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                                安い順に表示
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </nav> --}}

        @forelse ($products as $product)
            <article class="product-card">
                <a href="{{ route('show', $product) }}" class="product-card__link">
                    <figure class="product-card__figure">
                        <div class="product-card__image">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="product-card__img">
                        </div>
                        <figcaption class="product-card__figcaption">
                            <h3 class="product-card__name">{{ $product->name }}</h3>
                            <p class="product-card__price">¥{{ $product->price }}</p>
                        </figcaption>
                    </figure>
                </a>
            </article>
        @empty
            <p class="product__empty">商品が見つかりませんでした</p>
        @endforelse
        <div class="product-content__paginate">
            {{-- {{ $products->appends(request()->query())->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
@endsection
