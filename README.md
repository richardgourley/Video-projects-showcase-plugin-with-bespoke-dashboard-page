# Video-projects-showcase-plugin-with-bespoke-dashboard-page

## What does the plugin do?
This Word press plugin allows a video production company, or any business that regularly creates videos, to quickly and easily manage and display their video projects to customers.

## Back end dashboard
The principal aim of the plugin is to allow the user to manage their video projects from one page in their Wordpress dashboard.
The bespoke dashboard page allows the user to create a new video project, view all projects, update any project and delete projects, all from one page.

## Frontend
On plugin activation, a mobile-responsive video search page is created, which acts as a bespoke search page that works on all devices.
The user can filter video projects by country or category( commercial, wedding or music video).
The user is shown postmeta data for each project, such as location adn duration, along with an embedded video which adapts to different screen sizes.
Enqueued google fonts are used in the presentation of each video.

## Languages
Mainly PHP and Wordpress APIs. 
JS is used for the search page and the admin page forms. 
HTML and CSS for the search page and admin page layouts.

## Architecture
Although not strictly an MVC framework, MVC principles were followed.
We have model classes that handle DB interraction and our admin page callback acts as a controller.

### The plugin sets up:

    The admin page in the dashboard with a custom video project post input form.
    A standard wordpress page is created on plugin activation with its content containing buttons for the 3 main video categories.
    JS files for the page mentioned above.
    JS files for retrieving images from the media library.
    The custom post type.
    Custom taxonomies of country, language and video type.
    A google font.
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
    Plugin structure - separating classes into helper, init and model folders.
    Separating logic from views 
    Adding a custom post type
    Adding a bespoke admin page
    Updating post meta data
    Activation and deactivation hooks in WP
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
    Media queries in CSS.

NOTE: The files 'tests.php' in the folder 'tests' is only there as a reference. It contains the tests performed while building the plugin.
