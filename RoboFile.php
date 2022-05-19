<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Project root directory.
     *
     * @var string
     */
    var $projectDirectory = "~/Sites/";

    /**
     * Commands to clone the Magento 2 CE/EE git repos.
     *
     * @var string
     */
    var $cloneMagento2_CE = " && git clone https://github.com/magento/magento2.git magento2ce";
    var $cloneMagento2_EE = " && git clone https://github.com/magento-commerce/magento2ee.git";

    /**
     * Commands to clone the necessary Magento extensions git repos.
     *
     * @var string
     */
    var $cloneCommerceDataExport = " && git clone https://github.com/magento-commerce/commerce-data-export";
    var $cloneServicesConnector  = " && git clone https://github.com/magento-commerce/services-connector";
    var $cloneServicesID         = " && git clone https://github.com/magento-commerce/services-id";
    var $cloneSaasExport         = " && git clone https://github.com/magento-commerce/saas-export";
    var $cloneInventory          = " && git clone https://github.com/magento-commerce/inventory";

    /**
     * CD LAMP stack command variables
     *
     * @var string
     */
    var $CD_CE_ParentDirectory;
    var $CD_EE_ParentDirectory;

    /**
     * CD LAMP stack 'magento2ce' command variables
     *
     * @var string
     */
    var $CD_CE_RootDirectory;
    var $CD_EE_RootDirectory;

    /**
     * General CLI commands.
     *
     * @var string
     */
    var $ignoreErrors       = " 2> /dev/null";

    var $gitPull            = " && git pull";
    var $composerInstall    = " && composer install";
    var $gitCheckout        = " && git checkout -- .";

    var $makeDirectoryUtils = " && mkdir -p dev/tests/acceptance/utils";
    var $makeDirectory_CE   = " && mkdir -p magento2ce";
    var $makeDirectory_EE   = " && mkdir -p magento2ee";

    var $copyHtaccessFile   = " && cp .htaccess.sample .htaccess";
    var $copy_EE            = " && cp -R magento2ee /";

    var $removeVendor       = " && rm -rf vendor";
    var $removeMagento2_CE  = " && rm -rf magento2ce";
    var $removeMagento2_EE  = " && rm -rf magento2ee";

    var $uninstallMagento   = " && bin/magento setup:uninstall";
    var $setModeProduction  = " && bin/magento deploy:mode:set production";
    var $setModeDeveloper   = " && bin/magento deploy:mode:set developer";
    var $enableAccountShare = " && bin/magento config:set admin/security/admin_account_sharing 1";
    var $disableWysiwyg     = " && bin/magento config:set cms/wysiwyg/enabled disabled";
    var $disableSecureUrl   = " && bin/magento config:set admin/security/use_form_key 0";
    var $useUrlRewrites     = " && bin/magento config:set web/seo/use_rewrites 1";
    var $sessionLifetime    = " && bin/magento config:set admin/security/session_lifetime 31536000";

    var $cleanCache         = " && bin/magento cache:clean";
    var $flushCache          = " && bin/magento cache:flush";

    var $installCommerceDataExport_CE = " && php ../build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./commerce-data-export' --exclude true --exclude-file='./magento2ce/.git/info/exclude'";
    var $installServicesConnector_CE  = " && php ../build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./services-connector' --exclude true --exclude-file='./magento2ce/.git/info/exclude'";
    var $installServicesID_CE         = " && php ../build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./services-id' --exclude true --exclude-file='./magento2ce/.git/info/exclude'";
    var $installSaasExport_CE         = " && php ../build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./saas-export' --exclude true --exclude-file='./magento2ce/.git/info/exclude'";
    var $installInventory_CE          = " && php ../build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./inventory' --exclude true --exclude-file='./magento2ce/.git/info/exclude'";

    var $installCommerceDataExport_EE = " && php ./magento2ce/magento2ee/dev/tools/build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./commerce-data-export' --exclude";
    var $installServicesConnector_EE  = " && php ./magento2ce/magento2ee/dev/tools/build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./services-connector' --exclude";
    var $installServicesID_EE         = " && php ./magento2ce/magento2ee/dev/tools/build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./services-id' --exclude";
    var $installSaasExport_EE         = " && php ./magento2ce/magento2ee/dev/tools/build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./saas-export' --exclude";
    var $installInventory_EE          = " && php ./magento2ce/magento2ee/dev/tools/build-ee.php --ce-source='./magento2ce/app/code/Magento' --ee-source='./inventory' --exclude";

    /**
     * Magento Install script variables
     *
     * The variables outlined correspond to the pages of the "Setup Wizard" UI.
     *
     * PLEASE UPDATE THE FOLLOWING VARIABLES TO MATCH YOUR UNIQUE SETUP.
     *
     * -----------------------------------------------------------------------
     *
     * Step 0: Terms and Condition - /setup/#/landing-install
     *     + No fields present on this page.
     *
     * Step 1: Readiness Check - /setup/#/readiness-check-install
     *     + No fields present on this page.
     *
     * Step 2: Add a Database - /setup/#/add-database
     *     + Database Server Host       [REQUIRED  - Default: "localhost"]
     *     + Database Server Username   [REQUIRED  - Default: "root"]
     *     + Database Server Password   [Optional  - Default: ""]
     *     + Database Name              [REQUIRED  - Default: "magento"]
     *     + Table prefix                [Optional  - Default: ""]
     *         + VARIABLE NOT SUPPORTED AT THIS TIME
     *
     * Step 3: Web Configuration - /setup/#/web-configuration
     *     + Your Store Address         [REQUIRED  - Default: "http://magento2ce.local/"]
     *     + Magento Admin Address      [REQUIRED  - Default: "admin_XXXXXX"]
     *     - Advanced Options:
     *         + OPTIONS NOT SUPPORTED AT THIS TIME
     *
     * Step 4: Customize Your Store - /setup/#/customize-your-store
     *     + Store Default Time Zone    [REQUIRED  - Default: "Coordinated Universal Time (UTC)"]
     *     + Store Default Currency     [REQUIRED  - Default: "US Dollar (US)"]
     *     + Store Default Language     [REQUIRED  - Default: "English (United States)"]
     *     - Advanced Modules Configurations:
     *         + OPTIONS SUPPORTED AT THIS TIME
     *
     * Step 5: Create Admin Account - /setup/#/create-admin-account
     *     + New Username               [REQUIRED  - Default: ""]
     *     + New Email                  [REQUIRED  - Default: ""]
     *     + New Password               [REQUIRED  - Default: ""]
     *     + Confirm Password            [REQUIRED  - Default: ""]
     *
     * Step 6: Install - /setup/#/install
     *     + No fields present on this page.
     *
     * -----------------------------------------------------------------------
     *
     * @var string
     */
    var $install_CE_Command;
    var $install_EE_Command;

    var $CE_DatabaseServerHost     = "localhost";
    var $CE_DatabaseServerUsername = "root";
    var $CE_DatabaseServerPassword = "123123q";
    var $CE_DatabaseName           = "magento2ce";
    var $CE_StoreAddress           = "http://magento2ce.local/";
    var $CE_StoreAdminAddress      = "admin";
    var $CE_StoreDefaultTimeZone   = "America/Chicago";
    var $CE_StoreDefaultCurrency   = "USD";
    var $CE_StoreDefaultLanguage   = "en_US";
    var $CE_NewUsername            = "admin";
    var $CE_NewEmail               = "admin@test.com";
    var $CE_NewPassword            = "123123q";

    var $EE_DatabaseServerHost     = "localhost";
    var $EE_DatabaseServerUsername = "root";
    var $EE_DatabaseServerPassword = "123123q";
    var $EE_DatabaseName           = "magento2ee";
    var $EE_StoreAddress           = "http://magento2ee.local/";
    var $EE_StoreAdminAddress      = "admin";
    var $EE_StoreDefaultTimeZone   = "America/Chicago";
    var $EE_StoreDefaultCurrency   = "USD";
    var $EE_StoreDefaultLanguage   = "en_US";
    var $EE_NewUsername            = "admin";
    var $EE_NewEmail               = "admin@test.com";
    var $EE_NewPassword            = "123123q";

    /**
     * PLEASE NOTE:
     * - The LAMP commands assume you did NOT change the name of the GitHub repos when they were originally cloned.
     * - This script assumes that you installed the LAMP environments as outlined by the "Non-VM Based Magento Installation - LAMP Stack - OS X" confluence article.
     * - The folder structure should look something like the following:
     *
     *     ~/Sites/
     *         |--- magento2ce/        [Location of the repos needed to setup Magento2CE]
     * RoboFile constructor.
     */
    public function __construct()
    {
        $this->CD_CE_ParentDirectory = "cd " . $this->projectDirectory . "magento2ce/";
        $this->CD_EE_ParentDirectory = "cd " . $this->projectDirectory . "magento2ee/";

        $this->CD_CE_RootDirectory   = "cd " . $this->projectDirectory . "magento2ce/magento2ce/";
        $this->CD_EE_RootDirectory   = "cd " . $this->projectDirectory . "magento2ee/magento2ce/";

        $this->install_CE_Command =
            " && php bin/magento setup:install" .
            " --db-host="                       . $this->CE_DatabaseServerHost .
            " --db-user="                       . $this->CE_DatabaseServerUsername .
            " --db-password="                   . $this->CE_DatabaseServerPassword .
            " --db-name="                       . $this->CE_DatabaseName .
            " --base-url="                      . $this->CE_StoreAddress .
            " --backend-frontname="             . $this->CE_StoreAdminAddress .
            " --timezone="                      . $this->CE_StoreDefaultTimeZone .
            " --currency="                      . $this->CE_StoreDefaultCurrency .
            " --language="                      . $this->CE_StoreDefaultLanguage .
            " --admin-user="                    . $this->CE_NewUsername .
            " --admin-email="                   . $this->CE_NewEmail .
            " --admin-password="                . $this->CE_NewPassword .
            " --admin-firstname=Magento"         .
            " --admin-lastname=User"            .
            " --use-rewrites=1";

        $this->install_EE_Command =
            " && php bin/magento setup:install" .
            " --db-host="                       . $this->EE_DatabaseServerHost .
            " --db-user="                       . $this->EE_DatabaseServerUsername .
            " --db-password="                   . $this->EE_DatabaseServerPassword .
            " --db-name="                       . $this->EE_DatabaseName .
            " --base-url="                      . $this->EE_StoreAddress .
            " --backend-frontname="             . $this->EE_StoreAdminAddress .
            " --timezone="                      . $this->EE_StoreDefaultTimeZone .
            " --currency="                      . $this->EE_StoreDefaultCurrency .
            " --language="                      . $this->EE_StoreDefaultLanguage .
            " --admin-user="                    . $this->EE_NewUsername .
            " --admin-email="                   . $this->EE_NewEmail .
            " --admin-password="                . $this->EE_NewPassword .
            " --admin-firstname=Magento"         .
            " --admin-lastname=User"            .
            " --use-rewrites=1";
    }

    /**
     * Creates the necessary Directories and clones the necessary Git repos under: ~/Sites/
     *
     * @param array $opts
     * @option $ce  Create the CE LAMP stack directories and clone the necessary Git repos.
     * @throws \Robo\Exception\TaskException
     */
    function setup($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("cd " . $this->projectDirectory . $this->makeDirectory_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneMagento2_CE . $this->ignoreErrors)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("cd " . $this->projectDirectory . $this->makeDirectory_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneMagento2_CE . $this->ignoreErrors)
                ->exec($this->CD_EE_RootDirectory . $this->cloneMagento2_EE . $this->ignoreErrors)
                ->run();
        }
    }

    /**
     * Run both 'composer install' and 'php install'.
     *
     * @param array $opts
     * @option $ce  Runs composer install and php install.
     * @throws \Robo\Exception\TaskException
     */
    function install($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->composerInstall)
                ->exec($this->CD_CE_RootDirectory . $this->install_CE_Command)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory . $this->composerInstall)
                ->exec($this->CD_EE_RootDirectory . $this->install_EE_Command)
                ->run();
        }
    }

    /**
     * After completing the Setup Wizard for the LAMP stack OR running "robo lamp:setupWizard", it sets the key MFTF Configuration Settings to the correct values.
     *
     * - Disables the WYSIWYG Editor:        bin/magento config:set admin/security/use_form_key 0
     * - Disables the Secret Keys in URLs:   bin/magento config:set admin/security/use_form_key 0
     * - Enables Admin Account Sharing:      bin/magento config:set admin/security/admin_account_sharing 1
     *
     * @param array $opts
     * @option $ce  Set the Configuration variables for the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function configure($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->disableWysiwyg)
                ->exec($this->CD_CE_RootDirectory . $this->disableSecureUrl)
                ->exec($this->CD_CE_RootDirectory . $this->enableAccountShare)
                ->exec($this->CD_CE_RootDirectory . $this->setModeDeveloper)
                ->exec($this->CD_CE_RootDirectory . $this->useUrlRewrites)
                ->exec($this->CD_CE_RootDirectory . $this->sessionLifetime)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory . $this->disableWysiwyg)
                ->exec($this->CD_EE_RootDirectory . $this->disableSecureUrl)
                ->exec($this->CD_EE_RootDirectory . $this->enableAccountShare)
                ->exec($this->CD_EE_RootDirectory . $this->setModeDeveloper)
                ->exec($this->CD_EE_RootDirectory . $this->useUrlRewrites)
                ->exec($this->CD_EE_RootDirectory . $this->sessionLifetime)
                ->run();
        }
    }

    /**
     * Clones the necessary module repos then symlinks them for the specified LAMP stack.
     *
     * @param array $opts
     * @option $ce  Clones the necessary module repos then symlinks them for the specified LAMP stack.
     * @throws \Robo\Exception\TaskException
     */
    function modules($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneCommerceDataExport . $this->ignoreErrors)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneServicesConnector . $this->ignoreErrors)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneServicesID . $this->ignoreErrors)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneSaasExport . $this->ignoreErrors)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneInventory . $this->ignoreErrors)
                ->exec($this->CD_CE_ParentDirectory . $this->installCommerceDataExport_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->installServicesConnector_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->installServicesID_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->installSaasExport_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->installInventory_CE)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneCommerceDataExport . $this->ignoreErrors)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneServicesConnector . $this->ignoreErrors)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneServicesID . $this->ignoreErrors)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneSaasExport . $this->ignoreErrors)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneInventory . $this->ignoreErrors)
                ->exec($this->CD_EE_ParentDirectory . $this->installCommerceDataExport_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->installServicesConnector_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->installServicesID_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->installSaasExport_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->installInventory_EE)
                ->run();
        }
    }

    /**
     * Reset the DB and update the Git repos for the specified LAMP stack.
     *
     * @param array $opts
     * @option $ce  Reset the DB and update the Git repos for the CE LAMP stack.
     * @throws \Robo\Exception\TaskException
     */
    function reset($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->uninstallMagento)
                ->exec($this->CD_CE_RootDirectory . $this->gitPull)
                ->exec($this->CD_CE_RootDirectory . $this->removeVendor)
                ->exec($this->CD_CE_RootDirectory . $this->gitCheckout)
                ->exec($this->CD_CE_RootDirectory . $this->composerInstall)
                ->exec($this->CD_CE_RootDirectory . "dev/tests/acceptance" . $this->copyHtaccessFile)
                ->exec($this->CD_CE_RootDirectory . $this->install_CE_Command)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory   . $this->uninstallMagento)
                ->exec($this->CD_EE_ParentDirectory . "magento2ee" . $this->gitPull)
                ->exec($this->CD_EE_RootDirectory   . $this->gitPull)
                ->exec($this->CD_EE_RootDirectory   . $this->removeVendor)
                ->exec($this->CD_EE_RootDirectory   . $this->gitCheckout)
                ->exec($this->CD_EE_ParentDirectory . "magento2ee && cp composer.lock ../composer.lock")
                ->exec($this->CD_EE_ParentDirectory . "magento2ee && cp composer.json ../composer.json")
                ->exec($this->CD_EE_RootDirectory   . $this->composerInstall)
                ->exec($this->CD_EE_RootDirectory   . "magento2ee" . $this->composerInstall)
                ->exec($this->CD_EE_RootDirectory   . "dev/tests/acceptance" . $this->copyHtaccessFile)
                ->exec($this->CD_EE_RootDirectory   . $this->install_EE_Command)
                ->exec($this->CD_EE_RootDirectory   . " && php magento2ee/dev/tools/build-ee.php --command link --ce-source magento2ce/ --ee-source magento2ee")
                ->run();
        }
    }

    /**
     * Reinstall the entire specified LAMP stack.
     *
     * @param array $opts
     * @option $ce  Reinstall the entire CE LAMP stack.
     * @throws \Robo\Exception\TaskException
     */
    function reinstall($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_ParentDirectory . $this->removeMagento2_CE)
                ->exec($this->CD_CE_ParentDirectory . $this->cloneMagento2_CE)
                ->exec($this->CD_CE_RootDirectory   . $this->composerInstall)
                ->exec($this->CD_CE_RootDirectory   . $this->install_CE_Command)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_ParentDirectory . $this->removeMagento2_CE)
                ->exec($this->CD_EE_ParentDirectory . $this->removeMagento2_EE)
                ->exec($this->CD_EE_ParentDirectory . $this->cloneMagento2_CE)
                ->exec($this->CD_EE_RootDirectory   . $this->cloneMagento2_EE)
                ->exec($this->CD_EE_RootDirectory   . $this->composerInstall)
                ->exec($this->CD_EE_RootDirectory   . "magento2ee" . $this->composerInstall)
                ->exec($this->CD_EE_RootDirectory   . $this->install_EE_Command)
                ->exec($this->CD_EE_RootDirectory   . " && php magento2ee/dev/tools/build-ee.php --command link --ce-source magento2ce/ --ee-source magento2ee")
                ->run();
        }
    }

    /**
     * Full installation of a specific Environment.
     *
     * @param array $opts
     * @option $ce  Full installation of the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function fullInstall($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo setup --ce")
                ->exec("robo install --ce")
                ->exec("robo configure --ce")
                ->exec("robo cache --ce")
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo setup --ee")
                ->exec("robo install --ee")
                ->exec("robo configure --ee")
                ->exec("robo cache --ee")
                ->run();
        }
    }

    /**
     * Full re-installation of a specific Environment.
     *
     * @param array $opts
     * @option $ce  Full re-installation of the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function fullReinstall($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo reinstall --ce")
                ->exec("robo configure --ce")
                ->exec("robo cache --ce")
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo reinstall --ee")
                ->exec("robo configure --ee")
                ->exec("robo cache --ee")
                ->run();
        }
    }

    /**
     * Full Reset of a specific Environment.
     *
     * @param array $opts
     * @option $ce  Full Reset of the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function fullReset($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo reset --ce")
                ->exec("robo configure --ce")
                ->exec("robo cache --ce")
                ->run();
        } else if ($opts["ee"])  {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec("robo reset --ee")
                ->exec("robo configure --ee")
                ->exec("robo cache --ee")
                ->run();
        }
    }

    /**
     * Set "Developer Mode" for a specific Environment.
     *
     * @param array $opts
     * @option $ce  Set "Production Mode" for the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function modeDeveloper($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->setModeDeveloper)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory . $this->setModeDeveloper)
                ->run();
        }
    }

    /**
     * Set "Production Mode" for a specific Environment.
     *
     * @param array $opts
     * @option $ce  Set "Production Mode" for the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function modeProduction($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->setModeProduction)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory . $this->setModeProduction)
                ->run();
        }
    }

    /**
     * Cleans and flushes the cache.
     *
     * @param array $opts
     * @option $ce  Cleans and flushes the cache for the LAMP instance.
     * @throws \Robo\Exception\TaskException
     */
    function cache($opts = [
        "ce" => false,
        "ee" => false
    ]) {
        if ($opts["ce"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_CE_RootDirectory . $this->cleanCache)
                ->exec($this->CD_CE_RootDirectory . $this->flushCache)
                ->run();
        } else if ($opts["ee"]) {
            $this->taskExecStack()
                ->stopOnFail(false)
                ->exec($this->CD_EE_RootDirectory . $this->cleanCache)
                ->exec($this->CD_EE_RootDirectory . $this->flushCache)
                ->run();
        }
    }
}
