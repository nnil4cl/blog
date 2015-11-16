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


                }else{
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
        foreach($content['data'] as $object){

          $post = Post::find($object['id']);
            $post->title = $object['title'];
            $post->content = $object['content'];
            $post->save();

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
//        $post = Post::findOrFail($id);
//        if (!$post) {
//            return Response::json(array('error' => true), 500);
//
//        } else
//            $post->delete();
//        return Response::json(array(' error' => false, 'msg' => 'post deleted'), 200);
        $content = Input::all();
        foreach($content['data'] as $object){

            $post = Post::find($object['id']);

            $post->delete();

        }

        return Response::json(array('error' => false, 'msg' => 'post update'));



    }

    public function custom()
    {

        $content = Input::all();
        foreach ($content['data'] as $obj) {
            foreach ($obj as $key => $val) {
                print $key . ':' . $val . '<br/>';
            }
        }


    }
}
//{
//    "data":[
//    {"title" : "test" , "content":"content test"},
//    {"title" : "test1" ,"content":"content test"}
//
//    ]
//}

//{"data":[{"title" : "test1" , "content":"content test"},{"title" : "test" , "content":"content test"}]}

