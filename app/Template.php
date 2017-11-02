<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TemplateAction;

class Template extends Model
{

    public function actions()
    {
        return $this->belongsToMany('App\TemplateAction', 'template_items')->withPivot('id')->withTimestamps();
    }

    public function all_actions()
    {
        return TemplateAction::all();
    }



}
