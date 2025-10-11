<?php

namespace App\Models\Traits;

use App\Filament\Resources\Funds\FundResource;
use App\Models\Fund;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToFund
{
    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function fundUrl(): ?string
    {
        if (!$this->fund) {
            return null;
        }
        return FundResource::getUrl('view', ['record' => $this->fund]);
    }
}
