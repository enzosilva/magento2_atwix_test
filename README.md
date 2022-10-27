# Atwix Custom Customer Module

   ``atwix/module-customer``

 - [Available Functionalities](#available-functionalities)
 - [Installation](#installation)
 - [Configuration](#configuration)


## Available Functionalities
 - Customer Firstname Trim
 - Customer Registration Log Data
 - Customer Registration Email Sending

## Installation
### Zip file
 - Unzip the zip file in `app/code/Atwix`
 - Enable the module by running `php bin/magento module:enable Atwix_Customer`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration
### Store Configuration
 - Go to the following configuration path: `Stores -> Settings -> Configuration -> Atwix -> Customer`
 - Enable the desired modules 
 - Clear the cache to reflect the changes: `System -> Tools -> Cache Management -> Flush Magento Cache`