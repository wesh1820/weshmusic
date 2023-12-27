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
                    $song = [];
                    $artist = [];

                    // Assuming 'artist' is a field that directly relates to the artist entry
                    $songEntries = $entry->song->all();

                    foreach ($songEntries as $songEntry) {
                        $song[] = [
                            'id' => $songEntry->id,
                            'title' => $songEntry->title, // Assuming 'title' is the artist's name
                        ];
                    }

                    // Assuming 'artist' is a field that directly relates to the artist entry
                    $artistEntries = $entry->artist->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, // Assuming 'title' is the artist's name
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

                    // Assuming 'artist' is a field that directly relates to the artist entry
                    $artistEntries = $entry->artist->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, // Assuming 'title' is the artist's name
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artist' => $artist,
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
                    $song = [];

                    // Loop through the song related to the artist
                    foreach ($entry->song->all() as $song) {
                        $song[] = [
                            'id' => $song->id,
                            'title' => $song->title,
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

        '/api/album/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $song = [];

                    // Loop through the song related to the artist
                    foreach ($entry->song->all() as $song) {
                        $song[] = [
                            'id' => $song->id,
                            'title' => $song->title,
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

                    // Assuming 'artist' is a field that directly relates to the artist entry
                    $artistEntries = $entry->artist->all();

                    foreach ($artistEntries as $artistEntry) {
                        $artist[] = [
                            'id' => $artistEntry->id,
                            'title' => $artistEntry->title, // Assuming 'title' is the artist's name
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'artist' => $artist,
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
                    $song = [];

                    // Loop through the song related to the artist
                    foreach ($entry->song->all() as $song) {
                        $song[] = [
                            'id' => $song->id,
                            'title' => $song->title,
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
    ],
];
