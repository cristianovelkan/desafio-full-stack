<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\BaseController;

class BalanceController extends BaseController
{
    /**
     *  @OA\GET(
     *      path="/api/balance",
     *      summary="Get Logged User Balance",
     *      tags={"Balance"},
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":{"id":"balance--38db-44e9-84ef-31a38419d788","user_id":"user-bf2-fcb7-4ab5-8e38-e60fb3766306","value":"0.00"},"message":"Saldo obtido com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function show() {}
}
