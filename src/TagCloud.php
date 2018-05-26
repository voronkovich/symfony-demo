<?php

namespace App;

use App\Repository\TagRepository;

/**
 * Tag cloud generator.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TagCloud
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function generateTagCloud(int $limit = 10, float $maxWeight = 2): array
    {
        if (1 >= $maxWeight) {
            throw new \InvalidArgumentException('Max. weight should be more than 1.');
        }

        $tags = $this->tagRepository->findMostPopular($limit);

        $minCount = $tags[count($tags) - 1]['count'];
        $maxCount = $tags[0]['count'];

        $tagCloud = [];
        foreach ($tags as [ 0 => $tag, 'count' => $count]) {
            $tagCloud[] = [
                'name' => $tag->getName(),
                'weight' => $this->caclculateWeigth($count, $minCount, $maxCount, $maxWeight)
            ];
        }

        return $tagCloud;
    }

    private function caclculateWeigth(int $tagCount, int $minCount, int $maxCount, float $maxWeight): float
    {
        $weight = 1;

        if (min($tagCount, $maxCount) > $minCount) {
            $weight += round(($maxWeight - 1) * ($tagCount - $minCount) / ($maxCount - $minCount), 2);
        }

        return $weight;
    }
}
