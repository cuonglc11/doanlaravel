<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class GenericInsertService {
    public function insert( string $model , array $data )  : Model {
        if(!class_exists($model)) {
            throw new \InvalidArgumentException("Model $model không tồn tai");

        }
        if(!is_subclass_of($model , Model::class)) {
            throw new \InvalidArgumentException("Model $model khong phai eloquent");
        }
        return $model::create($data);
    }
}
?>
