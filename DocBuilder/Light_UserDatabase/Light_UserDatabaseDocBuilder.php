<?php


namespace Ling\LingTalfi\DocBuilder\Light_UserDatabase;


use Ling\DocTools\DocBuilder\Git\PhpPlanet\LingGitPhpPlanetDocBuilder;
use Ling\DocTools\Exception\DocBuilderException;
use Ling\DocTools\Translator\ParseDownTranslator;
use Ling\LingTalfi\DocTools\LingTalfiDocToolsHelper;


/**
 * The Light_UserDatabaseDocBuilder class.
 */
class Light_UserDatabaseDocBuilder
{


    /**
     * Launch this function to generate the documentation for the Light_UserDatabase planet.
     * (based on the LingGitPhpPlanetDocBuilder doc builder.
     *
     * If htmlMode is true (the default),
     * this method will generate all files in md format in the following directory:
     *
     * - /myphp/universe/Light_UserDatabase/doc
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
        $planetDir = "/myphp/universe/Ling/Light_UserDatabase";
        $gitRepoUrl = "https://github.com/lingtalfi/Light_UserDatabase";
        $git = $gitRepoUrl . "/blob/master";
        $doc = "$git/doc";
        $api = $doc . "/api";


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
                "Ling\Light_Bullsheet\Bullsheeter\LightAbstractBullsheeter",
                "Ling\Light_PluginInstaller\PluginInstaller\LightBasePluginInstaller",
                "Ling\Light_Database\Light_PlanetInstaller\LightDatabaseBasePlanetInstaller",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightBasePlanetInstaller",


            ],
            /**
             * Your project start date.
             * I like to write down when I start a project, along with when the project was last updated.
             * The date when the project was last updated can be generated automatically, but the project
             * start date doesn't change.
             */
            "projectStartDate" => "2019-07-19",

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
                "Light_Database plugin" => 'https://github.com/lingtalfi/Light_Database',
                "initializer service" => 'https://github.com/lingtalfi/Light_Initializer/',
                "passwordProtector" => 'https://github.com/lingtalfi/Light_PasswordProtector/',
                "light website user" => 'https://github.com/lingtalfi/Light_User/blob/master/doc/api/Ling/Light_User/LightWebsiteUser.md',
                "rights of the user" => 'https://github.com/lingtalfi/Light_User/blob/master/doc/pages/conception.md#its-all-about-rights',
                "BabyYamlDatabase" => 'https://github.com/lingtalfi/BabyYamlDatabase/',
                "lsom" => 'https://github.com/lingtalfi/Light_BreezeGenerator/blob/master/doc/pages/ling-standard-object-methods.md',
                "ling standard object methods" => 'https://github.com/lingtalfi/Light_BreezeGenerator/blob/master/doc/pages/ling-standard-object-methods.md',
                "conception ddnotes" => $doc . "/pages/conception-notes.md",
                "Light_UserDatabase conception notes" => $doc . "/pages/conception-notes.md",
                "permissions conception notes" => "https://github.com/lingtalfi/Light_User/blob/master/doc/pages/permission-conception-notes.md",
                "user permissions" => "https://github.com/lingtalfi/Light_User/blob/master/doc/pages/permission-conception-notes.md",
                "LightWebsiteUserDatabaseInterface class" => "https://github.com/lingtalfi/Light_UserDatabase/blob/master/doc/api/Ling/Light_UserDatabase/LightWebsiteUserDatabaseInterface.md",
                "Ling.Light.initialize_1 event" => "https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/events.md",
                "Light_PluginInstaller conception notes" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/pages/conception-notes.md",
                "Light_FileWatcher conception notes" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/pages/conception-notes.md",
                "Light_FileWatcher plugin" => "https://github.com/lingtalfi/Light_FileWatcher",
                "Ling breeze generator 2" => "https://github.com/lingtalfi/Light_BreezeGenerator/blob/master/doc/pages/ling-breeze-generator-2.md",
                "light standard permissions" => "https://github.com/lingtalfi/TheBar/blob/master/discussions/light-standard-permissions.md",
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
                "Ling\Light_Initializer\Initializer\LightInitializerInterface" => "https://github.com/lingtalfi/Light_Initializer/blob/master/doc/api/Ling/Light_Initializer/Initializer/LightInitializerInterface.md",
                "Ling\Light_Database\LightDatabasePdoWrapper" => "https://github.com/lingtalfi/Light_Database/blob/master/doc/api/Ling/Light_Database/LightDatabasePdoWrapper.md",
                "Ling\Light_PasswordProtector\Service\LightPasswordProtector" => "https://github.com/lingtalfi/Light_PasswordProtector/blob/master/doc/api/Ling/Light_PasswordProtector/Service/LightPasswordProtector.md",
                "Ling\Light_Bullsheet\Bullsheeter\LightAbstractBullsheeter" => "https://github.com/lingtalfi/Light_Bullsheet/blob/master/doc/api/Ling/Light_Bullsheet/Bullsheeter/LightAbstractBullsheeter.md",
                "Ling\Light_Bullsheet\Bullsheeter\LightBullsheeterInterface" => "https://github.com/lingtalfi/Light_Bullsheet/blob/master/doc/api/Ling/Light_Bullsheet/Bullsheeter/LightBullsheeterInterface.md",
                "Ling\Light\ServiceContainer\LightServiceContainerInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md",
                "Ling\Light\ServiceContainer\LightServiceContainerAwareInterface" => "https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerAwareInterface.md",
                "Ling\BabyYamlDatabase\BabyYamlDatabaseInterface" => "https://github.com/lingtalfi/BabyYamlDatabase/blob/master/doc/api/Ling/BabyYamlDatabase/BabyYamlDatabaseInterface.md",
                "Ling\SimplePdoWrapper\SimplePdoWrapperInterface" => "https://github.com/lingtalfi/SimplePdoWrapper/blob/master/doc/api/Ling/SimplePdoWrapper/SimplePdoWrapperInterface.md",
                "Ling\Light_Database\Service\LightDatabaseService" => "https://github.com/lingtalfi/Light_Database/blob/master/doc/api/Ling/Light_Database/Service/LightDatabaseService.md",
                "Ling\Light_PluginInstaller\PluginInstaller\PluginInstallerInterface" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/PluginInstaller/PluginInstallerInterface.md",
                "Ling\Light_FileWatcher\Refreshable\LightPluginInstallerRefreshableInterface" => "https://github.com/lingtalfi/Light_FileWatcher/blob/master/doc/api/Ling/Light_FileWatcher/Refreshable/LightPluginInstallerRefreshableInterface.md",
                "Ling\Light_PluginInstaller\PluginInstaller\LightBasePluginInstaller" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/PluginInstaller/LightBasePluginInstaller.md",
                "Ling\Light_PluginInstaller\TableScope\TableScopeAwareInterface" => "https://github.com/lingtalfi/Light_PluginInstaller/blob/master/doc/api/Ling/Light_PluginInstaller/TableScope/TableScopeAwareInterface.md",
                "Ling\Light_PlanetInstaller\PlanetInstaller\LightPlanetInstallerInit3HookInterface" => "https://github.com/lingtalfi/Light_PlanetInstaller/blob/master/doc/api/Ling/Light_PlanetInstaller/PlanetInstaller/LightPlanetInstallerInit3HookInterface.md",
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