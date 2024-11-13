# cpt pies
Simulated Technical Test for WordPress Developer


### What is this repository for? ###
This repository was created as a simulated technical test for a WordPress Developer role. The goal is to demonstrate my skills in developing custom WordPress functionality, adhering to best practices and leveraging Object-Oriented Programming (OOP) principles.

* Version: dev [1.0.1]

### What features/tasks have been developed? ###

* Custom Post Type
* Admin Functionality
* Shortcode
* Pagination

    ** OOP required

## Installation and Activation ##

### Installation ###

1. Download the Plugin:
    - Download the plugin files as a zip file or clone the repository.

2. Upload to WordPress:
    - Go to the WordPress admin panel.
    - Navigate to Plugins > Add New.
    - Click on Upload Plugin and select the zip file you downloaded.

3. Install Dependencies:
    - Before activating the plugin, open a terminal in the plugin directory.
    - Run the command ```composer install``` to install the necessary dependencies.

4. Activate the Plugin:
    - After uploading, click Activate to enable the plugin.

### Activation ###

Once activated, the plugin will automatically:

* Register the custom post type ***Pies***.
* Create custom fields (Pie Type, Description, Ingredients) using ACF (Advanced Custom Fields).

So just need to register the [pies] shortcode for displaying pies.

### Shortcode Usage ###

#### Basic Usage ####
To display all pies, simply use the shortcode:   ``` [pies] ```

#### Using the lookup Attribute ####
To filter pies by a specific ***Pie Type***, use the lookup attribute:  ``` [pies lookup="Apple Pie"] ```

#### Using the ingredient Attribute ####
To filter pies by a specific ***ingredient***, use the ingredients attribute with a comma-separated list of ingredients:  ``` [pies ingredient="Sugar,Butter"] ```

#### Pagination ####
By default, the shortcode displays 3 pies per page. You can customize the number of pies per page with the ***posts_per_page*** attribute:  ``` [pies posts_per_page="5"] ```

#### Combined Usage ####
We can combine the lookup and ingredients attributes to filter by both Pie Type and ingredients::   ``` [pies lookup="Apple Pie" ingredient="Sugar,Butter"] ```

### Who do I talk to? ###

* Francisco Moreno Carracedo <fjmc81@gmail.com>
