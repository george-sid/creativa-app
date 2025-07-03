<?php

return [
    'supported' => json_decode(env('SUPPORTED_LANGUAGES', '{"en":"English","el":"Greek"}'), true),
];
