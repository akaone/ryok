<?php

use function Pest\Livewire\livewire;
use App\Models\User;
use App\Models\App;
use App\Models\AppUser;
use App\Http\Livewire\LivewireAppsUsersCreate;
use App\Http\Livewire\LivewireAppsUsersShow;
use App\Rules\IsMemberAlreadyAppUser;
use PascalDeVink\ShortUuid\ShortUuid;
use Ramsey\Uuid\Uuid;


# users with app-read permission can see the list of submitted app

# staff with app-state permission can validate an app

# staff with app-state permission can reject an app

# staff with app-state permission can deactivate an app

# only staff with permission can see app payments