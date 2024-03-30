
# **wp-lock-panel**

## Short Description 

Bring Lock is a plugin that locks the admin panel through API requests


[wp-lock-panel](https://br.wordpress.org/plugins/wp-lock-panel) was developed with the sole and exclusive purpose of blocking the Wordpress Admin Panel so that no other user can log in, not even the site administrator. Blocking occurs when a request is made to the Plugin's API along with the token configured on the panel.

**Features**

* **Lock admin panel**
* **Unlock admin panel**

## **Contact**
Don't forget, in case of any problems or upcoming questions feel free to contact us via e-mail **boteistem@gmail.com** or via [FREE SUPPORT FORUM](https://wordpress.org/support/plugin/wp-lock-panel).


## **Installation**

There are two ways to install Bring Lock: the easy way, when you install Bring Lock from your WordPress dashboard, and the not-so-easy way, when you install it from WordPress.org.

* 1.1 The easiest way to enjoy Bring Lock:
* 1.1.1	Login to your WordPress dashboard
* 1.1.2	Go to Plugins
* 1.1.3	Add New
* 1.1.4	Search for Bring Lock
* 1.1.5	Click to install
* 1.2 The second way:
* 1.2.1 Download the zip file from https://wordpress.org/plugins/
* 1.2.2 Go to Plugins
* 1.2.3 Add New
* 1.2.4 Upload plugin
* 1.2.5 Choose file bring-lock.zip
* 1.2.6	Click to install

* 1.3 In the Administrative Panel Menu, look for "Bring Lock", click and the plugin page will open. Fill in the "key" field with your token and save.

## **API REST**

### Lock:

To lock the Panel through the api, use the following EndPoint **{website link}**/wp-json/wlplock/lock/**{password}**/

### Unlock

To unlock the Panel through the api, use the following EndPoint  **{website link}**/wp-json/wlplock/unlock/**{password}**/


## **Changelog**

#### 1.0.1
* Fixed: bug connected with sql injection
