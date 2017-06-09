<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsApiResponseStructureTest extends TestCase
{
    protected $commentStructure = ['id', 'body', 'answers', 'parent_id'];
    protected $endpoint = '/api/comments/';
    protected $table = 'comments';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRead()
    {
        $response = $this->get($this->endpoint);
        $response
            ->assertStatus(200);
        $data = $response->decodeResponseJson();
        if (is_array($data)) {
            if (!empty($data)) {
                $response->assertJsonStructure([$this->commentStructure]);
                $responseOne = $this->get($this->endpoint . $data[0]['id']);
                $responseOne
                    ->assertStatus(200)
                    ->assertJsonStructure($this->commentStructure);
            } else {
                $response->assertJson([]);

            }
        }
    }

    public function testCreate()
    {
        $testCommentData = ['body' => 'Test Comment'];
        $response = $this->json('POST', $this->endpoint, $testCommentData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->commentStructure)
            ->assertJsonFragment($testCommentData);
        $newCommentData = $response->decodeResponseJson();
        $this->assertDatabaseHas($this->table, $testCommentData);

        $testAnswerData = ['body' => 'Test Answer', 'parent_id' => $newCommentData['id']];
        $answerResponse = $this->json('POST', $this->endpoint, $testAnswerData);
        $answerResponse
            ->assertStatus(200)
            ->assertJsonStructure($this->commentStructure)
            ->assertJsonFragment($testAnswerData);
        $this->assertDatabaseHas($this->table, $testAnswerData);
    }

    public function testUpdate()
    {
        $testCommentData = ['body' => 'Test Comment'];
        $id = $this
            ->json('POST', $this->endpoint, $testCommentData)
            ->decodeResponseJson()['id'];

        $testCommentUpdateData = ['body' => 'Test Comment Updated'];
        $response = $this->json('PUT', $this->endpoint . $id, $testCommentUpdateData);
        $response
            ->assertStatus(200)
            ->assertJsonStructure($this->commentStructure)
            ->assertJsonFragment($testCommentUpdateData);
        $this->assertDatabaseHas($this->table, $testCommentUpdateData);
    }

    public function testDelete()
    {
        $testCommentData = ['body' => 'Test Comment To Delete'];
        $id = $this
            ->json('POST', $this->endpoint, $testCommentData)
            ->decodeResponseJson()['id'];

        $response = $this->json('DELETE', $this->endpoint . $id);
        $response
            ->assertStatus(200);
        $this->assertDatabaseMissing($this->table, ['id' => $id]);
    }
}
