<?php

namespace App\Controller;

use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function list(): string
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAll();

        return $this->twig->render('Comments/_list.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function answer(int $id): string
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectOneById($id);

        return $this->twig->render('Comments/_answer.html.twig', [
            'comments' => $comments,
        ]);
    }
}
