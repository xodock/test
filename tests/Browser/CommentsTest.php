<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentsTest extends DuskTestCase
{
    public function testCreatedCommentAppears()
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/')
                ->type('comment_body', 'My Comment')
                ->press('Add Comment')
                ->whenAvailable('.comment-item', function ($comment) {
                    $comment->assertSeeIn('p.comment_body', 'My Comment');
                });
        });
    }

    public function testAnswerAppears()
    {
        $this->browse(function ($browser) {
            $browser
                ->visit('/')
                ->waitFor('.comment-item')
                ->press('Answer')
                ->waitForText('Answer Comment')
                ->type('comment_body', 'My Answer')
                ->press('Add Comment')
                ->whenAvailable('.answers .comment-item', function ($comment) {
                    $comment->assertSeeIn('p.comment_body', 'My Answer');
                });
        });
    }

    public function testEditedCommentChanges()
    {

        $this->browse(function ($browser) {
            $comment_body = "";
            $browser
                ->visit('/')
                ->whenAvailable('.comment-item', function ($comment) use (&$comment_body) {
                    $comment_body = $comment->text('.comment_body');
                })
                ->press('Edit')
                ->waitForText('Edit Comment')
                ->assertValue('textarea#comment_body', $comment_body)
                ->type('comment_body', 'My Updated Comment')
                ->press('Edit Comment')
                ->whenAvailable('.comment-item', function ($comment) {
                    $comment->assertSeeIn('p.comment_body', 'My Updated Comment');
                });
        });
    }

    public function testDeletedCommentDisappears()
    {

        $this->browse(function ($browser) {
            $browser
                ->visit('/')
                ->whenAvailable('.comment-item', function ($comment) {
                    $comment
                        ->press("Delete");
                })
                ->waitUntilMissing('.comment-item');
        });
    }
}
