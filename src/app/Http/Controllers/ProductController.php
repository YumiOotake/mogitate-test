<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->paginate(6);

        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $seasons = Season::orderBy('id')->get();

        return view('products.detail', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('images', 'public');

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->sync($request->season_id);

        return redirect()->route('index');
    }

    public function create()
    {
        $seasons = Season::orderBy('id')->get();

        return view('products.add', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $imagePath = $request->file('image')->store('images', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        $product->seasons()->attach($request->season_id);

        return redirect()->route('index');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()->route('index');
    }

    public function search(Request $request)
    {
        $products = Product::query()
            ->keywordSearch($request->keyword)
            ->sortByPrice($request->sort)
            ->paginate(6);

        return view('products.index', compact('products'));
    }
}
