<?php
namespace App\Repositories;

use App\Type;

class TypeRepositories{
    public function getAllActive(){
        return Type::where(['active' => 1])
                ->orderBy('id', 'asc')
                ->get();
    }

    public function getAllFiltered($keyword = ''){
        if(!empty($keyword)){
            $types = Type::where('name', 'like', '%' . $name . '%')->paginate(10);
        }else{
            $types = Type::paginate(10);
        }

        return $types;
    }

    public function findById($id){
        $type = Type::where(['id' => $id])->first();
        return $type;
    }
}
