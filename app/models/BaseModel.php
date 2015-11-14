<?php

use Rhumsaa\Uuid\Uuid;

class BaseModel extends Eloquent
{

    protected $rules = array();
    protected $errors;
    public $incrementing = false;


    protected static function boot()
    {
        parent::boot();


        static::creating(function ($model) {
            $model->id = md5(uniqid(str_random(36)));
        });

        // by package*******************************

        /*static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string)$model->generateNewId();
        });*/
    }

    /**
     * Get a new version 4 (random) UUID.
     *
     * @return \Rhumsaa\Uuid\Uuid
     */
    public function generateNewId()
    {
        return Uuid::uuid4();
    }

    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules);
        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }


}