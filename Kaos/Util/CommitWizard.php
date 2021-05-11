<?php


namespace Ling\LingTalfi\Kaos\Util;


use Ling\BabyYaml\BabyYamlUtil;
use Ling\CliTools\Output\Output;
use Ling\CliTools\Output\OutputInterface;
use Ling\LingTalfi\Exception\LingTalfiException;
use Ling\UniverseTools\LocalUniverseTool;
use Ling\UniverseTools\PlanetTool;
use Ling\UniverseTools\Util\StandardReadmeUtil;

/**
 * The CommitWizard class.
 *
 *
 * When you use this class, I recommend using it from a terminal.
 *
 * - php -f myscript.php
 *
 * (and in the myscript.php use the CommitWizard tool)
 *
 *
 * blabla
 * ---------
 * I tried to use it from a web browser, but it failed to actually commit the planets to github.com.
 * I believe its because the php process (invoked by apache) doesn't have the same access the terminal does (i.e. the terminal
 * being using the user's configuration like .bashrc and .profile, ...).
 * Also maybe the fact that we are using ssh keys to access github might play a role in this problem.
 *
 * Any way, all the commit commands have a display intended for the terminal in the first place.
 *
 *
 *
 */
class CommitWizard
{


    /**
     * This property holds the output for this instance.
     * @var OutputInterface|null
     */
    protected ?OutputInterface $output;

    /**
     * This property holds the applicationPath for this instance.
     * @var string
     */
    private string $applicationPath;


    /**
     * Builds the CommitWizard instance.
     */
    public function __construct()
    {
        $this->output = null;
        $this->applicationPath = "/komin/jin_site_demo";
    }

    /**
     * Sets the output.
     *
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
    }


    /**
     * Commits all planets listed in the given file, with the given commit message.
     *
     * The file is in [babyYaml](https://github.com/lingtalfi/BabyYaml) format.
     * Each item of the list should be a planetDotName.
     *
     * More info at https://github.com/karayabin/universe-snapshot#the-planet-dot-name.
     *
     * Available options are:
     *
     * - increment: bool=true, whether to increment the version number in the readme's "history log" section
     *
     *
     *
     *
     * @param string $filePath
     * @param string $commitMsg
     * @param array $options
     * @throws \Exception
     */
    public function commitListFromFile(string $filePath, string $commitMsg, array $options = []): void
    {
        if (false === is_file($filePath)) {
            $this->error("File not found: $filePath.");
        }

        $list = BabyYamlUtil::readFile($filePath);
        foreach ($list as $planetDotName) {
            $this->commit($planetDotName, $commitMsg, $options);
        }
    }


    /**
     *
     * Commits the given planet with the given message.
     *
     * Available options are:
     *
     * - increment: bool=true, whether to increment the version number in the readme's "history log" section
     *
     *
     * @param string $planetDotName
     * @param string $commitMessage
     * @param array $options
     */
    public function commit(string $planetDotName, string $commitMessage, array $options = [])
    {

        $increment = $options['increment'] ?? true;
        $uniDir = LocalUniverseTool::getLocalUniversePath();
        $planetDir = $uniDir . "/" . PlanetTool::getPlanetSlashNameByDotName($planetDotName);
        if (false === is_dir($planetDir)) {
            $this->error("planet dir doesn't exist: $planetDir. Abort.");
        }


        $this->msg("add commit message to planet $planetDotName: $commitMessage." . PHP_EOL);
        $u = new StandardReadmeUtil();
        $u->addCommitMessageByPlanetDir($planetDir, $commitMessage, [
            "increment" => $increment,
        ]);
        $this->commitByPlanetDir($planetDir);
    }


    /**
     * Commits (and pushes to github.com) the given planet, using the actual last commit message from the readme's history log section.
     *
     * @param string $planetDir
     */
    public function commitByPlanetDir(string $planetDir)
    {


        $readMeFile = $planetDir . "/README.md";
        $readMeUtil = new ReadmeUtil();
        $this->msg("Parsing info from README.md..." . PHP_EOL);
        $info = $readMeUtil->getLatestVersionInfo($readMeFile);

        if (false !== $info) {

            $this->msgSuccess("ok." . PHP_EOL);
            $kaosPath = realpath(__DIR__ . "/../../script/kaos.php");
            $cmd = "cd \"$planetDir\" && /usr/local/bin/php -f \"$kaosPath\" -- push application=\"" . $this->applicationPath . "\"";

            $this->msg("Executing command: $cmd." . PHP_EOL);
            passthru($cmd);
        } else {
            $this->msgError("Parsing failed." . PHP_EOL);
            $errors = $readMeUtil->getErrors();
            foreach ($errors as $error) {
                $this->msgError($error);
            }
        }
    }





    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Writes a message to the output.
     * @param string $msg
     */
    private function msg(string $msg)
    {
        $this->getOutput()->write($msg);
    }


    /**
     * Writes an error message to the output.
     * @param string $msg
     */
    private function msgError(string $msg)
    {
        $this->msg('<error>' . $msg . '</error>');
    }

    /**
     * Writes a success message to the output.
     * @param string $msg
     */
    private function msgSuccess(string $msg)
    {
        $this->msg('<success>' . $msg . '</success>');
    }


    /**
     * Throws an exception.
     * @param string $msg
     * @param int|null $code
     * @throws \Exception
     */
    private function error(string $msg, int $code = null)
    {
        throw new LingTalfiException(static::class . ": " . $msg, $code);
    }


    /**
     * Returns the current output interface.
     *
     * @return OutputInterface
     */
    private function getOutput(): OutputInterface
    {
        if (null === $this->output) {
            $this->output = new Output();
        }
        return $this->output;
    }
}