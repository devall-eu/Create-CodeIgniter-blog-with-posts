<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model
{
    /**
     * Blog_model constructor.
     */
    public function __construct()
    {
        // Get CI instance
        $this->ci = &get_instance();
        $this->ci->load->database();
    }

    /**
     * @return mixed
     */
    public function countBlog()
    {
        return $this->ci->db->from('blog')->where(array('blog.active' => 1, 'blog.public' => 1, 'blog.pending' => 0))->get()->num_rows();
    }

    /**
     * @param null $slug
     * @param null $limit
     * @param null $start
     * @return mixed
     */
    public function getBlog($slug = NULL, $limit = NULL, $start = NULL)
    {
        if ($slug) {
            return $this->ci->db->
            from('blog')->
            select('blog.*, category.parent_id, category.name, user.full_name, category.id as category_id')->
            where(array('blog.slug' => $slug, 'blog.active' => 1, 'blog.public' => 1, 'blog.pending' => 0))->
            join('category_blog', 'category_blog.blog = blog.id')->
            join('category', 'category_blog.category = category.id')->
            join('user', 'blog.user = user.id')->
            get()->row();
        } else {
            $this->ci->db->
            from('blog')->
            select('blog.*, category.parent_id, category.name, category.slug as category_slug, user.full_name')->
            where(array('blog.active' => 1, 'blog.public' => 1, 'blog.pending' => 0))->
            join('category_blog', 'category_blog.blog = blog.id')->
            join('category', 'category_blog.category = category.id')->
            join('user', 'blog.user = user.id')->
            order_by('blog.added', 'DESC');

            if ($limit) $this->ci->db->limit($limit, $start);

            return $this->ci->db->get()->result();
        }
    }

    /**
     * @param null $slug
     * @param null $category_id
     * @param null $added
     * @return bool
     */
    public function getPrevBlog($slug = NULL, $category_id = NULL, $added = NULL)
    {
        if (!$slug) return FALSE;

        $query = 'SELECT blog.title, blog.slug, blog.picture FROM category_blog  JOIN blog ON category_blog.blog = blog.id WHERE blog.added < "' . $added . '" AND category_blog.category = ' . $category_id . ' ORDER BY blog.added DESC LIMIT 1';

        return $this->ci->db->query($query)->row();
    }

    /**
     * @param null $slug
     * @param null $category_id
     * @param null $added
     * @return bool
     */
    public function getNextBlog($slug = NULL, $category_id = NULL, $added = NULL)
    {
        if (!$slug) return FALSE;

        $query = 'SELECT blog.title, blog.slug, blog.picture FROM category_blog  JOIN blog ON category_blog.blog = blog.id WHERE blog.added > "' . $added . '" AND category_blog.category = ' . $category_id . ' ORDER BY blog.added ASC LIMIT 1';

        return $this->ci->db->query($query)->row();
    }
}