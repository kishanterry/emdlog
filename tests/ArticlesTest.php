<?php

use App\Models\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticlesTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_creates_an_article()
    {
        $user = factory(App\Models\User::class)->create();
        $this->actingAs($user)
            ->visit('articles/create')
            ->type('Dummy Title', 'title')
            ->type('Dummy Body', 'article')
            ->click('Publish');

        $this->seeInDatabase('articles', [
            'title' => 'Dummy Title',
            'slug' => 'dummy-title',
            'published' => true,
            'author_id' => $user->id
        ]);

        $article = Article::first();
        $file = "{$article->path}/{$article->file}";

        $this->assertTrue($this->app['files']->exists($file));
        $this->app['files']->delete($file);
    }
}
