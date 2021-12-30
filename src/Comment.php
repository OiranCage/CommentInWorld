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
		$formatted_text = join("\n", mb_str_split($this->text, 20));
		return "{$formatted_text}\n{$this->poster}\n{$this->createdTime->format('Y-m-d H:i:s')}";
	}


}