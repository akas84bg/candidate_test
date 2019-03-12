<?php

declare(strict_types=1);

namespace Bingo\Command;

use Bingo\Caller\Application\Create\CallerCreatorUsa;
use Bingo\Card\Application\Create\CreateCardUsa;
use Bingo\Game\Domain\Game;
use Bingo\Player\Domain\Player;
use Bingo\Player\Domain\Players;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GameCommand
 * @package Bingo\Command
 */
final class GameCommand extends Command
{
    private $nameGenerator;
    private $cardGenerator;

    /**
     * GameCommand constructor.
     */
    public function __construct()
    {
        $this->nameGenerator = \Nubs\RandomNameGenerator\All::create();
        $this->cardGenerator = new CreateCardUsa();

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('bingo:start')
            ->setDescription('Start bingo game')
            ->addArgument('players', InputArgument::OPTIONAL, 'How many players will play?', rand(2, 5));
    }

    /**
     * @param $numberOfPlayers
     * @return Players
     * @throws \Exception
     */
    private function generatePlayers($numberOfPlayers)
    {
        $playersArray = array();
        for ($i = 0; $i < $numberOfPlayers; ++$i) {
            $name = $this->nameGenerator->getName();
            $card = $this->cardGenerator->generate();

            $playersArray[] = Player::create($name, $card);
        }

        $players = new Players($playersArray);

        return $players;
    }

    /**
     * @param Players $players
     * @param OutputInterface $output
     */
    private function printDescription(Players $players, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to BINGO Game!</info>' . "\n");
        $output->writeln('Today we have the following players:');

        foreach ($players as $player) {
            $output->writeln('<comment>' . $player->getName() . '</comment>');
        }

        $output->writeln("\n" . 'The game will start now!' . "\n");

    }

    /**
     * @param Player $player
     * @param int $roundIndex
     * @param OutputInterface $output
     */
    private function printWinner(Player $player, int $roundIndex, OutputInterface $output)
    {
        $output->writeln("\n" . 'And after ' . $roundIndex . ' rounds we have a winner:');
        $output->writeln('<info>' . $player->getName() . ' is the winner!</info>' . "\n");
        $output->writeln('Thanks for playing :)');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numberOfPlayers = $input->getArgument('players');

        $players = $this->generatePlayers($numberOfPlayers);
        $caller = CallerCreatorUsa::create();
        $game = Game::create($caller, $players);

        $this->printDescription($players, $output);

        $roundIndex = 1;
        foreach ($game->play() as $round) {
            $output->writeln('The number ' . $round->value() . ' has been called');
            if ($game->getWinner()) {
                $this->printWinner($game->getWinner(), $roundIndex, $output);

                break;
            }

            ++$roundIndex;
        }
    }
}
