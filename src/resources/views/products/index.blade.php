@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection

@section('content')
    <div class="products-content">
        <div class="product__heading">
            <h1 class="product__heading-title">
                @if (!empty(request('keyword')))
                    “{{ request('keyword') }}”の商品一覧
                @else
                    商品一覧
                @endif
            </h1>
            <a href="{{ route('create') }}" class="product__heading-button">
                + 商品を追加
            </a>
        </div>

        <div class="products-section">
            <div class="product__nav">
                <form action="{{ route('search') }}" method="get" class="product__search-form">
                    <div class="product__search-content">
                        <input type="text" name="keyword" class="product__search-input" placeholder="商品名で検索"
                            value="{{ request('keyword') }}">
                        <button class="product__search-submit" type="submit">検索</button>
                    </div>
                    <div class="product__sort-content">
                        <h2 class="product__sort-title">価格順で表示</h2>
                        <div class="product__sort-item">
                            <select name="sort" class="product__sort-select">
                                <option value="" class="product__sort-option" disabled {{ request('sort') ? '' : 'selected' }} hidden>価格で並び替え</option>
                                <option value="price_desc" class="product__sort-option" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                                    高い順に表示
                                </option>
                                <option value="price_asc" class="product__sort-option" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                                    低い順に表示
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
                @if (request('sort'))
                    <div class="product__sort-modal">
                        <span class="product__sort-label">
                            {{ request('sort') === 'price_desc' ? '高い順に表示' : '低い順に表示' }}
                        </span>
                        <a href="{{ route('search', request()->except('sort', 'page')) }}" class="product__sort-close">×</a>
                    </div>
                @endif
            </div>

            <div class="products-container">
                @forelse ($products as $product)
                    <article class="product-card">
                        <a href="{{ route('show', ['productId' => $product->id]) }}" class="product-card__link">
                            <figure class="product-card__figure">
                                <div class="product-card__image">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像"
                                        class="product-card__img">
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
                    {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
