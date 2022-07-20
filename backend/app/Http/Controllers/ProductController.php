<?php

namespace App\Http\Controllers;

use App\Library\BaseFilter;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Returns a list of Product.
     * 
     * Filters by name, limit and offset.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'limit' => 'min:1|max:100|numeric',
        ]);

        $filter = new BaseFilter(
            name: $request->get('name'),
            limit: $request->get('limit', 10),
            offset: $request->get('offset', 0),
        );

        $query = Product::query()
            ->when($filter->name, function ($query, $name) {
                $query->where('name', 'LIKE', "%{$name}%");
            })
            ->limit($filter->limit)
            ->offset($filter->offset)
            ->get();

        return new JsonResponse(
            data: $query,
            status: 200,
        );
    }

    /**
     * Creates and persists a Product.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ]);

        $product = Product::create($data);

        return new JsonResponse(
            data: $product->refresh(),
            status: 201,
        );
    }

    /**
     * Returns a Product.
     * 
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return new JsonResponse(
            data: $product,
            status: 200,
        );
    }

    /**
     * Updates a Product.
     * 
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'image' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ]);

        $product->update($data);

        return new JsonResponse(
            data: $product,
            status: 200,
        );
    }

    /**
     * Deletes a Product from storage.
     * 
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return new JsonResponse(
            status: 204,
        );
    }
}
