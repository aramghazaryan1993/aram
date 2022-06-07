<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    protected $table = 'menus';

    public function parent(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public static function getList(): array
    {
        $menu = [];

        $parents = static::whereNull('parent_id')->get();

        foreach ($parents as $index => $parent) {

            $menu[$parent->name] = [
                'name' => $parent->name,
                'id' => $parent->id
            ];

            $childs = static::getChilds($parent->id);

            foreach ($childs as $index2 => $child) {

                $menu[$parent->name][$child->name] = [
                    'name' => $child->name,
                    'id' => $child->id
                ];

                $subChilds = static::getChilds($child->id);

                foreach ($subChilds as $index3 => $subChild) {
                    $menu[$parent->name][$child->name][$subChild->name] = [
                        'name' => $subChild->name,
                        'id' => $subChild->id
                    ];
                }
            }
        }

        return $menu;
    }

    private static function getChilds(int $parentId)
    {
        return self::where('parent_id', $parentId)->get();
    }

}
