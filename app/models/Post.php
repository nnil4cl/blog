<?php

class Post extends Basemodel{

    protected $fillable = array('title', 'content');
    protected $rules = array(

        'title' => 'required|max:255',
        'content' => 'required',

    );
    public $incrementing = false;






}