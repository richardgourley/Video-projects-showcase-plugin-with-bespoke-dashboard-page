# Video-projects-showcase-plugin-with-bespoke-dashboard-page

## What is it?
This Word press plugin allows a video production company, or any business that regularly creates videos, to quickly and easily record, manage and display their video projects to customers.

## Back end dashboard
The principal aim of the plugin is to allow the user to manage their video projects on one page in their Wordpress dashboard.
The bespoke dashboard page allows the user to create a new video project, view all projects, update any project and delete projects, all from the menu on the dashboard page.

## Frontend
The plugin also adds a page to the site which displays buttons that allow the user to choose which video project type they wish to see.  For example, the categories we have are wedding video, commercial videos and music videos. The buttons allow the user to click a button and all of the videos for that category will appear.

As said above, the plugin is mainly a backend project but the front end could be adapted to allow user to search via country, city, date, project duration - any number of front end possibilities could be added.

## Languages
Mainly PHP, with a little Javascript and JQuery, and of course, HTML and CSS.

## Architecture
Although not strictly an MVC framework, I tried to follow MVC principles in the way the plugin is structured with admin-pages acting as the views, classes as models for CRUD actions, and the admin page callback acting as a controller.


### The plugin sets up:

    The admin page in the dashboard with a custom video project post input form.
    The custom post type
    Custom taxonomies of country and video type
    Updates meta data for each custom post entry.
    Saves the post content and post excerpt in a unique, user friendly way.

### SKILLS COVERED

    Adding a custom post type
    Adding a bespoke admin page
    Updating post meta data
    Removing and replacing a filter to replace get_the_excerpt
    Setting up bespoke form for inserting a custom post type
    JS used to select an image URL from the current media files in the WP site.
    Wordpress data validation and sanitization.

