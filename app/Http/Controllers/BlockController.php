<?php

namespace App\Http\Controllers;

use App\DTOs\BlockDTO;
use App\Services\BlockService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Enrichers\BlockEnricher;
use App\Formatters\ResponseFormatter;
use App\Traits\StringHelper;

class BlockController extends Controller
{
    protected BlockService $blockService;
    protected BlockEnricher $enricher;
    use StringHelper;

    public function __construct(BlockService $blockService, BlockEnricher $enricher)
    {
        $this->blockService = $blockService;
        $this->enricher = $enricher;
    }

    public function index(): JsonResponse
    {
        $blocks = $this->blockService->getAllBlocks();
        return response()->json(['data' => $blocks], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain_id' => 'required|integer|exists:domains,id',
        ]);

        $blockDTO = BlockDTO::fromRequest($request);

        $block = $this->blockService->createBlock($blockDTO);

        return response()->json(['data' => $block], 201);
    }

    public function show(int $id): JsonResponse
    {
        $block = $this->blockService->getBlockById($id);

        
        if (!$block) {
            return response()->json(
                ResponseFormatter::format('Domínio não encontrado', 404),
                404
            );
        }

        $enrichedBlock = $this->enricher->enrich($block);

        return response()->json(['data' => $enrichedBlock], 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'domain_id' => 'sometimes|required|integer|exists:domains,id',
        ]);

        $blockDTO = BlockDTO::fromRequest($request);

        $block = $this->blockService->updateBlock($id, $blockDTO);

        if (!$block) {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }

        return response()->json(['data' => $block], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->blockService->deleteBlock($id);

        if (!$deleted) {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }

        return response()->json(['message' => 'Bloco excluído com sucesso'], 200);
    }
}
