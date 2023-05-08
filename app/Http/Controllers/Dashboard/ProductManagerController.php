<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = $validated['image']->store('public/images/products');
        $imageUrl = Storage::url($imagePath);

        $slug = Str::slug($validated['name'], '-');

        Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'],
            'price' => $validated['price'],
            'is_enable' => $request->has('is_enable'),
            'image_url' => $imageUrl
        ]);


        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product): View
    {
        try {
            $product = Product::where('id', $product)->firstOrFail();
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
            'description' => 'required',
            'image' => 'image',
        ]);

        $slug = Str::slug($validated['name'], '-');

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->is_enable = $request->has('is_enable');
        $product->slug = $slug;

        if ($request->hasFile('image')) {
            $imagePath = $validated['image']->store('public/images/products');
            $imageUrl = Storage::url($imagePath);

            $sysStoragePath = str_replace('/storage', 'public', $product->image_url);
            Storage::delete($sysStoragePath);
            $product->image_url = $imageUrl;
        }

        $product->save();

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
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
        $product->is_enable = !$product->is_enable;
        $product->save();
        return redirect()->back();
    }
}
