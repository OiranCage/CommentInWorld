<?php

namespace famima65536\CommentInWorld\entity;

use DateTimeImmutable;
use famima65536\CommentInWorld\Comment;
use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Living;
use pocketmine\entity\Location;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;

class CommentBubble extends Entity {

	public const TAG_COMMENT = 'comment_bubble:comment';
	public const TAG_TEXT = 'comment_in_world:text';
	public const TAG_POSTER = 'comment_in_world:poster';
	public const TAG_CREATED_TIME = 'comment_in_world:created_time';

	private Comment $comment;

	public function __construct(Location $location, ?CompoundTag $nbt = null, ?Comment $comment=null){
		parent::__construct($location, $nbt);

		$this->setImmobile();

		if($comment !== null){
			$this->comment = $comment;
		}elseif($nbt !== null and ($commentCompoundTag = $nbt->getCompoundTag(CommentBubble::TAG_COMMENT)) !== null){
			$this->comment = new Comment(
				$commentCompoundTag->getString(CommentBubble::TAG_TEXT, ''),
				$commentCompoundTag->getString(CommentBubble::TAG_POSTER, ''),
				(new DateTimeImmutable())->setTimestamp($commentCompoundTag->getInt(CommentBubble::TAG_CREATED_TIME, 0))
			);
		}else{
			$this->comment = new Comment(
				'',
				'',
				new DateTimeImmutable()
			);
		}

		$this->setNameTag($this->comment->format());
	}

	public function attack(EntityDamageEvent $source): void{
		parent::attack($source); // TODO: Change the autogenerated stub
		if(!$source->isCancelled() and $source instanceof EntityDamageByEntityEvent and ($damager = $source->getDamager()) !== null and $damager instanceof Player){
			if($damager->getName() === $this->comment->getPoster()){
				$this->kill();
			}
		}
	}

	protected function getInitialSizeInfo(): EntitySizeInfo{
		return new EntitySizeInfo(0.2, 0.2, 0.1);
	}

	public static function getNetworkTypeId(): string{
		return "comment_in_world:comment_bubble";
	}

	public function saveNBT(): CompoundTag{
		$nbt = parent::saveNBT(); // TODO: Change the autogenerated stub
		$commentCompoundTag = new CompoundTag();
		$commentCompoundTag->setString(CommentBubble::TAG_TEXT, $this->comment->getText());
		$commentCompoundTag->setString(CommentBubble::TAG_POSTER, $this->comment->getPoster());
		$commentCompoundTag->setInt(CommentBubble::TAG_CREATED_TIME, $this->comment->getCreatedTime()->getTimestamp());
		$nbt->setTag(CommentBubble::TAG_COMMENT, $commentCompoundTag);
		return $nbt;
	}

}