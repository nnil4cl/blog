<?php

class Post extends Basemodel{

    protected $rules = array(

        'title' => 'required|max:255',
        'content' => 'required',

    );
    public $incrementing = false;






}