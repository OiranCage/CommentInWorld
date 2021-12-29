<?php

namespace famima65536\CommentInWorld;

use DateTimeImmutable;

class Comment {
	/**
	 * @param string $text
	 * @param string $poster
	 * @param DateTimeImmutable $createdTime
	 */
	public function __construct(private string $text, private string $poster, private DateTimeImmutable $createdTime){
	}

	/**
	 * @return string
	 */
	public function getText(): string{
		return $this->text;
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
		return "{$this->text}\n {$this->poster}:{$this->createdTime->format('Y-m-d H:i:s')}";
	}


}