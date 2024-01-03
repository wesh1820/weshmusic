<?php

use craft\elements\Entry;

return [
    'endpoints' => [
        '/api/album' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'album'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $song = [];
                    $artist = [];

                    $songEntries = $entry->song->all();
                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                        ];
                    }

                    $artistEntries = $entry->artist->all();
                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'song' => $song,
                        'artist' => $artist,
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
                    $artist = [];

                    $artistEntries = $entry->artist->all();
                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artist' => $artist,
                        'genre' => $entry->genre,
                        'duration' => $entry->duration,
                        'videoclip' => $entry->videoclip,
                        'lyrics' => $entry->lyrics,
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
                    $song = [];
                    $songEntries = $entry->song->all();

                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                            'duration' => $songEntry->duration,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'nationality' => $entry->nationality,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'song' => $song,
                    ];
                },
            ];
        },
        '/api/new' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'new'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $song = [];
                    $songEntries = $entry->song->all();

                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                            'duration' => $songEntry->duration,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'song' => $song,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
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
                    $song = [];

                    foreach ($entry->song->all() as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                        ];
                    }
                    $artist = [];

                    foreach ($entry->artist->all() as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title,
                        ];
                    }
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artist' => $entry->artist,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'song' => $song,
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
                    $artist = [];

                    $artistEntries = $entry->artist->all();
                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artist' => $artist,
                        'genre' => $entry->genre,
                        'duration' => $entry->duration,
                        'videoclip' => $entry->videoclip,
                        'lyrics' => $entry->lyrics,
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
                    $song = [];
                    $songEntries = $entry->song->all();

                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                            'duration' => $songEntry->duration,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'nationality' => $entry->nationality,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'song' => $song,
                    ];
                },
            ];
        },
        '/api/new/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $song = [];
                    $songEntries = $entry->song->all();

                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title,
                            'duration' => $songEntry->duration,
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'bannerImage' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('bannerImage')),
                        'song' => $song,
                    ];
                },
            ];
        },
    ],
];
