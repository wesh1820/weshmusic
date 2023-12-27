<?php

use craft\elements\Entry;
use craft\elements\Asset;

return [
    'endpoints' => [
        '/api/album' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'album'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $songs = [];
                    $artists = [];

                    
                    $songsEntries = $entry->songs->all();

                    foreach ($songsEntries as $songsEntry) {
                        $songs[] = [
                            'id' => $songsEntry->id,
                            'title' => $songsEntry->title,
                        ];
                    }

                   
                    $artistEntries = $entry->artists->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artists[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, 
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'songs' => $songs,
                        'artists' => $artists,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                    ];
                },
            ];
        },
        '/api/song' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'song'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $artists = [];

                   
                    $artistEntries = $entry->artists->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artists[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, 
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artists' => $artists,
                        'genre' => $entry->genre,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                    ];
                },
            ];
        },
        '/api/artist' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'artist'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $songs = [];

                   
                    foreach ($entry->songs->all() as $song) {
                        $songs[] = [
                            'id' => $song->id,
                            'title' => $song->title,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'nationality' => $entry->nationality,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'songs' => $songs,
                    ];
                },
            ];
        },

        '/api/album/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $songs = [];

                  
                    foreach ($entry->songs->all() as $song) {
                        $songs[] = [
                            'id' => $song->id,
                            'title' => $song->title,
                        ];
                    }
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artists' => $entry->artists,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'songs' => $songs,
                    ];
                },
            ];
        },
        '/api/song/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $artists = [];

                   
                    $artistEntries = $entry->artists->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artists[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, 
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artists' => $artists,
                        'genre' => $entry->genre,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                    ];
                },
            ];
        },
        '/api/artist/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $songs = [];

                  
                    foreach ($entry->songs->all() as $song) {
                        $songs[] = [
                            'id' => $song->id,
                            'title' => $song->title,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'nationality' => $entry->nationality,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'songs' => $songs,
                    ];
                },
            ];
        },
    ],
];
