<?php

namespace App\Modules\Exchange\Presentation\Http\Controllers\Api\v1;

use Illuminate\Routing\Controller;
use App\Modules\Exchange\Application\Actions\GetExchangeRateAction;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(title="Exchange API - IDoctus", version="1.0", description="API for retrieving the USD to EUR exchange rate. To validate empty Bearer tokens, you can use other tools like Postman or similar.")
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     description="Optional: Enter a valid Bearer token."
 * )
 */
class ExchangeController extends Controller
{
    private GetExchangeRateAction $action;

    public function __construct(GetExchangeRateAction $action)
    {
        $this->action = $action;
    }

    /**
     * Retrieve the current USD to EUR exchange rate.
     *
     * @OA\Get(
     *     path="/api/exchange",
     *     summary="Get current exchange rate",
     *     tags={"Exchange"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Current exchange rate",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="price", type="number", example=0.851357)
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized: Invalid or unauthorized Bearer token.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthorized")
     *         )
     *     ),
     *
     * )
     */
    public function getExchange(): JsonResponse
    {
        return $this->action->execute();
    }
}
