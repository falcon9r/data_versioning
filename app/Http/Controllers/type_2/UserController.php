<?php

namespace App\Http\Controllers\type_2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   /**
     * @OA\Post(
     *    summary="add tracking",
     *     path="/api/type_2/user",
     *     tags={"Type_2"},
     * 
     *   @OA\Parameter(
     *     name="name",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     * @OA\Parameter(
     *     name="surname",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     * @OA\Parameter(
     *     name="dept_id",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="integer")
     *     ),
     * @OA\Parameter(
     *     name="position_id",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="integergi")
     *     ),
     * 
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'surname' => 'required',
            'position_id' => 'required|numeric',
            'dept_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors()]);
        }
        $token = bin2hex(openssl_random_pseudo_bytes(8));
        $date_start = Carbon::now()->format('y:m:d h:i:s');
        $user = User::create([
            'token' => $token,
            'name' => $request->name,
            'surname' => $request->surname,
            'position_id' => $request->position_id,
            'dept_id' => $request->dept_id,
            'date_start' => $date_start,
            'current' => 1,
            'date_end' => $date_start // date end when update
        ]);
        return response()->json(['user_id' => $user]);

    }
}
