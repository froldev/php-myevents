<?php

namespace App\Controller;

use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function list(): string
    {
        $commentsManager = new CommentsManager();

        var_dump($_POST);

        $comments = $commentsManager->selectAnswerIsNull();

        return $this->twig->render('Admin/Comments/list.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function display(int $id): string
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectOneById($id);

        return $this->twig->render('Admin/Comments/display.html.twig', [
            'comments' => $comments,
        ]);
    }
}
