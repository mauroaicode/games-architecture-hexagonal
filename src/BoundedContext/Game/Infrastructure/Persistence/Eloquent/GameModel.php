<?php

namespace Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $table = 'games';
    public $incrementing = false;
    public $timestamps = false;

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
