[Back to the Ling/LingTalfi api](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi.md)<br>
[Back to the Ling\LingTalfi\Kaos\Command\PackAndPushUniToolCommand class](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PackAndPushUniToolCommand.md)


PackAndPushUniToolCommand::run
================



PackAndPushUniToolCommand::run — Runs the command.




Description
================


public [PackAndPushUniToolCommand::run](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PackAndPushUniToolCommand/run.md)(Ling\CliTools\Input\InputInterface $input, [Ling\CliTools\Output\OutputInterface](https://github.com/lingtalfi/CliTools/blob/master/doc/api/Ling/CliTools/Output/OutputInterface.md) $output) : mixed




Runs the command.

Important note:
The input object passed to the commands is the same as the input object passed to the application itself.
This means that the parameter index used by commands should start at 2 (because 1 is already the name of the command).

So, remember, when you're inside a command, if you want to get a parameter, starts with 2 (and not 0 or 1).




Parameters
================


- input

    

- output

    


Return values
================

Returns mixed.
If an int is returned, it should be assumed to be the exit status.
If no value is returned, 0 should be assumed (meaning exit status=0, meaning the program executed correctly).
Other return value types might be added in the future







Source Code
===========
See the source code for method [PackAndPushUniToolCommand::run](https://github.com/lingtalfi/LingTalfi/blob/master/Kaos/Command/PackAndPushUniToolCommand.php#L46-L247)


See Also
================

The [PackAndPushUniToolCommand](https://github.com/lingtalfi/LingTalfi/blob/master/doc/api/Ling/LingTalfi/Kaos/Command/PackAndPushUniToolCommand.md) class.



