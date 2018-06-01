<?php

namespace App;

use ScoutElastic\SearchRule;

class VideoSearchRule extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        //
    }

    /**
     * @inheritdoc
     */
    public function buildQueryPayload()
        {
            $query = $this->builder->query;
            return [
                'should' => [
                    [
                        'match' => [
                            'title' => [
                                'query' => $query,
                                'boost' => 5
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'description' => [
                                'query' => $query,
                                'boost' => 1
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'captions' => [
                                'query' => $query,
                                'boost' => 0
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'channel_name' => [
                                'query' => $query,
                                'boost' => 2
                            ]
                        ]
                    ]
                ]
            ];
        }
}