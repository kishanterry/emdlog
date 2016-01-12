<?php

namespace App\Models\Traits;

trait CreatesSlugs
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}