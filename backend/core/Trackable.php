<?php

namespace Core;

trait Trackable {

    protected static function bootTrackable(){
        static::creating(fn($model)=>$model->created_by=auth()->guard()->id());
        static::updating(fn($model)=>$model->updated_by=auth()->guard()->id());
    }
}
