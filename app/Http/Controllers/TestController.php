<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class TestController extends Controller
{
    private $database;

    public function __construct(){
        $this->database = \App\Services\FirebaseService::connect();
    }
    public static function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }

    public function index() 
    {
        return response()->json($this->database->getReference('test/blogs')->getValue());
    }
    
    public function create(Request $request){
        $this->database
            ->getReference('test/blog/' . $request['title'])
            ->set([
                'title' => $request['title'],
                'content' => $request['content']
            ]);
        return response()->json(['message' => 'Berhasil di tambahkan']);
    }
}
