<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\src\Categories\Application\CategoriesService;
use App\src\Categories\Application\Command\AddCategory;
use App\src\Categories\ReadModel\CategoriesReadModel;
use App\src\Categories\ReadModel\Query\GetCategories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private CategoriesReadModel $categoriesReadModel;
    private CategoriesService $categoriesService;

    public function __construct(CategoriesReadModel $categoriesReadModel, CategoriesService $categoriesService) {
        $this->categoriesReadModel = $categoriesReadModel;
        $this->categoriesService = $categoriesService;
    }
    public function show(string $locale): JsonResponse
    {
        $categories = $this->categoriesReadModel->getCategories(new GetCategories($locale));

        return response()->json(['categories' => $categories], 200);
    }

    public function add(Request $request): JsonResponse
    {
        $categoryName = $request->get('category_name');
        $locale = $request->get('locale');

        try {
            $this->categoriesService->addCategory(new AddCategory($categoryName, $locale));

        } catch (\Exception $exception) {
            return response()->json(['error_message' => $exception->getMessage()], 400);
        }

        return response()->json(['category_name' => $categoryName, 'locale' => $locale]);
    }
    public function delete(Request $request): JsonResponse
    {
        $categoryName = $request->get('category_name');

        try {
            $this->categoriesService->deleteCategory($categoryName);

        } catch (\Exception $exception) {
            return response()->json(['error_message' => $exception->getMessage()], 400);
        }

        return response()->json();
    }
}
