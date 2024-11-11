<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;


class AuthController extends BaseController
{
    /**
     *  @OA\POST(
     *      path="/auth/register",
     *      summary="Register a new user",
     *      description="Register a new user",
     *      tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="c_password",
     *                     type="string"
     *                 ),
     *                 example={"name": "Cristiano Mendes", "email": "cristiano@mendes.dev", "password": "Password@123", "c_password": "Password@123"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":{"token":"1|5H4gXtymF8LlJkAghbSPLMoo8vNXL5sbGO3FN0iC3e03fb26","user":{"id":"user-bf2-fcb7-4ab5-8e38-e60fb3766306","name":"Cristiano Mendes","email":"cristiano@zenus.app"}},"message":"Registrado com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function register(RegisterRequest $request) {}

    /**
     *  @OA\POST(
     *      path="/auth/login",
     *      summary="Sign in",
     *      description="Sign in",
     *
     *      tags={"Auth"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "cristiano@mendes.dev", "password": "Password@123"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":{"token":"1|5H4gXtymF8LlJkAghbSPLMoo8vNXL5sbGO3FN0iC3e03fb26","user":{"id":"user-bf2-fcb7-4ab5-8e38-e60fb3766306","name":"Cristiano Mendes","email":"cristiano@zenus.app"}},"message":"Registrado com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function login(Request $request) {}

    /**
     *  @OA\DELETE(
     *      path="/auth/logout",
     *      summary="Sign out",
     *      description="Sign out",
     *      tags={"Auth"},
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Examples(example="result", value={"success":true,"data":"[]","message":"Você foi deslogado com sucesso."}, summary="An result object."),
     *         )
     *     )
     * )
     */
    public function logout(Request $request) {}
}
