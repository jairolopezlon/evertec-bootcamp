<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::all();

        return view('pages.dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = $validated['image']->store('public/images/products');
        $imageUrl = Storage::url($imagePath);

        $slug = Str::slug($validated['name'], '-');

        $hasAvailability = $validated['stock'] <= 0 ? false : true;

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'has_availability' => $hasAvailability,
            'is_enabled' => $request->has('is_enabled'),
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        try {
            return view('pages.dashboard.products.show', compact('product'));
        } catch (\Throwable $th) {
            $productNotFound = true;

            return view('pages.dashboard.products.show', compact('productNotFound'));
        }
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(Product $product): View
    {
        return view('pages.dashboard.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'image',
        ]);

        $slug = Str::slug($validated['name'], '-');

        $product->name = $validated['name'];
        $product->stock = $validated['stock'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->is_enabled = $request->has('is_enabled');
        $product->slug = $slug;
        $product->has_availability = $validated['stock'] <= 0 ? false : true;

        if ($request->hasFile('image')) {
            $imagePath = $validated['image']->store('public/images/products');
            $imageUrl = Storage::url($imagePath);

            $sysStoragePath = str_replace('/storage', 'public', $product->image_url);
            Storage::delete($sysStoragePath);
            $product->image_url = $imageUrl;
        }

        $product->save();

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }

    public function toggleEnableDisable(Product $product): RedirectResponse
    {
        $product->is_enabled = ! $product->is_enabled;
        $product->save();

        return redirect()->back();
    }
}
