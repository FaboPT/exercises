<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;

class UserController
{
    private $requestMethod;
    private $id;

    public function __construct($requestMethod, $id)
    {
        $this->requestMethod = $requestMethod;
        $this->id = $id;
    }

    public function switchRequest()
    {
        $request = (array)json_decode(file_get_contents('php://input'), TRUE);
        switch ($this->requestMethod) {
            case "GET":
                if ($this->id) {
                    $response = $this->show($this->id);
                } else {
                    $response = $this->index();
                };
                break;
            case "POST":
                $response = $this->store($request);
                break;
            case "PUT":
                $response = $this->update($request, $this->id);
                break;
            case "DELETE":
                $response = $this->destroy($this->id);
                break;
            default:
                $response = $this->notFound();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }

    }

    public function index()
    {
        $items = User::all();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($items);
        return $response;
    }

    public function store($request)
    {
        DB::connection()->beginTransaction();
        try {
            User::create($request);
            DB::connection()->commit();
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = json_encode(["message" => "User successfully created"]);;
            return $response;

        } catch (\Exception $e) {
            DB::connection()->rollBack();
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = json_encode(["error" => $e->getMessage()]);
            return $response;
        }

    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($item);
        return $response;

    }

    public function update($request, $id)
    {
        $item = User::findOrfail($id);
        DB::connection()->beginTransaction();
        try {
            $item->update($request);
            DB::connection()->commit();
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode(["message" => "User successfully updated"]);;;
            return $response;
        } catch (\Exception $e) {
            var_dump($e);
            DB::connection()->rollBack();
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = json_encode(["error" => $e->getMessage()]);;
            return $response;
        }
    }

    public function destroy($id): array
    {
        $item = User::findOrFail($id);
        DB::connection()->beginTransaction();
        try {
            $item->delete($id);
            DB::connection()->commit();
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode(["message" => "User successfully deleted"]);;;
            return $response;

        } catch (\Exception $e) {
            DB::connection()->rollBack();
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = json_encode(["error" => $e->getMessage()]);;
            return $response;
        }
    }

    public function notFound(): array
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode(["message" => "URL Invalid"]);;
        return $response;
    }
}
