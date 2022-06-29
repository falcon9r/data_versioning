<?php

namespace App\Http\Controllers\type_4;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User4;
use App\Models\User4_history;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     /**
     * @OA\Post(
     *    summary="add tracking",
     *     path="/api/type_4/user",
     *     tags={"Type_4"},
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
        $user = User4::create([
            'token' => $token,
            'name' => $request->name,
            'surname' => $request->surname,
            'position_id' => $request->position_id,
            'dept_id' => $request->dept_id,
        ]);
        return response()->json(['user_id' => $user]);
    }
    /**
     * @OA\Get(
     *    summary="add tracking",
     *     path="/api/type_4/user",
     *     tags={"Type_4"},
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function index(){
        $users  = User4::where('id' ,'>' ,0)->get();
        return $users;
    }

     /**
     * @OA\Patch(
     *    summary="adad tracking",
     *     path="/api/type_4/user/{id}",
     *     tags={"Type_4"},
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
        
        $user = User4::find($id);
        $last_user = User4_history::create([
            'token' => $user->token,
            'name' =>$user->name,
            "surname" => $user->surname,
            "position_id" => $user->position_id,
            "dept_id" => $user->dept_id,
        ]);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'position_id' => $request->position_id,
            'dept_id' => $request->dept_id,
        ]);
        return $last_user;
    }
      /**
     * @OA\Get(
     *    summary="add tracking",
     *     path="/api/type_4/user/{id}",
     *     tags={"Type_4"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema
     *          (type="integer")
     *     ),
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function show($id){
        $user  = User4::find($id);
        $users = User4_history::where('token' , $user->token)->get();
        return $users;
    }
}
