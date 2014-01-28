<?php

namespace Thibaud\Console\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
 
class DeezerSearchCommand extends Command
{
    protected function configure()
    {
        $this->setName('deezer:search')
            ->setDefinition(array(
                new InputArgument('query', InputArgument::REQUIRED, 'What are you looking for ?'),
            ))
            ->setDescription('Deezer API console search artist, album or track information.')
            ->setHelp(
<<<HELP
The <info>deezer:search</info> command will use Deezer API to search your artist, album or track information.
 
<comment>Samples:</comment>
  To run with the query options:
    <info>php console.php deezer:search 'Tracy Chapman'</info>
HELP
            );
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $q = $input->getArgument('query');

        $client = \Thibaud\DeezerApiClient\Client\DeezerClient::factory(array(
            'client_id'     => 'client_id',
            'client_secret' => 'client_secret'
        ));

        $command = $client->getCommand('search', array('q' => $q));
        $results = $command->execute();

        $style = new OutputFormatterStyle('white', 'blue', array('bold', 'blink'));
        $output->getFormatter()->setStyle('blue', $style);

        foreach ($results['data'] as $result) {
            $output->writeln(sprintf(
                '<blue> %s - %s </blue><fg=cyan> %s </fg=cyan>',
                $result['artist']['name'],
                $result['album']['title'],
                $result['title']
            ));
        }
    }
}