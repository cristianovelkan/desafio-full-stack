<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\BaseController;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransferRequest;

class TransactionController extends BaseController
{
    /**
     *  @OA\GET(
     *      path="/api/transactions",
     *      summary="Get Logged User Statement",
     *      tags={"Transactions"},
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":"[]","message":"Extrato obtido com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     *  @OA\POST(
     *      path="/api/deposit",
     *      summary="Make a deposit",
     *      description="Make a deposit",
     *
     *      tags={"Transactions"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="value",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 example={"value": 10.00}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":{"id":"transaction-a-437b-b40d-0c0cb0c340e5","user_id":"user-f91-6bd1-45db-9eb7-75dbf7bec959","user":"Desenvolvimento","payer_id":"user-f91-6bd1-45db-9eb7-75dbf7bec959","payer":"Desenvolvimento","type":"Entrada","category":"Depósito","value":"10,00","description":"Depósito em conta.","created_at":"11/11/2024 16:55:23"},"message":"Depósito efetuado com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function deposit(DepositRequest $request) {}

    /**
     *  @OA\POST(
     *      path="/api/transfer",
     *      summary="Send value to another user",
     *      description="Send value to another user",
     *
     *      tags={"Transactions"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="uuid"
     *                 ),
     *                 @OA\Property(
     *                     property="value",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="date",
     *                     type="date"
     *                 ),
     *                 example={"value": 10.00, "user_id": "user-f91-6bd1-45db-9eb7-75dbf7bec959", "date": "2024-11-11"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":{"id":"transaction-1-47d8-8ede-4b25c916cc92","user_id":"user-f91-6bd1-45db-9eb7-75dbf7bec959","user":"Desenvolvimento","payer_id":"user-f91-6bd1-45db-9eb7-75dbf7bec959","payer":"Desenvolvimento","type":"Saía","category":"Transferência","value":"5,00","description":"Transferência para conta de Desenvolvimento","created_at":"11/11/2024 17:40:38"},"message":"Transferência efetuada com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function transfer(TransferRequest $request) {}


    /**
     * @OA\Delete(
     *     path="/api/transactions/{id}",
     *     summary="Cancel a transaction",
     *
     *     tags={"Transactions"},
     *     @OA\Parameter(
     *         description="Id of the transaction",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function cancel($id) {}
}
