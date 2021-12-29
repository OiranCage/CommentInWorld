<?php

namespace famima65536\CommentInWorld;

use DateTimeImmutable;

class Comment {
	/**
	 * @param string $comment
	 * @param string $poster
	 * @param DateTimeImmutable $createdTime
	 */
	public function __construct(private string $comment, private string $poster, private DateTimeImmutable $createdTime){
	}

	/**
	 * @return string
	 */
	public function getComment(): string{
		return $this->comment;
	}

	/**
	 * @return string
	 */
	public function getPoster(): string{
		return $this->poster;
	}

	/**
	 * @return DateTimeImmutable
	 */
	public function getCreatedTime(): DateTimeImmutable{
		return $this->createdTime;
	}

	public function format(): string{
		return "{$this->comment}\n {$this->poster}:{$this->createdTime->format('Y-m-d H:i:s')}";
	}


}