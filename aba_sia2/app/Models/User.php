<?php
 namespace App\Models;
 use Illuminate\Database\Eloquent\Model;
 class User extends Model{

     public $timestamps = false;
    
    protected $table = 'tbluser';
    // column sa table
     protected $fillable = [
        'Name', 'Edad', 'Gender'
     ];
     
 }