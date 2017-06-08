<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = [
        'answers'
    ];
    protected $fillable = ['body', 'parent_id'];

    public function answers()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public static function getCommentsTree()
    {
        return self::hasNot('parent')->get();
    }

    public static function hasNot($rel)
    {
        if (!$rel)
            return false;
        return self::has($rel, '<', 1);
    }
}
