<?php

namespace App\Http\Controllers;

use App\Formatters\ResponseFormatter;
use App\Enrichers\DomainEnricher;
use App\DTOs\DomainDTO;
use App\Services\DomainService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\StringHelper;

class DomainController extends Controller
{
    protected DomainService $domainService;
    protected DomainEnricher $enricher;
    use StringHelper;

    public function __construct(DomainService $domainService, DomainEnricher $enricher)
    {
        $this->domainService = $domainService;
        $this->enricher = $enricher;
    }

    public function index(): JsonResponse
    {
        $domains = $this->domainService->getAllDomains();
        return response()->json(['data' => $domains], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $domainDTO = DomainDTO::fromRequest($request);

        $domain = $this->domainService->createDomain($domainDTO);

        return response()->json(['data' => $domain], 201);
    }

    public function show(int $id): JsonResponse
    {
        $domain = $this->domainService->getDomainById($id);

        if (!$domain) {
            return response()->json(
                ResponseFormatter::format('Domínio não encontrado', 404),
                404
            );
        }
        $formatted = $this->enricher->enrich($domain);

        return response()->json(['data' => $formatted], 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255'
        ]);

        $domainDTO = DomainDTO::fromRequest($request);

        $domain = $this->domainService->updateDomain($id, $domainDTO);

        if (!$domain) {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }

        return response()->json(['data' => $domain], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->domainService->deleteDomain($id);

        if (!$deleted) {
            return response()->json(['error' => 'Recurso não encontrado'], 404);
        }

        return response()->json(['message' => 'Domínio excluído com sucesso'], 200);
    }
}
