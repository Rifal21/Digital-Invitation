<?php

namespace App\Imports;

use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuestsImport implements ToModel, WithHeadingRow
{
    protected $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row['nama'])) {
            return null;
        }

        return new Guest([
            'invitation_id' => $this->invitation->id,
            'name'          => $row['nama'],
            'phone'         => $row['phone'] ?? null,
            'group'         => $row['group'] ?? 'Umum',
            'slug'          => Str::slug($row['nama']) . '-' . Str::random(4),
        ]);
    }
}
