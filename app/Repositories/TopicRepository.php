<?php
namespace App\Repositories;

use App\Models\Topic;

class TopicRepository
{
    /**
     * [getTopicsByQuery description]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function getTopicsByQuery($query)
    {
        return Topic::where('name', 'like', '%'.$query.'%')->get();
    }

    /**
     * [setQueryToTopics description]
     * @param [type] $topics [description]
     * @param [type] $query  [description]
     */
    public function setQueryToTopics($topics, $query)
    {
        return !!Topic::where('name', $query)->count() ? $topics : collect($topics)->prepend(['id' => '?'.$query, 'name' => $query]);
    }

    /**
     * [normalizeTopic description]
     * @param  array  $topics  [description]
     * @param  [type] $crement [description]
     * @return [type]          [description]
     */
    public function normalizeTopic(array $topics, $crement)
    {
        return collect($topics)->map(function($topic) use($crement) {
            if (is_numeric($topic)) {
                Topic::find($topic)->increment($crement);
                return (int) $topic;
            }

            $topic = last(explode('?', $topic));
            $newTopic = Topic::create(['name' => $topic, $crement => 1]);
            return $newTopic->id;
        })->toArray();
    }

    public function hot()
    {
        return Topic::orderByRaw('articles_count + questions_count + followers_count DESC')->paginate(10);
    }
}
