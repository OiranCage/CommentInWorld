<?php

namespace famima65536\CommentInWorld;

use famima65536\CommentInWorld\command\CommentCommand;
use famima65536\CommentInWorld\entity\CommentBubble;
use pocketmine\data\bedrock\EntityLegacyIds;
use pocketmine\entity\Entity;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\entity\Location;
use pocketmine\entity\Squid;
use pocketmine\entity\Villager;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\SpawnEgg;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;
use Rush2929\CustomEntityLoader\CustomEntityLoader;
use Rush2929\CustomEntityLoader\EntityRegistryEntry;

class Main extends PluginBase {

	public function onLoad(): void{
		EntityFactory::getInstance()->register(CommentBubble::class, function(World $world, CompoundTag $nbt) : CommentBubble{
			return new CommentBubble(EntityDataHelper::parseLocation($nbt, $world), $nbt);
		}, ['CommentBubble', 'comment_in_world:comment_bubble']);

		$this->getServer()->getCommandMap()->register("comment_in_world", new CommentCommand("comment", "post a comment in world"));
	}

	public function onEnable(): void{
		CustomEntityLoader::getEntityRegistry()->add(new EntityRegistryEntry(
			"comment_in_world:comment_bubble",
			"da3b4e01-26b3-49be-aec3-95c4f003a7ef"
		));

	}
}