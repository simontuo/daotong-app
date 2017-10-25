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
}
