[Back to the Ling/LingTalfi api](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi.md)



The PushCommand class
================
2019-03-13 --> 2019-03-13






Introduction
============

The PushCommand class.

This command does the following (for the given planet):


- Updates the version in meta-info.byml based on the **History Log** section in the README.md, or create it if necessary.
- Updates/creates the dependencies.byml file if necessary
- Builds the doc, if there is a corresponding LingTalfi/DocBuilder object.
- Pushes the planet to github.com.
- If the version number is greater than before, executes the PackAndPushUniTool command (see the PackAndPushUniTool class for more details).


Note: this command assumes that the planet dir represents a planet only if it contains a README.md file with a **History Log** section.


Options, flags
----------------

- ?planet-dir=string. The path to the planet directory to push. If not set, will use the current directory.



Class synopsis
==============


class <span class="pl-k">PushCommand</span> extends [KaosGenericCommand](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/KaosGenericCommand.md) implements CommandInterface {

- Inherited properties
    - protected [Ling\LingTalfi\Kaos\Application\KaosApplication](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Application/KaosApplication.md) [KaosGenericCommand::$application](#property-application) ;

- Methods
    - public [run](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PushCommand/run.md)(Ling\CliTools\Input\InputInterface $input, Ling\CliTools\Output\OutputInterface $output) : void

- Inherited methods
    - public [KaosGenericCommand::__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/KaosGenericCommand/__construct.md)() : void
    - public [KaosGenericCommand::setApplication](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/KaosGenericCommand/setApplication.md)([Ling\LingTalfi\Kaos\Application\KaosApplication](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Application/KaosApplication.md) $application) : void

}






Methods
==============

- [PushCommand::run](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PushCommand/run.md) &ndash; Runs the command.
- [KaosGenericCommand::__construct](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/KaosGenericCommand/__construct.md) &ndash; Builds the UniToolGenericCommand instance.
- [KaosGenericCommand::setApplication](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/KaosGenericCommand/setApplication.md) &ndash; Sets the application.





Location
=============
Ling\LingTalfi\Kaos\Command\PushCommand


SeeAlso
==============
Previous class: [PackAndPushUniToolCommand](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PackAndPushUniToolCommand.md)<br>Next class: [KaosException](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Exception/KaosException.md)<br>