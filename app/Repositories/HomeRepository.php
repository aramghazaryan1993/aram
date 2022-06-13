<?php

namespace App\Repositories;

use App\Models\Home;

/**
 * Class HomeRepository
 * @package App\Repositories
 * @param string $titleOne 
 * @param string $titleTwo 
 * @param int $id 
 * @return Home
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
     * 
     * @param string $titleOne 
     * @param string $titleTwo 
     * @return Home 
     */
    public function addHome(string $titleOne, string $titleTwo): Home
    {
        return Home::create(['title_one' => $titleOne, 'title_two' => $titleTwo]);
    }

    /**
     * 
     * @param string $titleOne 
     * @param string $titleTwo 
     * @param int $id 
     * @return Home 
     */
    public function update(string $titleOne, string $titleTwo, int $id): Home
    {
        $editHome = Home::find($id);
        $editHome->title_one = $titleOne;
        $editHome->title_two = $titleTwo;
        $editHome->save();
        return $editHome;
    }

    /**
     * 
     * @param int $id 
     * @return Home 
     */
    public function delete(int $id)
    {
        return Home::where('id', $id)->delete();
    }
}
