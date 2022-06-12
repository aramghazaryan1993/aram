<?php
namespace App\Repositories;

use App\Models\Home;

/**
 * Class HomeRepository
 *
 *
 * @return Home
 * @package App\Repositories
 */

class HomeRepository
{
    /**
     * @return \App\Models\Home[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getHome(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Home::all();
    }

    /**
     * @param $titleOne
     * @param $titleTwo
     * @param $id
     *
     * @return mixed
     */
    public function update($titleOne,$titleTwo,$id)
    {
        $editHome = Home::find($id);
        $editHome->title_one = $titleOne;
        $editHome->title_two = $titleTwo;
        $editHome->save();
        return $editHome;
    }
}
