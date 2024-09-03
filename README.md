# lawgistics_test
Technical test for Wordpress Developer at Lawgistics Ltd (https://www.lawgistics.co.uk/)


### What is this repository for? ###
Technical test

* Version: dev [1.0.0]

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

3. Activate the Plugin:
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