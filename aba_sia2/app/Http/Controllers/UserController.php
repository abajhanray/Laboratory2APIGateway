<?php
namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
Class UserController extends Controller {
    use ApiResponser;
    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function getUsers(){
        $users = User::all();
        //$users = DB: :connection('mysql')
        //->select("Select * from tbluser");
 
        return $this->successResponse($users);
 
    }
    public function index(){
 
        $users = User::all();
        return $this->successResponse($users);
    }
    public function add(Request $request ){
        $rules = [
            'Name' => 'required|max:20',
            'Edad' => 'required|max:20',
            'Gender' => 'required|in:Male,Female',
    ];
    $this->validate($request,$rules);
    $user = User::create($request->all());
     return $this->successResponse($user, Response::HTTP_CREATED);
    }
    public function show($id){
        $user = User::findOrFail($id);
        return $this->successResponse($user);
    }
    public function update(Request $request,$id)
    {
        $rules = [
            'Name' => 'max:20',
            'Edad' => 'max:20',
            'Gender' => 'in:Male,Female',
        ];
        $this->validate($request, $rules);
        $user = User::findOrFail($id);
 
        $user->fill($request->all());
        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);

    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
            return $this->successResponse($user);
    }
}
