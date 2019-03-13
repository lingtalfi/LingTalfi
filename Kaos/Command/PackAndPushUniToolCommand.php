<?php


namespace Ling\LingTalfi\Kaos\Command;


use Ling\CliTools\Input\InputInterface;
use Ling\CliTools\Output\OutputInterface;

/**
 * The PackAndPushUniToolCommand class.
 *
 * This command does the following:
 *
 * - It builds the dependency master by parsing all planets in the local server (/myphp/universe).
 *          The dependency master file is first written at the Uni2 planet root.
 * - It rebuilds the universe-meta.byml file and also put it at the root of the Uni2 planet.
 * - Packs the uni directory of the universe-naive-importer planet (using the private:pack command of the uni tool).
 * - Copy the dependency master and universe meta files to the universe-naive-importer root.
 * - Updates the version in the universe-naive-importer's meta-info.byml AND also in the Uni2/info/uni-tool-info.byml (so that when an user
 *          downloads the Uni2 planet she already has the latest version)
 * - Pushes the universe-naive-importer to github.com
 *
 *
 */
class PackAndPushUniToolCommand extends KaosGenericCommand
{
    public function run(InputInterface $input, OutputInterface $output)
    {

    }


}