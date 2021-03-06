<?php

namespace App;

use App\Traits\Events;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Contacts\app\Traits\Contactable;
use LaravelEnso\CommentsManager\app\Traits\Commentable;
use LaravelEnso\AddressesManager\app\Traits\Addressable;
use LaravelEnso\DocumentsManager\app\Traits\Documentable;

class Individual extends Model
{
    use Contactable, Commentable, Documentable, Addressable, Events;

    protected $appends = ['name'];

    protected $fillable = ['first_name', 'last_name', 'is_active', 'gender_id', 'type_id'];

    protected $attributes = ['is_active' => false];

    protected $casts = ['is_active' => 'boolean'];

    public function families()
    {
        return $this->belongsToMany(Family::class);
    }

    public function children()
    {
        return $this->belongsToMany(self::class, 'child_parent', 'child_id', 'parent_id');
    }

    public function parents()
    {
        return $this->belongsToMany(self::class, 'child_parent', 'parent_id', 'child_id');
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
