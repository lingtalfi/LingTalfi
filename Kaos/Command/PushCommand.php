<?php


namespace Ling\LingTalfi\Kaos\Command;


use Ling\CliTools\Helper\VirginiaMessageHelper as H;
use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;
use Ling\UniverseTools\MetaInfoTool;

/**
 * The PushCommand class.
 *
 * This command does the following (for the given planet):
 *
 *
 *
 *
 * - Updates the version in meta-info.byml based on the **History Log** section in the README.md.
 * - Builds the doc, if there is a corresponding LingTalfi/DocBuilder object.
 * - Pushes the planet to github.com.
 * - If the version number is greater than before, executes the PackAndPushUniTool command (see the @object(PackAndPushUniTool) class for more details).
 *
 *
 *
 * Options, flags
 * ----------------
 *
 * - ?planet-dir=string. The path to the planet directory to push. If not set, will use the current directory.
 *
 *
 */
class PushCommand extends KaosGenericCommand
{


    /**
     * @implementation
     */
    public function run(InputInterface $input, OutputInterface $output)
    {

        $indentLevel = $this->application->getBaseIndentLevel();


        $planetDir = $input->getOption('planet-dir');
        if (null === $planetDir) {
            $planetDir = $this->application->getCurrentDirectory();
        }


        $meta = MetaInfoTool::parseInfo($planetDir);
        if (false === empty($meta)) {

        } else {

        }

        H::warning(H::i($indentLevel) . "The directory <bold>$planetDir</bold> is not a valid planet. Ensure that it contains a valid meta-info.byml file and try again.", $output);

    }


}