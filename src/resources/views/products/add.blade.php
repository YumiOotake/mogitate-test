@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/add.css') }}">
@endsection

@section('content')
    <div class="product-form__content">
        <h1 class="product__heading">商品登録</h1>
        <form action="{{ route('store') }}" method="post" class="product-form" enctype="multipart/form-data">
            @csrf
            <div class="product-form__group">
                <label class="product-form__label" for="name">
                    商品名<span class="product-form__required">必須</span>
                </label>
                <input class="product-form__input" type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="商品名を入力">
                <div class="product-form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label" for="price">
                    値段<span class="product-form__required">必須</span>
                </label>
                <input class="product-form__input" type="text" name="price" id="price" value="{{ old('price') }}"
                    placeholder="値段を入力">
                <div class="product-form__error">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label" for="image">
                    商品画像<span class="product-form__required">必須</span>
                </label>
                <input class="product-form__input" type="file" name="image" id="image">
                <div class="product-form__error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label">
                    季節<span class="product-form__required">必須</span>
                    <span class="product-form__text">複数選択可</span>
                </label>
                @foreach ($seasons as $season)
                    <label class="product-form__label" for="season_{{ $season->id }}">
                        <input class="product-form__input" type="checkbox" name="season_id[]"
                            id="season_{{ $season->id }}" value="{{ $season->id }}"
                            {{ in_array($season->id, old('season_id', [])) ? 'checked' : '' }}>
                        <span class="product-form__season">{{ $season->name }}</span>
                    </label>
                @endforeach
                <div class="product-form__error">
                    @error('season_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label" for="description">
                    商品説明<span class="product-form__required">必須</span>
                </label>
                <textarea class="product-form__textarea" name="description" id="description" cols="30" rows="10"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <div class="product-form__error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="product-form__button">
                <a href="{{ route('index') }}" class="product-form__button-back back-btn">戻る</a>
                <button class="product-form__button-submit btn" type="submit">登録</button>
            </div>
        </form>
    </div>
@endsection
