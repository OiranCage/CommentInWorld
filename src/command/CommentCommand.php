<?php

namespace famima65536\CommentInWorld\command;

use DateTimeImmutable;
use famima65536\CommentInWorld\Comment;
use famima65536\CommentInWorld\entity\CommentBubble;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class CommentCommand extends Command {

	public function __construct(string $name, Translatable | string $description = "", Translatable | string | null $usageMessage = null, array $aliases = []){
		parent::__construct($name, $description, $usageMessage, $aliases);
		$this->setPermission("comment-in-world.command.comment");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player){
			$sender->sendMessage("Command is only available in server.");
			return true;
		}

		$text = join(" ", $args);

		if($text == ""){
			return false;
		}

		$location = $sender->getLocation();
		$location->y += 1;
		$entity = new CommentBubble($location, null, new Comment($text, $sender->getName(), new DateTimeImmutable()));
		$entity->spawnToAll();
	}
}