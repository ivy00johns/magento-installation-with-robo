

`robo initial:setup --ce/ee`
1. Creates the "magento2ce" folder under ~/Sites [Project root]
2. git clone


`robo install:magento --ce/ee`
1. First it runs `composer install`.
2. Then it runs `bin/magento setup:install` with the necessary details.


`robo configure:magento --ce/ee`
Updates the following configuration settings.
1. Disables the WYSIWYG Editor:             `bin/magento config:set cms/wysiwyg/enabled disabled`
2. Disables the Secret Keys in URLs:        `bin/magento config:set admin/security/use_form_key 0`
3. Enables Admin Account Sharing:           `bin/magento config:set admin/security/admin_account_sharing 1`
4. Sets the Environment Mode to 'Developer: `bin/magento deploy:mode:set developer`
5. Enables URL Rewrites:                    `bin/magento config:set web/seo/use_rewrites 1`
6. Increases the Admin Timeout Sessions:    `bin/magento config:set admin/security/session_lifetime 31536000`


`robo install:magento-modules --ce/ee`
1. `git clone` the following module repos to [Project root].
   1. https://github.com/magento-commerce/commerce-data-export
   2. https://github.com/magento-commerce/services-connector
   3. https://github.com/magento-commerce/services-id
   4. https://github.com/magento-commerce/saas-export
   5. https://github.com/magento-commerce/inventory
2. It then installs the modules.
3. Then enables all modules.


`robo install:eventing-modules --ce/ee`
1. `git clone` the following repos to [Project root].
   1. https://github.com/magento-commerce/module-api-extensibility
   2. https://github.com/magento-commerce/module-event-plugins
   3. https://github.com/magento-commerce/module-adobe-io-events
2. Adds the necessary repos to the `composer.json` file.
3. Adds the modules to the `require` list in the composer.json file.
4. Runs `composer update`.
5. Enables all modules: `bin/magento module:enable --all`
6. Compiles Magento: `bin/magento setup:di:compile`


`robo configure:eventing-modules --ce/ee`
1. Using the files located in the `config` folder the following configs are updated:
   1. `config/private.key` => `bin/magento config:set adobe_io_events/integration/private_key`
   2. `config/[CONFIG_FILE_NAME.json]` => `bin/magento config:set adobe_io_events/integration/workspace_configuration`
   3. `bin/magento config:set adobe_io_events/integration/instance_id`
   4. `bin/magento config:set adobe_io_events/integration/provider_id`


`robo reset:magento --ce/ee`
1. Uninstalls Magento
2. `git pull`
3. Removes the vendor folder.
4. `git checkout -- .`
5. Composer install
6. Installs Magento.


`robo reinstall:magento --ce/ee`
1. Deletes the `magento2` repo folder.
2. `git clone`
3. `composer install`
4. Installs Magento


`robo full:install --ce/ee`
1. Runs the following `robo` commands:
   1. `robo setup --ce/ee`
   2. `robo install --ce/ee`
   3. `robo configure --ce/ee`
   4. `robo cache --ce/ee`


`robo full:reinstall --ce/ee`
1. Runs the following `robo` commands:
   1. `robo reinstall --ce`
   2. `robo configure --ce`
   3. `robo cache --ce`



`robo full:reset --ce/ee`
1. Runs the following `robo` commands:
   1. `robo reset --ce`
   2. `robo configure --ce`
   3. `robo cache --ce`


`robo mode:developer --ce/ee`
1. Set "Developer Mode" for a specific environment.


`robo mode:production --ce/ee`
1. Set "Production Mode" for a specific environment.



`robo clean:cache --ce/ee`
1. Runs:
   1. `bin/magento cache:clean`
   2. `bin/magento cache:flush`

