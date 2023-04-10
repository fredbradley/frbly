<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;

final readonly class Bitlink
{
    public string $bitlink_id;
    public string $slug;
    public string $long_url;
    public array $custom_bitlinks;
    public string $domain;
    public Carbon $created_at;

    public string $tags;
    public bool $archived;
    public bool $is_deleted;
    public ?string $title;

    public function __construct(array $bitlink)
    {
        $this->bitlink_id = $bitlink[ 'id' ];
        $this->slug = explode("/", $bitlink[ 'id' ])[ 1 ];
        $this->long_url = $bitlink[ 'long_url' ];
        $this->custom_bitlinks = $bitlink[ 'custom_bitlinks' ];
        $this->domain = $this->seperateDomainAndSlug($bitlink[ 'id' ])['domain'];
        $this->created_at = Carbon::parse($bitlink[ 'created_at' ]);

        $this->title = $bitlink[ 'title' ] ?? null;
        $this->tags = json_encode($bitlink[ 'tags' ]);
        $this->archived = $bitlink[ 'archived' ];
        $this->is_deleted = $bitlink[ 'is_deleted' ] ?? false;
    }
    private function seperateDomainAndSlug(string $bitlink_id): array
    {
        $domain = explode("/", $bitlink_id)[ 0 ];
        $slug = explode("/", $bitlink_id)[ 1 ];
        return [
            'domain' => $domain,
            'slug' => $slug,
        ];
    }
}
