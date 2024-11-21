<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\UpdatesTeamNames;

class UpdateTeamName implements UpdatesTeamNames
{
    /**
     * Validate and update the given team's name.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, Team $team, array $input): void
    {
        Gate::forUser($user)->authorize('update', $team);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cif' => ['required', 'numeric', 'digits_between:6,8'],
            'cont_bancar' => ['nullable'],
        ], [
            'digits_between' => 'Campul trebuie sa contina intre 6 si 8 caractere.'
        ])->validateWithBag('updateTeamName');

        $team->forceFill([
            'name' => $input['name'],
            'cif' => $input['cif'],
            'cont_bancar' => $input['cont_bancar'],
        ])->save();
    }
}
