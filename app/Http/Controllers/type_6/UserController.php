<?php

namespace App\Http\Controllers\type_6;

use Carbon\Carbon;
use App\Models\user6;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
     /**
     * @OA\Post(
     *    summary="add tracking",
     *     path="/api/type_6/user",
     *     tags={"Type_6"},
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
     *          (type="integer")
     *     ),
     * 
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'string' ,
            'surname' => 'string',
            'position_id' => 'integer',
            'dept_id' => 'integer',
        ]);
        if($validator->fails()){
            return [
                'errors' => $validator->errors()
            ];
        }
        $token = bin2hex(openssl_random_pseudo_bytes(8));
        $date_start = Carbon::now()->format('y:m:d h:i:s');
        $user = user6::create([
            'name' => $request->name,
            'position_id' => $request->position_id,
            'dept_id' => $request->dept_id,
            'date_start' => $date_start,
            'date_end' => $date_start,
            'current' => 1,
            'token' => $token,
        ]);
        return $user;
    }
 /**
     * @OA\Get(
     *    summary="add tracking",
     *     path="/api/type_6/user",
     *     tags={"Type_6"},
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function index(){
        return user6::where('current' , 1)->get();
    }

    /**
     * @OA\Patch(
     *    summary="adad tracking",
     *     path="/api/type_6/user/{id}",
     *     tags={"Type_6"},
     * 
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     *  @OA\Parameter(
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
     *          (type="integer")
     *     ),
     * 
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function update(Request $request , $id){
        $validator = Validator::make($request->all(), [
            'id' => Rule::exists(user6::class , 'id'),
            'name' => 'string',
            'surname' => 'string',
            'position_id' => 'integer',
            'dept_id' => 'integer',
        ]);
        if($validator->fails()){
            return [
                'errors' => $validator->errors()
            ];
        }
        $validator = Validator::make(['id' => $id] ,[
            'id' => Rule::exists(user6::class),
        ]);
        if($validator->fails()){
            return [
                'errors' => $validator->errors()
            ];
        }
        $user = user6::find($id);
        $token = $user->token;
        $date_end = Carbon::now()->format('y:m:d h:i:s');
        $user->date_end =  $date_end;
        $user->current = 0;
        $user->save();
        $new_user = user6::create([
            'name' => $request->name,
            'position_id' => $request->position_id,
            'dept_id' => $request->dept_id,
            'date_start' => $date_end,
            'date_end' => $date_end,
            'current' => 1,
            'token' => $token,
        ]);
        return $new_user;
    }
    public function show($id){
        $token  = user6::find($id)->token;
        return user6::where('token' , $token)->get();
    }

}
