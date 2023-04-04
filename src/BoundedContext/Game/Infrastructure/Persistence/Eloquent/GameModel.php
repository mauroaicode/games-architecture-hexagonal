<?php

namespace Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameModel extends Model
{
    use HasFactory;

    protected $table = 'games';
    public $incrementing = false;
    protected $keyType = 'string';
//    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $this->setConnection('mysql');
        parent::__construct($attributes);
    }

    protected static function newFactory()
    {
        return GameModelFactory::new();
    }
}
