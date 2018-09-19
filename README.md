# phpoctopart
A php library for octopart v3 restful API. If using Laravel, install [laravel-octopart package](https://github.com/nexpcb/laravel-octopart)

## Installation

(If using laravel-octopart package, skip below steps)

1. `composer require "nexpcb/phpoctopart"`
2. Get Octopart apikey from its dashboard

## Examples

`NexPCB\OctopartClient::create(['apikey' => 'xxxxxxx'])->getBrandByUID('2239e3330e2df5fe');`
`NexPCB\OctopartClient::create(['apikey' => 'xxxxxxx'])->searchBrands(['q' => 'texas']);`
`NexPCB\OctopartClient::create(['apikey' => 'xxxxxxx'])->getMultipleBrands(['uid' => ['2239e3330e2df5fe', '56b297b87fa88175']]);`
