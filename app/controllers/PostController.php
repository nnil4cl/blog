<?php

use Rhumsaa\Uuid\Uuid;

class PostController extends \BaseController
{
    public function index()
    {
        $post = Post::all();
        return Response::json(array(
            'post' => $post
        ));
    }

    public function store()
    {
        $data = array(

            'title' => Input::get('title'),
            'content' => Input::get('content')
        );
        $post = new Post();

        if ($post->validate($data)) {

            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->save();

            return Response::json(array(
                'error' => false,
                'msg' => 'post inserted'),
                200
            );
        }
        return Response::json(array(
            'error' => $post->errors()),
            500
        );
    }

    public function create()
    {
        $data = array(

            'title' => Input::get('title'),
            'content' => Input::get('content')
        );
        $post = new Post();

        if ($post->validate($data)) {
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->save();

            return Response::json(array(
                'error' => false,
                'msg' => 'post inserted'),
                200
            );
        }
        return Response::json(array(
            'error' => $post->errors()),
            500
        );
    }

    public function update($id)
    {

        $post = Post::findOrFail($id);

        if (Input::get('title')) {
            $post->title = Input::get('title');
        }

        if (Request::get('content')) {
            $post->content = Input::get('content');
        }

        

        if ($post->save()) {
            return Response::json(array(
                'error' => false,
                'msg' => 'post updated!'),
                200
            );
        } else {

            return Response::json(array('error' => true), 500);
        }

    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return Response::json(array('error' => false, 'posts' => $post));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (!$post) {
            return Response::json(array('error' => true), 500);

        } else
            $post->delete();
        return Response::json(array(' error' => false, 'msg' => 'post deleted'), 200);
    }
}
