<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\src\Pelletbox\Application\Command\Consume;
use App\src\Pelletbox\Application\PelletService;
use App\src\Pelletbox\ReadModel\PelletReadModel;
use App\src\Pelletbox\ReadModel\Query\GetStatsByDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class PelletController extends Controller
{
    private PelletService $service;
    private PelletReadModel $pelletReadModel;

    public function __construct(PelletService $service, PelletReadModel $pelletReadModel)
    {
        $this->service = $service;
        $this->pelletReadModel = $pelletReadModel;
    }

    public function consume(Request $request): JsonResponse
    {

        $command = new Consume();

        try {
            $this->service->publishUnit($command);

        } catch (\Exception $exception) {
            return response()->json(['error_message' => $exception->getMessage()], 400);
        }

        return response()->json(['consumed' => true]);
    }

    public function stats()
    {
        $date = \DateTime::createFromFormat('Y-m-d', '2022-02-18');
        $stats = $this->pelletReadModel->getStats(new GetStatsByDate($date));

        return View::make('pellet/stats', ['stats' => $stats->toArray()]);
    }
}
