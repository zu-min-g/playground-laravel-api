<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *    title="playground-laravel-api",
 *    description="Laravel で Rest API を作ってみる",
 *    version="1.0.0",
 * )
 * @OA\Server(url="/api/v1")
 */
class OpenApiController extends Controller
{
    /**
     * Open API フォーマットのドキュメント
     *
     * @OA\Get(
     *     path="/open-api",
     *     tags={"Meta"},
     *     description="Open API フォーマットで API のドキュメントを出力します。",
     *     @OA\Response(
     *          response="200",
     *          description="API 情報を返却します。",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json"
     *              ),
     *              @OA\MediaType(
     *                  mediaType="application/x-yaml"
     *              )
     *          }
     *     )
     * ),
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $openapi = \OpenApi\scan([
            base_path('app/Http/Controllers/v1'),
        ]);
        if ($request->accepts('application/x-yaml')) {
            return new Response($openapi->toYaml(), 200, ['Content-Type' => 'application/x-yaml']);
        }
        return $openapi->toJson();
    }
}
