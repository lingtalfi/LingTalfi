<?php


namespace Ling\LingTalfi\DocBuilder\Chloroform_HydrogenRenderer;


use Ling\DocTools\DocBuilder\Git\PhpPlanet\LingGitPhpPlanetDocBuilder;
use Ling\DocTools\Exception\DocBuilderException;
use Ling\DocTools\Translator\ParseDownTranslator;


/**
 * The Chloroform_HydrogenRendererDocBuilder class.
 */
class Chloroform_HydrogenRendererDocBuilder
{


    /**
     * Launch this function to generate the documentation for the Chloroform_HydrogenRenderer planet.
     * (based on the LingGitPhpPlanetDocBuilder doc builder.
     *
     * If htmlMode is false (the default),
     * this method will generate all files in md format in the following directory:
     *
     * - /myphp/universe/Chloroform_HydrogenRenderer/doc
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
    public static function buildDoc($htmlMode = false)
    {

        //--------------------------------------------
        // DOC TOOLS: CREATE A DOCUMENTATION FOR A PHP PLANET FOR GIT (MARKDOWN)
        //--------------------------------------------
        $planetDir = "/myphp/universe/Ling/Chloroform_HydrogenRenderer";
        $gitRepoUrl = "https://github.com/lingtalfi/Chloroform_HydrogenRenderer";
        $git = $gitRepoUrl . "/blob/master";
        $doc = "$git/doc";
        $api = $doc . "/api";


        $options = [
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
//                "Ling\DocTools\Translator\ParseDownTranslator",
            ],
            /**
             * Your project start date.
             * I like to write down when I start a project, along with when the project was last updated.
             * The date when the project was last updated can be generated automatically, but the project
             * start date doesn't change.
             */
            "projectStartDate" => "2019-04-15",

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
//                "the command line page" => $doc . '/pages/command-line.md',
                "Chloroform toArray" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Form/Chloroform/toArray.md',
                "Chloroform toArray method" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Form/Chloroform/toArray.md',
                "StringField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/StringField.md',
                "TextField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/TextField.md',
                "NumberField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/NumberField.md',
                "HiddenField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/HiddenField.md',
                "CSRFField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/CSRFField.md',
                "ColorField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/ColorField.md',
                "DateField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/DateField.md',
                "TimeField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/TimeField.md',
                "DateTimeField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/DateTimeField.md',
                "SelectField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/SelectField.md',
                "CheckboxField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/CheckboxField.md',
                "RadioField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/RadioField.md',
                "FileField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/FileField.md',
                "PasswordField class" => 'https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Field/PasswordField.md',
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
//                "Ling\UniversalLogger\UniversalLoggerInterface" => "https://github.com/lingtalfi/UniversalLogger",
                "Ling\Chloroform\Renderer\ChloroformRendererInterface" => "https://github.com/lingtalfi/Chloroform/blob/master/doc/api/Ling/Chloroform/Renderer/ChloroformRendererInterface.md",
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

                "generatedClassBaseDir" =>  "/komin/jin_site_demo/www-doc/api",
                "generatedClassBaseUrl" => "http://jindoc/api",
                "mode" => "html", // md|html
                "markdownTranslator" => new ParseDownTranslator(),
                "gitRepoUrl" => $gitRepoUrl,
            ]);
        }


        $builder = new LingGitPhpPlanetDocBuilder();
        $builder->prepare($options);
        /**
         * This will create the generated documentation (aka api in the @kw(Lizard scheme)),
         * and since we've defined a @kw(copy module), it will also copy the whole doc to another location.
         */
        $builder->buildDoc();

        if ('cli' !== php_sapi_name()) {

            /**
             * This displays the @kw(report).
             */
            $builder->showReport();
        }
    }

}