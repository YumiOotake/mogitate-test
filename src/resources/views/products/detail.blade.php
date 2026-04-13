@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/detail.css') }}">
@endsection

@section('content')
    <div class="product-form__content">
        <div class="product-form__nav">
            <a href="{{ route('index') }}" class="product-form__button-back">
                商品一覧
            </a>
            <span class="product-form__title">&gt;{{ $product->name }}</span>
        </div>
        <form action="{{ route('update', ['productId' => $product->id]) }}" method="post" class="product-form__edit"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="product-form__group">
                <div class="product-form__image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="" class="product-form__img">
                </div>
                <input class="product-form__input" type="file" name="image" id="image">
                <div class="product-form__error">
                    @error('image')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label" for="name">
                    商品名
                </label>
                <input class="product-form__input" type="text" name="name" id="name"
                    value="{{ old('name', $product->name) }}">
                <div class="product-form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label" for="price">
                    値段
                </label>
                <input class="product-form__input" type="text" name="price" id="price"
                    value="{{ old('price', $product->price) }}">
                <div class="product-form__error">
                    @error('price')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="product-form__group">
                <label class="product-form__label">
                    季節
                </label>
                @foreach ($seasons as $season)
                    <label class="product-form__label" for="season_{{ $season->id }}">
                        <input class="product-form__input" type="checkbox" name="season_id[]"
                            id="season_{{ $season->id }}" value="{{ $season->id }}"
                            {{ in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                    商品説明
                </label>
                <textarea class="product-form__textarea" name="description" id="description" cols="30" rows="10">{{ old('description', $product->description) }}</textarea>
                <div class="product-form__error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="product-form__button">
                <a href="{{ route('index') }}" class="product-form__button-back back-btn">戻る</a>
                <button class="product-form__button-submit btn" type="submit">変更を保存</button>
            </div>
        </form>
        <form action="{{ route('destroy', ['productId' => $product->id]) }}" method="post" class="product-form__delete">
            @csrf
            @method('DELETE')
            <button class="product-form__delete-button">
                <img src="{{ asset('storage/images/delete.png') }}" alt="delete-img" class="product-form__delete-image">
            </button>
        </form>
    </div>
@endsection
