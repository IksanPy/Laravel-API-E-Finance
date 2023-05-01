<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

/**
 * 
 * @OA\Schema(
 *     schema="Meta",
 *     @OA\Property(
 *         property="code",
 *         type="integer",
 *         example=200
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         example="success"
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="User fetched"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="UserData",
 *     required={"id", "name", "email", "created_at", "updated_at"},
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         type="string",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time"
 *     )
 * )
 * 
 */

class UserController extends Controller
{
    /**
     * @OA\GET(
     *     path="/api/users",
     *     summary="Get all user",
     *     description="mengembalikan semua data user",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                   property="meta",
     *                   ref="#/components/schemas/Meta"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Schema(ref="#/components/schemas/UserData")
     *                  ),
     *                  example={
     *                     {"id": 1, "name": "Ahmad Iksan", "email": "iksan2437@gmail.com", "email_verified_at": null, "created_at": "2023-04-03T09:29:12.000000Z", "updated_at": "2023-04-03T09:29:12.000000Z"},
     *                     {"id": 2, "name": "Ahmad Faisal", "email": "faisal2437@gmail.com", "email_verified_at": null, "created_at": "2023-04-03T09:29:12.000000Z", "updated_at": "2023-04-03T09:29:12.000000Z"}
     *                  }
     * 
     *              )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $user = User::all();

        return ResponseFormatter::success('User fetched', $user);
    }

    /**
     * @OA\POST(
     *      path="/api/users/{id}",
     *      summary="Get User By Id",
     *      description="mengembalikan satu data user berdasarkan parameter ID",
     *      tags={"Users"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *         description="ID of the user to get",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                   property="meta",
     *                   ref="#/components/schemas/Meta"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/UserData",
     *              )
     *         )
     *     )
     * )
     *
     */



    public function show($id)
    {
        $user = User::find($id);

        return ResponseFormatter::success('User fetched', $user);
    }
}
