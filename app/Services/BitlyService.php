<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BitlyService
{
    public const GROUP = 'Bfc7dZwqV9n';
    protected PendingRequest $client;

    public function __construct()
    {
        $token = config('services.bitly.token');

        $this->client = Http::withToken($token)
                            ->acceptJson()
                            ->baseUrl('https://api-ssl.bitly.com/')
                            ->throw();
    }

    public function getCampaigns()
    {
        $response = $this->client->get('v4/campaigns');
        return $response->json();
    }

    public function getGroups()
    {
        $response = $this->client->get('v4/groups', [
            'organization_guid' => config('services.bitly.organization_id'),
        ]);
        return $response->throw()->json();
    }

    public function getGroup(string $groupGuid)
    {
        $response = $this->client->get('v4/groups/'.$groupGuid);
        return $response->throw()->json();
    }

    public function getChannels()
    {
        $response = $this->client->get('v4/channels');
        return $response->json();
    }

    public function create(string $url, string $domain = 'cran.ly', array $tags = [])
    {
        $response = $this->client->post('v4/bitlinks', [
            'long_url' => $url,
            'tags' => array_merge([
                'qr-app', "User ".optional(auth()->user())->id ?? 'guest',
            ], $tags),
            'domain' => $domain,
        ]);
        return $response->json();
    }

    public function getAllBitlinksbyGroup(): array
    {
        return Cache::remember('getAllBitlinks', now()->addHour(), function() {
            $groupGuid = self::GROUP;
            $data = $this->getBitlinksByGroup([
                'group_guid' => $groupGuid,
                'unit' => 'month',
                'size' => 100,
            ]);
            $cache = $data[ 'links' ];
            try {
                while (isset($data[ 'pagination' ][ 'next' ])) {
                    $data = $this->getBitlinksByGroup([
                        'page' => $data[ 'pagination' ][ 'page' ] + 1,
                    ]);
                    $cache = array_merge($cache, $data[ 'links' ]);
                }
            } catch (RequestException $exception) {
                //echo 'Error: '.$exception->getMessage().' - '.$exception->response->json()[ 'message' ];

            }

            return $cache;
        });
    }

    public function getBitlinksByGroup(array $data = [])
    {
        $groupGuid = $data[ 'group_guid' ] ?? self::GROUP;

        // try {
        $response = $this->client->get('v4/groups/'.$groupGuid.'/bitlinks', array_merge($data, [
            'unit' => 'month',
            'size' => 100,
        ]));

        return $response->json();
        //} catch (RequestException $requestException) {
        //  return $requestException->response->json();
        //}
    }

    public function restore(string $bitlinkId)
    {
        $response = $this->client->patch('v4/bitlinks/'.$bitlinkId, [
            'is_deleted' => false,
        ]);
        return $response->json();
    }

    public function delete(string $bitlinkId): \Illuminate\Http\Client\Response
    {
        // WARNING - this is a permanent delete
        return $this->client->delete('v4/bitlinks/'.$bitlinkId);
    }

    public function getPlanLimits(string $filterName = null): array
    {
        /*
         * $filterName can be:
         * All Encodes: $filterName: encodes
         * Branded Encodes: $filterName: bsd_encodes
         * Custom Back Halfs: $filterName: keyword_overrides
         */
        $organizationId = config('services.bitly.organization_id');
        $response = $this->client->get('v4/organizations/'.$organizationId.'/plan_limits');
        $allLimits = $response->json();

        if ($filterName) {
            return collect($allLimits[ 'plan_limits' ])->filter(function ($value, $key) use ($filterName) {
                return $value[ 'name' ] == $filterName;
            })->firstOrFail();
        }

        return $allLimits;
    }

    public function api(string $method, string $path, array $data = []): array
    {
        $response = $this->client->$method($path, $data);
        return $response->json();
    }

    public function customPost(string $long_url, string $custom = null, string $domain = "cran.ly"): array
    {
        $response = $this->client->post('v4/bitlinks', [
            'long_url' => $long_url,
            'domain' => $domain,
            'group_guid' => self::GROUP,
            //'custom_bitlinks' => $custom,
        ]);
        $return = $response->json();

        if ($custom) {
            $response = $this->client->patch('v4/custom_bitlinks/'.$custom, [
                'custom_bitlink' => $return[ 'id' ],
            ]);
            return $response->json();
        }
        return $return;
    }

    public function get(string $bitlink): array
    {
        $response = $this->client->get('v4/bitlinks/'.$bitlink);
        return $response->json();
    }

    public function getBrandedShortDomains(): array
    {
        $response = $this->client->get('v4/bsds');
        return $response->json();
    }


}
