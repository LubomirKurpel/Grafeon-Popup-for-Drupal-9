# Grafeon Popup for Drupal 9

## Overview

The **Grafeon Popup** module for Drupal 9 provides a customizable popup notification that appears in the lower right corner of your website. This module allows site administrators to configure the popup’s display settings, including its title, message, and visibility duration. When users dismiss the popup, it will not be shown again for a configurable number of days, thanks to a persistent cookie.

## Admin Settings

You can configure the Grafeon Popup through the admin settings page located at `/admin/config/grafeon-popup`. The settings page allows you to:

- **Enable/Disable Popup**: Toggle the visibility of the popup on or off.
- **Set Popup Title**: Specify the title text to be displayed in the popup.
- **Set Popup Message**: Define the content message shown in the popup.
- **Configure Cookie Duration**: Set the number of days for which the dismissal cookie should be valid.

## Requirements

- Drupal 9 (not tested on Drupal 8, but should be compatible)
- PHP 7.3 or later

## Installation

1. **Download and Place the Module**:
   - Download the module from this page.
   - Place the module in the `modules/custom` directory of your Drupal installation.

2. **Enable the Module**:
   - Navigate to **Extend** (`/admin/modules`) in the Drupal admin interface.
   - Find **Grafeon Popup** in the list and enable it.

3. **Clear Cache**:
   - Clear the Drupal cache to ensure the module and its settings are recognized.
   - You can clear the cache via the admin interface or using Drush with the command: `drush cr`.

## Configuration

1. **Access Configuration Page**:
   - Go to **Configuration** (`/admin/config`) and find **Grafeon Popup** under the **System** category.

2. **Adjust Settings**:
   - Toggle the popup visibility, enter the title and message, and set the cookie duration according to your preferences.

3. **Save Changes**:
   - After making changes, save the configuration. The popup will reflect these changes immediately.

## Uninstallation

To remove the Grafeon Popup module:

1. **Disable the Module**:
   - Go to **Extend** (`/admin/modules`), uncheck **Grafeon Popup**, and click **Uninstall**.

2. **Delete Module Files**:
   - Remove the module directory from `modules/custom`.

3. **Clear Cache**:
   - Clear Drupal’s cache to remove any residual data related to the module.

## Troubleshooting

- **Popup Not Showing**: Ensure the module is enabled and the settings are configured correctly. Verify that JavaScript is working and no errors are present in the browser console.
- **Changes Not Reflecting**: Clear the cache after changing settings to ensure that updates are applied immediately.
