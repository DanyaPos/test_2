<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $articles = [
            ['title' => 'Заголовок один', 'slug' => 'first-article', 'is_active' => true, 'views' => 123, 'description' => 'Описание первой статьи'],
            ['title' => 'Заголовок два', 'slug' => 'second-article', 'is_active' => false, 'views' => 4560, 'description' => 'Описание второй статьи'],
            ['title' => 'Заголовок три', 'slug' => 'third-article', 'is_active' => true, 'views' => 768000, 'description' => 'Описание третьей статьи'],
            ['title' => 'Заголовок четыре', 'slug' => 'fourth-article', 'is_active' => true, 'views' => 9100000, 'description' => 'Описание четвертой статьи'],
        ];

        foreach ($articles as $data) {
            $article = new Article();
            $article->setTitle($data['title']);
            $article->setSlug($data['slug']);
            $article->setActive($data['is_active']);
            $article->setViews($data['views']);
            $article->setDescription($data['description']);
            $article->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($article);
        }

        $manager->flush();
    }
}
