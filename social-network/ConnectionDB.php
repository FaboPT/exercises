<?php

use App\Models\Greeting;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Schema\Blueprint;

require "bootstrap.php";


class ConnectionDB
{


    public function createTable()
    {
        try {
            DB::schema()->create('authors', function (Blueprint $table) {
                $table->id();
                $table->string('name',255);
                $table->email('email');
                $table->password('name',255);
                $table->timestamps();
                $table->softDeletes();
            });
            echo 'Table author successfully created';
            '<br>';
            DB::schema()->create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('message', 255)->nullable();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->timestamps();
                $table->softDeletes();
            });
            DB::schema()->create('replies', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->references('id')->on('users');
                $table->foreignId('post_id')->references('id')->on('posts');
                $table->timestamps();
                $table->softDeletes();
            });
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }


    public function insertData()
    {
        try {
            echo 'Insert data successfully';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


$db = new ConnectionDB();



