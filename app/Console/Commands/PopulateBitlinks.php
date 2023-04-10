<?php

namespace App\Console\Commands;

use App\DataTransferObjects\Bitlink as BitlinkDto;
use App\Models\Bitlink;
use App\Services\BitlyService;
use Illuminate\Console\Command;

class PopulateBitlinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-bitlinks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate bitlinks from the API';

    public function __construct(protected BitlyService $bitly)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        activity()->log("Populating bitlinks");
        $bitlinks = $this->bitly->getAllBitlinksbyGroup();

        foreach ($bitlinks as $bitlink) {

            $bitlinkDto = new BitlinkDto($bitlink);

            $this->alert($bitlinkDto->created_at);

            Bitlink::updateOrCreate([
                'bitlink_id' => $bitlinkDto->bitlink_id,
            ], [
                'slug' => $bitlinkDto->slug,
                'created_at' => $bitlinkDto->created_at,
                'long_url' => $bitlinkDto->long_url,
                'custom_bitlinks' => $bitlinkDto->custom_bitlinks,
                'domain' => $bitlinkDto->domain,
                'title' => $bitlinkDto->title,
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        }
        activity()->log("Populating bitlinks completed");
    }
}
