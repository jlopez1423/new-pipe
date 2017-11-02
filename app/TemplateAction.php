<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateAction extends Model
{
    public function template()
    {
        return $this->belongsToMany('App\TemplateAction', 'template_items')->withPivot('id')->withTimestamps();
    }
}
