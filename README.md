# Create-CodeIgniter-blog-with-posts
A blog that covers everything you need to write the posts. Navigation with all the posts and details of each single post with optional settings. SEO (Search engine optimization) is also provided as we all want the posts to be shared across all types of networks.

The code is provided for the MVC CodeIgniter and can also be included in the HMVC.

By setting variables, you can specify the following parameters:

    show the cover image of posts
    show the cover image of single post
    show tags in posts
    show tags in single post
    determine the number of hits to one page

 
Two separate views files are used for the view. The following blog views are possible:

    Full blog with all the posts
    Single post
    Invalid single post

 
Page pagination is included, as long as it shows all posts and reads from the variable how many hits you want to display per page.

Remember to include the URL helper. It can be included in the class itself or in the <project root directory>/application/config/autoload.php file.
  
  If you are using an HMVC structure and have only one master controller that has multiple modules involved and routing is not module bound, then you only need an index function in the blog module. This function must then parse the URL.
  
  Visit on page: https://dev-all.eu/blog/create-codeigniter-blog-with-posts
