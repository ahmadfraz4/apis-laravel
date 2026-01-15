<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dom\Mysql;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use mysqli;
use PDO;

use function Pest\Laravel\json;

class AuthController extends Controller
{
    public function signup(Request $req){
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];

        $validate = Validator::make($req->all(), $rules);
        if($validate->passes()){
            $users = new User;
            $users->name = $req->name;
            $users->email = $req->email;
            $users->password = bcrypt($req->password);
            $users->save();
            return response()->json(['status' => true, 'message' => 'User Registered', 'user' => $users], 200);
        }else{
            return response()->json(['status' => false, 'message' => 'Validation Error', 'errors' => $validate->errors()->all()], 401);
        }
    }


    public function login(Request $req){
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];

        
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            $user = Auth::user();
            return response()->json(['status' => true, 'message' => 'User Login', 'user' => $user, 
            'token' => $user->createToken('API Token')->plainTextToken, 'token_type' => 'bearer' ], 200);            
        }else{
            return response()->json(['status' => false, 'message' => 'Invalid User'], 401);
        }
    }

    public function logout(Request $req){
        $user = $req->user();
        $user->tokens('API Token')->delete();
        return response()->json(['status' => true, 'message' => 'User Logout'], 200);
    }
}


// php

$conn = mysqli_connect('localhost', 'username', 'pass', 'dbname');
// Select
$data = mysqli_query($conn,"select * from users");
$result = mysqli_fetch_assoc($data);
foreach($result as $row){

}

// oop mysqli

$conn = new mysqli('localhost', 'root', 'pass', 'dbname');
$result = $conn->query('Select * from user');
$res = $result->fetch_assoc();
// bind params

$stmt = $conn->prepare("INSERT into users (name, email) Values (?, ?) ");
$stmt->bind_param('ss', 'Ahad', 'asd@gmail');
$result = $stmt->execute();


// 

$pdo = new PDO('mysqli:host=localhost;dbname=users', 'username', 'password');
$stmt = $pdo->query('query');
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// for binding
$stmt = $pdo->prepare('query');
$result = $stmt->execute(['aasdas', 1]); // params to bind


