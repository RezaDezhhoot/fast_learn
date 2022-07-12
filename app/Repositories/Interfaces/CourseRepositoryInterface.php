<?php


namespace App\Repositories\Interfaces;


use App\Models\Course;

interface CourseRepositoryInterface
{
    public function getAllAdmin($search , $status , $category , $per_page);

    public function getAllSite($search = null , $orderBy = null , $type = null , $category = null , $teacher = null);

    public function save(Course $course);

    public function delete(Course $course);

    public function find($id);

    public function attachTags(Course $course , array $tags);

    public function syncTags(Course $course , array $tags);

    public function newCourseObject();

    public function getAll();

    public function get($col , $value, $published = false);

    public function whereIn($col,array $value, $take = false, $published = false, $where = []);

    public function newComment(Course $course , array $data);

    public function getEpisodes(Course $course , $withTrashed = false);

    public function count();

    public function getMostSoldCourses($from_date ,$to_date);

    public static function observe();

    public function increment(Course $course , int $int);
}