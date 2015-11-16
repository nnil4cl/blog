<?php


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
        $content = Input::all();
        $post = new Post();

        foreach ($content['data'] as $obj) {
            if ($post->validate($obj)) {
                Post::create(array(
                    "title" => $obj['title'],
                    "content" => $obj['content'],
                ));


            } else {
                return Response::json(array(
                    'error' => $post->errors()),
                    500
                );

            }
        }

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

    public function update()
    {

        $content = Input::all();
        $post = new Post;
        foreach ($content['data'] as $object) {
            if ($post->validate($object)) {
                $posts = Post::find($object['id']);
                $posts->title = $object['title'];
                $posts->content = $object['content'];
                $posts->save();

            } else {
                return Response::json(array(
                    'error' => $post->errors()),
                    500
                );
            }
        }

        return Response::json(array('error' => false, 'msg' => 'post update'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return Response::json(array('error' => false, 'posts' => $post));
    }

    public function destroy($id)
    {
        $content = Input::all();
        foreach ($content['data'] as $object) {

            $post = Post::find($object['id']);
            $post->delete();

        }
        return Response::json(array('error' => false, 'msg' => 'post deleted'));

    }

   
}

//{"data":[{"title" : "test1" , "content":"content test"},{"title" : "test" , "content":"content test"}]}

