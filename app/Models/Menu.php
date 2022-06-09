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

            $menu[] = (object)[
                'name' => $parents[$index]->name,
                'id' => $parents[$index]->id
            ];

            $childs = static::getChilds($parents[$index]->id);
            if(count($childs)>0){
                $menu[$index]->subMenue=[];
            }
            foreach ($childs as $index2 => $child) {

                $menu[$index]->subMenue[] = (object)[
                    'name' => $childs[$index2]->name,
                    'id' => $childs[$index2]->id
                ];

                $subChilds = static::getChilds($childs[$index2]->id);
                if(count($subChilds)>0){
                    $menu[$index]->subMenue[$index2]->subMenue=[];
                }
                foreach ($subChilds as $index3 => $subChild) {
                    $menu[$index]->subMenue[$index2]->subMenue[] = (object)[
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
