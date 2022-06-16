<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class BlogRepository
 * @param string $title
 * @param string $image
 * @param string $text
 * @param int $id
 * @return Blog
 */
class BlogRepository
{
    /**
     * @return Blog[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBlog()
    {
        return Blog::all();
    }

    /**
     * @param string $title
     * @param string $image
     * @param string $text
     * @return Blog
     */
    public function addBlog(string $title, string $image, string $text): Blog
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $imageBlog = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('blog/' . $imageBlog, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['blog_image' => ['Error while deconding the blog image']],
                        'status' => false,
                    ], 422);
                }
            }
        }
        return Blog::create(['title' => $title, 'image' => $imageBlog, 'text' => $text]);
    }

    /**
     * @param string $title
     * @param string $image
     * @param string $text
     * @param int $id
     * @return Blog
     */
    public function updateBlog(string $title, string $image, string $text, int $id): Blog
    {
        $editBlog = Blog::find($id);

        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $blogImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('blog/' . $blogImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['blog_image' => ['Error while deconding the blog']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        if (Storage::exists('public/blog/' . $editBlog->image)) {
            Storage::delete('public/blog/' . $editBlog->image);
        }

        $editBlog->title = $title;
        $editBlog->image = $blogImage;
        $editBlog->text = $text;
        $editBlog->save();
        return $editBlog;
    }

    /**
     * @param int $id
     * @return Blog
     */
    public function deleteBlog(int $id)
    {
        $deleteBlog = Blog::find($id);
        if (Storage::exists('public/blog/' . $deleteBlog->image)) {
            Storage::delete('public/blog/' . $deleteBlog->image);
        }
        return $deleteBlog->delete();
    }
}
