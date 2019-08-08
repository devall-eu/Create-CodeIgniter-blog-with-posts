<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('blog/Blog_model', 'blog');
    }

    public function index()
    {
        $data['params']['articleonpage'] = 5;
        $data['params']['blogpicture'] = 1;
        $data['params']['articletags'] = 1;

        // Show all blog articles
        $this->load->library('pagination');
        $count = $this->blog->countBlog();
        $config = array();
        $config["base_url"] = base_url('index.php/blog');
        $config['total_rows'] = $count;
        $config['per_page'] = $data['params']['articleonpage'];
        $config["uri_segment"] = 3;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page', true)) ? $this->input->get('per_page', true) : 0;
        $to = $page + $this->pagination->per_page;

        if ($to > $count) {
            $to = $count;
        }

        $data['articles'] = $this->blog->getBlog('', $config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['pagermessage'] = $page . ' to ' . $to . ' from ' . $count . ' results';
        $data['count'] = $count;
        $this->load->view('allblog', $data);
    }

    public function post($slug = NULL)
    {
        $data['params']['singlearticlepicture'] = 1;
        $data['params']['singlearticletags'] = 1;

        // Show selected article from the blog
        $data['blog'] = $this->blog->getBlog($slug);

        if (isset($data['blog']->slug)) {

            $data['prev'] = $this->blog->getPrevBlog($data['blog']->slug, $data['blog']->category_id, $data['blog']->added);
            $data['next'] = $this->blog->getNextBlog($data['blog']->slug, $data['blog']->category_id, $data['blog']->added);
        }
        $this->load->view('singleblog', $data);
    }
}