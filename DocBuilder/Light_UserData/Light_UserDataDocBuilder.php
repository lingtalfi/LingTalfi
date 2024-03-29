<?php


namespace Ling\LingTalfi\DocBuilder\Light_UserData;


use Ling\DocTools\DocBuilder\Git\PhpPlanet\LingGitPhpPlanetDocBuilder;
use Ling\DocTools\Exception\DocBuilderException;
use Ling\DocTools\Translator\ParseDownTranslator;
use Ling\LingTalfi\DocTools\LingTalfiDocToolsHelper;


/**
 * The Light_UserDataDocBuilder class.
 */
class Light_UserDataDocBuilder
{


    /**
     * Launch this function to generate the documentation for the Light_UserData planet.
     * (based on the LingGitPhpPlanetDocBuilder doc builder.
     *
     * If htmlMode is true (the default),
     * this method will generate all files in md format in the following directory:
     *
     * - /myphp/universe/Light_UserData/doc
     *
     *
     *
     * If htmlMode is true,
     * then html files will be generated (instead of md files).
     * You can then browse the result at: http://jindoc/api
     *
     *
     *
     * This method will also show the documentation report.
     *
     *
     *
     *
     * @param bool $htmlMode
     * @throws DocBuilderException
     */
    public static function buildDoc($htmlMode = true)
    {

        //--------------------------------------------
        // DOC TOOLS: CREATE A DOCUMENTATION FOR A PHP PLANET FOR GIT (MARKDOWN)
        //--------------------------------------------
        $planetDir = "/myphp/universe/Ling/Light_UserData";
        $gitRepoUrl = "https://github.com/lingtalfi/Light_UserData";
        $git = $gitRepoUrl . "/blob/master";
        $doc = "$git/doc";
        $api = $doc . "/api";
        $conception = $doc . "/pages/conception-notes.md";


        $options = [
            "gitRepoUrl" => $gitRepoUrl,
            /**
             * Path to the planet dir that we want to generate the documentation for.
             */
            "planetDir" => $planetDir,
            /**
             * Whether to show the "methods without return" items in the report.
             * I disable them because a lot of methods don't need return (like __construct, setters, ...),
             * and it disturbs me to have a warning for that.
             */
            "reportShowMethodsWithoutReturn" => false,
            /**
             * An array of classes to ignore.
             * You would put any classes used by your planet, but external to your planet.
             * That's because they will be scanned by the Parser and generate errors in the @kw(report).
             * By referencing theme here, they would be scanned, but not generate errors in the report.
             *
             */
            "reportIgnore" => [
                "Ling\Light\Controller\LightController",
                "Ling\Chloroform\Validator\AbstractValidator",
                "Ling\Chloroform\DataTransformer\BaseDataTransformer",
                "Ling\Light_AjaxHandler\Handler\BaseLightAjaxHandler",
                "Ling\Light_AjaxHandler\Handler\ContainerAwareLightAjaxHandler",
                "Ling\TemporaryVirtualFileSystem\TemporaryVirtualFileSystem",
                "Ling\Light_SimpleHttpServer\Controller\LightSimpleHttpServerController",
                "Ling\Light_PluginInstaller\PluginInstaller\LightBasePluginInstaller",
                "Ling\Light_UserDatabase\Light_PluginInstaller\LightUserDatabaseBasePluginInstaller",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightBasePlanetInstaller",
                "Ling\Light_UserDatabase\Light_PlanetInstaller\LightUserDatabaseBasePlanetInstaller",
                "Ling\Light_Database\Light_PlanetInstaller\LightDatabaseBasePlanetInstaller",

            ],
            /**
             * Your project start date.
             * I like to write down when I start a project, along with when the project was last updated.
             * The date when the project was last updated can be generated automatically, but the project
             * start date doesn't change.
             */
            "projectStartDate" => "2019-09-27",

            /**
             * @kw(CopyModule).
             * To copy the whole documentation from one place to another, and interpreting @kw(inline functions)
             * during the transfer.
             * This is usually the last part of the DocTools generation process: it happens after the doc is generated,
             * and copies everything, including your manual documents to the destination directory.
             *
             *
             * I like to write my (manual) docs in a private directory, where I use the fancy @kw(inline functions) a lot in
             * all my pages (inside the pages directory of the @kw(Lizard scheme)).
             *
             * Then I like to copy this structure to the final public destination, which is the doc directory in the git repo
             * (and at the root of my planet on my local machine).
             */
            "copyModuleSrc" => "$planetDir/personal/mydoc",
            "copyModuleDst" => "$planetDir/doc",
            /**
             * I filtered out the doctool-markup-language.md document, because it explains the inline functions,
             * and so interpreting inline functions on this page is a bad idea.
             */
            "copyModuleOptions" => [
                "filter" => [
//                    "doctool-markup-language.md",
                ],
            ],
            /**
             * Git production mode
             * -------------
             * The settings below are my final settings when I want to export the doc to github.com.
             * See the "Local test mode" section below to see my settings when I work in local.
             *
             */
            /**
             * The directory where the api will be generated (with this DocBuilder: the planet page, the class pages,
             * and the method pages).
             */
            "generatedClassBaseDir" => "$planetDir/doc/api",
            /**
             * The base directory for the @kw(inserts).
             */
            "insertsBaseDir" => "$planetDir/personal/mydoc/inserts",
            /**
             * The base url for the generated documentation api (this maps to the generatedClassBaseDir defined above).
             */
            "generatedClassBaseUrl" => $api,
            /**
             * The extension of the files to generate.
             * If you use html, be sure to define a markdownTranslator (see how in the "Local test mode" section below).
             */
            "mode" => "md", // md|html

            /**
             * This map is used internally by the @kw(inline functions).
             * This map in particular is the one used for the whole DocTools planet documentation (pages and api).
             */
            "keyWord2UrlMap" => [
                "conception notes" => $doc . '/pages/conception-notes.md',
                "Light_UserDatabase" => 'https://github.com/lingtalfi/Light_UserDatabase',
                "Light_UserDatabase plugin" => 'https://github.com/lingtalfi/Light_UserDatabase',
                "ValidatorConfig object" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Validator/ValidatorConfig.md',
                "2svp system" => 'https://github.com/lingtalfi/TheBar/blob/master/discussions/ajax-file-upload.md#2-steps-validation-process',
                "current user" => 'https://github.com/lingtalfi/Light_UserData/blob/master/doc/pages/conception-notes.md#current-user',
                "Light.initialize_2 event" => 'https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/events.md',
                "light events page" => 'https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/events.md',
                "ling standard object methods" => 'https://github.com/lingtalfi/Light_BreezeGenerator/blob/master/doc/pages/ling-standard-object-methods.md',
                "Light_PluginInstaller conception notes" => 'https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/pages/conception-notes.md',
                "Ling.Light_Database.on_lud_user_group_create event" => 'https://github.com/lingtalfi/Light_Database/blob/master/personal/mydoc/pages/events.md',
                "the original file section in the conception notes" => $doc . '/pages/conception-notes.md#the-original-file',
                "Light_UserData permissions document" => $doc . '/pages/permissions.md',
                "alcp response" => "https://github.com/lingtalfi/Light_AjaxHandler/blob/master/doc/pages/ajax-light-communication-protocol.md",
                "related files" => $doc . "/pages/related-files.md",
                "related-files.md" => $doc . "/pages/related-files.md",
                "file manager protocol" => "https://github.com/lingtalfi/TheBar/blob/master/discussions/file-manager-protocol.md",
                "original file" => "https://github.com/lingtalfi/TheBar/blob/master/discussions/file-manager-protocol.md#keeporiginalurl",
                "Light_UserData conception notes" => $doc . "/pages/conception-notes.md",
                "TemporaryVirtualFileSystem conception notes" => "https://github.com/lingtalfi/TemporaryVirtualFileSystem/blob/master/doc/pages/conception-notes.md",
                "temporary virtual file system conception notes" => "https://github.com/lingtalfi/TemporaryVirtualFileSystem/blob/master/doc/pages/conception-notes.md",
                "source file concept in the Light_UserData conception notes" => $conception . '#the-source-file',
                '"Upload file configuration" section of the user data file manager document' => $doc . '/pages/user-data-file-manager.md#upload-file-configuration',
                'stacking vfs' => $doc . '/pages/user-data-file-manager.md#upload-file-configuration',
                'TemporaryVirtualFileSystem conceptions notes' => 'https://github.com/lingtalfi/TemporaryVirtualFileSystem/blob/master/doc/pages/conception-notes.md',
                "original image concept in our conception notes" => $conception . '#original-image',
                "original image section of our Light_UserData conception notes" => $conception . '#original-image',
                "resource info array" => $conception . '#the-resource-info-array',
                "source file section of our Light_UserData conception notes" => $conception . '#the-source-file',
                'files property of the upload file section' => $doc . '/pages/user-data-file-manager.md#upload-file-configuration',
                'files property of the upload file section of the user data file manager document' => $doc . '/pages/user-data-file-manager.md#upload-file-configuration',
                'the upload file configuration of the user data file manager document' => $doc . '/pages/user-data-file-manager.md#upload-file-configuration',
                'filename' => 'https://github.com/lingtalfi/NotationFan/blob/master/filename-basename.md',
                'default file/new file concept' => $conception . '#the-source-file',
                'user data file manager document' => $doc . '/pages/user-data-file-manager.md',
                'light standard permissions' => "https://github.com/lingtalfi/TheBar/blob/master/discussions/light-standard-permissions.md",
                "Light_PlanetInstaller conception notes" => 'https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/pages/conception-notes.md',
            ],
            /**
             * An array of external classes to url.
             * This will be used by some widgets to create links to that class when appropriate.
             * For instance, on the @kw(ParseDownTranslator class page), the class synopsis shows that the
             * ParseDownTranslator class extends the external Parsedown class.
             *
             * And so because the Parsedown class is referenced in the array below, it can be converted to a link
             * in the class synopsis.
             */
            "externalClass2Url" => [
                "Ling\Light\ServiceContainer\LightServiceContainerInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md",
                "Ling\Light_User\LightUserInterface" => "https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightUserInterface.md",
                "Ling\SimplePdoWrapper\SimplePdoWrapperInterface" => "https://github.com/lingtalfi/SimplePdoWrapper/blob/master/doc/api/Ling/SimplePdoWrapper/SimplePdoWrapperInterface.md",
                "Ling\Light\Controller\LightController" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Controller/LightController.md",
                "Ling\Light\Core\LightAwareInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Core/LightAwareInterface.md",
                "Ling\Light\Controller\LightControllerInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Controller/LightControllerInterface.md",
                "Ling\Light\Core\Light" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Core/Light.md",
                "Ling\Light\Http\HttpResponseInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/Http/HttpResponseInterface.md",
                "Ling\Light_Initializer\Initializer\LightInitializerInterface" => "https://github.com/lingtalfi/Light_Initializer/blob/master/doc/api/Ling/Light_Initializer/Initializer/LightInitializerInterface.md",
                "Ling\Chloroform\Exception\ChloroformException" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Exception/ChloroformException.md",
                "Ling\Chloroform\Validator\AbstractValidator" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Validator/AbstractValidator.md",
                "Ling\Chloroform\Validator\ValidatorInterface" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Validator/ValidatorInterface.md",
                "Ling\Chloroform\DataTransformer\BaseDataTransformer" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/DataTransformer/BaseDataTransformer.md",
                "Ling\Chloroform\DataTransformer\DataTransformerInterface" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/DataTransformer/DataTransformerInterface.md",
                "Ling\Light_Realform\Handler\AliasHelper\BaseRealformHandlerAliasHelper" => "https://github.com/lingtalfi/Light_Realform/blob/master/doc/api/Ling/Light_Realform/Handler/AliasHelper/BaseRealformHandlerAliasHelper.md",
                "Ling\Light_Realform\Handler\AliasHelper\RealformHandlerAliasHelperInterface" => "https://github.com/lingtalfi/Light_Realform/blob/master/doc/api/Ling/Light_Realform/Handler/AliasHelper/RealformHandlerAliasHelperInterface.md",
                "Ling\Light_Database\Service\LightDatabaseService" => "https://github.com/lingtalfi/Light_Database/blob/master/doc/api/Ling/Light_Database/Service/LightDatabaseService.md",
                "Ling\Light_PluginInstaller\PluginInstaller\PluginInstallerInterface" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/PluginInstaller/PluginInstallerInterface.md",
                "Ling\Light_User\LightWebsiteUser" => "https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightWebsiteUser.md",
                "Ling\Light_UserRowRestriction\RowRestrictionHandler\RowRestrictionHandlerInterface" => "https://github.com/lingtalfi/Light_UserRowRestriction/blob/master/doc/api/Ling/Light_UserRowRestriction/RowRestrictionHandler/RowRestrictionHandlerInterface.md",
                "Ling\Light_AjaxHandler\Handler\BaseLightAjaxHandler" => "https://github.com/lingtalfi/Light_AjaxHandler/blob/master/doc/api/Ling/Light_AjaxHandler/Handler/BaseLightAjaxHandler.md",
                "Ling\Light_AjaxHandler\Handler\LightAjaxHandlerInterface" => "https://github.com/lingtalfi/Light_AjaxHandler/blob/master/doc/api/Ling/Light_AjaxHandler/Handler/LightAjaxHandlerInterface.md",
                "Ling\Light\ServiceContainer\LightServiceContainerAwareInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerAwareInterface.md",
                "Ling\TemporaryVirtualFileSystem\TemporaryVirtualFileSystem" => "https://github.com/lingtalfi/TemporaryVirtualFileSystem/blob/master/doc/api/Ling/TemporaryVirtualFileSystem/TemporaryVirtualFileSystem.md",
                "Ling\TemporaryVirtualFileSystem\TemporaryVirtualFileSystemInterface" => "https://github.com/lingtalfi/TemporaryVirtualFileSystem/blob/master/doc/api/Ling/TemporaryVirtualFileSystem/TemporaryVirtualFileSystemInterface.md",
                "Ling\Light_PluginInstaller\PluginInstaller\PluginPostInstallerInterface" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/PluginInstaller/PluginPostInstallerInterface.md",
                "Ling\Light_UserData\FileManager\LightUserDataFileManagerHandler" => "https://github.com/lingtalfi/Light_UserData/blob/master/doc/api/Ling/Light_UserData/FileManager/LightUserDataFileManagerHandler.md",
                "Ling\Light_SimpleHttpServer\Controller\LightSimpleHttpServerController" => "https://github.com/lingtalfi/Light_SimpleHttpServer/blob/master/doc/api/Ling/Light_SimpleHttpServer/Controller/LightSimpleHttpServerController.md",
                "Ling\Light_PluginInstaller\PluginInstaller\LightBasePluginInstaller" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/PluginInstaller/LightBasePluginInstaller.md",
                "Ling\Light_PluginInstaller\TableScope\TableScopeAwareInterface" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/TableScope/TableScopeAwareInterface.md",
                "Ling\Light_UserDatabase\Light_PluginInstaller\LightUserDatabaseBasePluginInstaller" => "https://github.com/lingtalfi/Light_UserDatabase/blob/master/doc/api/Ling/Light_UserDatabase/Light_PluginInstaller/LightUserDatabaseBasePluginInstaller.md",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightBasePlanetInstaller" => "https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/PlanetInstaller/LightBasePlanetInstaller.md",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightPlanetInstallerInterface" => "https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/PlanetInstaller/LightPlanetInstallerInterface.md",
                "Ling\Light_UserDatabase\Light_PlanetInstaller\LightUserDatabaseBasePlanetInstaller" => "https://github.com/lingtalfi/Light_UserDatabase/blob/master/doc/api/Ling/Light_UserDatabase/Light_PlanetInstaller/LightUserDatabaseBasePlanetInstaller.md",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightPlanetInstallerInit3HookInterface" => "https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/PlanetInstaller/LightPlanetInstallerInit3HookInterface.md",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightPlanetInstallerInit2HookInterface" => "https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/PlanetInstaller/LightPlanetInstallerInit2HookInterface.md",
                "Ling\CliTools\Output\OutputInterface" => "https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md",
                "Ling\Light_Database\Light_PlanetInstaller\LightDatabaseBasePlanetInstaller" => "https://github.com/lingtalfi/Light_Database/blob/master/doc/api/Ling/Light_Database/Light_PlanetInstaller/LightDatabaseBasePlanetInstaller.md",

            ],
        ];


        if (true === $htmlMode) {
            $options = array_merge($options, [
                /**
                 * Local test mode
                 * -------------------
                 * When I'm on my local machine, I like to preview the doc before it's uploaded to github.com,
                 * so that I can fix everything before sending it to github.
                 *
                 * Therefore, I change my settings a bit, generating an html documentation that I can browse in a browser (rather
                 * than md files).
                 * I also create a dedicated virtual host (in this case serverName=jindoc) in my apache configuration,
                 * so that I can browse the generated doc from there.
                 *
                 * Uncomment the lines below to see my settings for local test mode.
                 */

                "generatedClassBaseDir" => "/komin/jin_site_demo/www-doc/api",
                "generatedClassBaseUrl" => "http://jindoc/api",
                "mode" => "html", // md|html
                "markdownTranslator" => new ParseDownTranslator(),
            ]);
        }


        $builder = new LingGitPhpPlanetDocBuilder();
        $builder->prepare($options);
        /**
         * This will create the generated documentation (aka api in the @kw(Lizard scheme)),
         * and since we've defined a @kw(copy module), it will also copy the whole doc to another location.
         */
        $builder->buildDoc();
        LingTalfiDocToolsHelper::generateCrumbs($builder);

        if ('cli' !== php_sapi_name()) {

            /**
             * This displays the @kw(report).
             */
            $builder->showReport();
        }
    }

}