<?php

namespace App\Http\Controllers\type_3;

use Carbon\Carbon;
use App\Models\User3;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
       /**
     * @OA\Post(
     *    summary="add tracking",
     *     path="/api/type_3/user",
     *     tags={"Type_3"},
     * 
     *   @OA\Parameter(
     *     name="name",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',

        ]);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors()]);
        }
        $token = bin2hex(openssl_random_pseudo_bytes(8));
        $user = User3::create([
            'token' => $token,
            'name' => $request->name,
            'email' => $request->email,
            'old_email' => $request->email,
            'current' => 1,
        ]);
        return response()->json(['user_id' => $user]);
    }
    /**
     * @OA\Get(
     *    summary="add tracking",
     *     path="/api/type_3/user",
     *     tags={"Type_3"},
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function index(){
        $users  = User3::where('current' , 1)->get();
        return $users;
    }
    /**
     * @OA\Patch(
     *    summary="adad tracking",
     *     path="/api/type_3/user/{id}",
     *     tags={"Type_3"},
     * 
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     *  @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     @OA\Schema
     *          (type="string")
     *     ),
     *     @OA\Response(response="200", description="Display a listing of type-auto."),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Not Found"),
     * )
     */
    public function update(Request $request , $id){
        $user = User3::find($id);
        $token = $user->token;
        $user->current = 0;
        $users = User3::where('token' , $token)->get();
        for ($i=0; $i < $users->count(); $i++) { 
            $users[$i]->current = 0;
            $users[$i]->save();
        }
        $name = $user->name;
        $old_email = $user->email;
        $user->save();
        $user = User3::create([
            'token' => $token,
            'name' => $name,
            'email' => $request->email,
            'old_email' => $old_email,
            'current' => 1,
        ]);

        return $user;
    }
    /**
     * @OA\Get(
     *    summary="add tracking",
     *     path="/api/type_3/user/{id}",
     *     tags={"Type_3"},
     *     @OA\Parameter(
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
        $validator = Validator::make(['id'=>$id],[
            'id' => Rule::exists(User3::class,'id'),
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        $users = User3::where('token' , User3::find($id)->token)->get();
        return $users;
    }

}
