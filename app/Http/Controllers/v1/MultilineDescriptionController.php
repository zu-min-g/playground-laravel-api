<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultilineDescriptionController extends Controller
{
    /**
     * swagger-php で 複数行の説明を書く例（失敗例）
     *
     * @OA\Get(
     *     path="/multiline-description/case-1",
     *     tags={"swagger-php"},
     *     description="１行目  
     *     ２行目  
     *     ３行目",
     *     @OA\Response(response="200", description="")
     * ),
     */
    public function case1(Request $request)
    {
        return [];
    }

    /**
     * swagger-php で 複数行の説明を書く例（成功例１）
     *
     * @OA\Get(
     *     path="/multiline-description/case-2",
     *     tags={"swagger-php"},
     *     description="
１行目  
２行目

* ３行目",
     *     @OA\Response(response="200", description="")
     * ),
     */
    public function case2(Request $request)
    {
        return [];
    }

    const DESCRIPTION = <<<DOC
１行目  

* ２行目
* ３行目
DOC;
    /**
     * swagger-php で 複数行の説明を書く例（成功例２）
     *
     * @OA\Get(
     *     path="/multiline-description/case-3",
     *     tags={"swagger-php"},
     *     description=\App\Http\Controllers\v1\MultilineDescriptionController::DESCRIPTION,
     *     @OA\Response(response="200", description="")
     * ),
     */
    public function case3(Request $request)
    {
        return [];
    }
}
