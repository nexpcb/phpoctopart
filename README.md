# phpoctopart
A php library for octopart v3 restful API. If using Laravel, install [laravel-octopart package](https://github.com/nexpcb/laravel-octopart)

## Installation

(If using laravel-octopart package, skip below steps)

1. `composer require "nexpcb/phpoctopart"`
2. Get Octopart apikey from its dashboard

## Examples

- Get single brand by uid

`NexPCB\PHPOctopart\OctopartClient::create(['apikey' => 'xxxxxxx'])->getBrandByUID('2239e3330e2df5fe');`

- Search brands

`NexPCB\PHPOctopart\OctopartClient::create(['apikey' => 'xxxxxxx'])->searchBrands(['q' => 'texas']);`

- Get multiple brands with multiple uids

`NexPCB\PHPOctopart\OctopartClient::create(['apikey' => 'xxxxxxx'])->getMultipleBrands(['uid' => ['2239e3330e2df5fe', '56b297b87fa88175']]);`
