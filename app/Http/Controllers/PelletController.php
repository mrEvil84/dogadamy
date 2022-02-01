<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\src\Pelletbox\Application\Command\Consume;
use App\src\Pelletbox\Application\PelletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PelletController extends Controller
{
    private PelletService $service;

    public function __construct(PelletService $service)
    {
        $this->service = $service;
    }

    public function consume(Request $request): JsonResponse
    {

        $command = new Consume();

        try {
            $this->service->consumeUnit($command);

        } catch (\Exception $exception) {
            return response()->json(['error_message' => $exception->getMessage()], 400);
        }

        return response()->json(['consumed' => true]);
    }
}
