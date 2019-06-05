# Video-projects-showcase-plugin-with-bespoke-dashboard-page

## What is it?
This Word press plugin allows a video production company, or any business that regularly creates videos, to quickly and easily record, manage and display their video projects to customers.

## Back end dashboard
The principal aim of the plugin is to allow the user to manage their video projects on one page in their Wordpress dashboard.
The bespoke dashboard page allows the user to create a new video project, view all projects, update any project and delete projects, all from one page in the dashboard page.

## Frontend
The plugin also adds a page to the site which displays buttons that allow the user to choose which video project type they wish to see.  For example, the categories we have are wedding video, commercial videos and music videos. The buttons allow the user to click a button and all of the videos for that category will appear in a grid format showing video details and an embedded video.

As mentioned above, the plugin is mainly a backend project but the front end could be adapted to allow users to search via country, city, date, project duration - any number of front end possibilities could be added.

## Languages
Mainly PHP, with a little Javascript and JQuery for the admin and front end pages, and of course, HTML and CSS.

## Architecture
Although not strictly an MVC framework, I tried to follow MVC principles in the way the plugin is structured with admin-pages acting as the views, classes as models for CRUD actions, and the admin page callback acting as a controller.


### The plugin sets up:

    The admin page in the dashboard with a custom video project post input form.
    A standard wordpress page is created on plugin activation with its content containing buttons for the 3 main video categories.
    JS files for the page mentioned above.
    JS files for retrieving images from the media library.
    The custom post type.
    Custom taxonomies of country, language and video type.
    Activation hooks for creating a page on plugin activation.
    Activation hooks for properly registering a CPT and flush re-writing the permalink rules.
    Classes for adding meta data for each custom post entry.
    Classes for saving the post content to contain the meta data and display the video project using an iframe.

### CRUD:

    CREATION: Unique post content for each post is created from the form fields.
    The form fields are saved as post meta upon post creation for use in the bespoke search page with buttons. Post details such as title, date etc. are set on post creation.
    Post meta is utilized by having different fields for similar data.  There is a date meta field and a display date meta field (displaying dates as Month and Year).
    There is also a video url meta field and a video id field which is extracted from the video url and used when embedding the video using an iFrame.
    READ AND UPDATE: There is an update post admin page which retrieves all current fields and allows the user to quickly make minor changes to their video project posts.
    DELETE: All post meta and term relationships are removed from the database when the user deletes a project.
    
### SKILLS COVERED

    MVC architecture
    Separating classes into helper, init and model files
    Separating logic from views 
    Adding a custom post type
    Adding a bespoke admin page
    Updating post meta data
    Activation hooks in WP
    Localizing a PHP array into a Javascript file
    Retrieving and saving taxonomy terms
    Retrieving and saving post meta
    Setting up a bespoke form for inserting a custom post type
    Using JS to select an image URL from the current media files in the WP site
    Wordpress data validation and sanitization
    Creating and updating posts with code in WP
    Abstract classes
    Regular expressions
    String manipulation in PHP and JS
    Date manipulation to convert a date to 'month year' format for display
    CSS columns and rows

NOTE: The files 'tests.php' in the folder 'tests' is only there as a reference. It contains the tests performed while building the plugin.
