<?php

namespace App\Filters;

use App\Filters\QueryFilters;

class VideoFilters extends QueryFilters {

	public function youtube_id($title) {
		return $this->builder->where("youtube_id", "=", $youtube_id);
	}

	public function title($title) {
		return $this->builder->where("title", "LIKE", "%".$title."%");
	}

	public function description($description) {
		return $this->builder->where("description", "LIKE", "%".$description."%");
	}

	public function uploadedAfter($date) {
		return $this->builder->where("upload_date", ">", $date);
	}

	public function uploadedBefore($date) {
		return $this->builder->where("upload_date", "<", $date);
	}

	public function channel($slug) {
		return $this->builder->join('channels', 'channel_id', '=', 'channels.id')
			->where('channels.slug', 'LIKE', "%".$slug."%");
	}

	public function slug($slug) {
		return $this->builder->where('slug', 'LIKE', "%".$slug."%");
	}
	
	public function longerThan($duration) {
		return $this->builder->where('duration', '>', $duration);
	}

	public function shorterThan($duration) {
		return $this->builder->where('duration', '<', $duration);
	}

	public function moreViewsThan($views) {
		return $this->builder->where('view_count', '>', $views);
	}

	public function fewerViewsThan($views) {
		return $this->builder->where('view_count', '<', $views);
	}

	public function moreLikesThan($likes) {
		return $this->builder->where('like_count', '>', $likes);
	}

	public function fewerLikesThan($likes) {
		return $this->builder->where('like_count', '<', $likes);
	}

	public function moreDislikesThan($dislikes) {
		return $this->builder->where('dislike_count', '>', $dislikes);
	}

	public function fewerDislikesThan($dislikes) {
		return $this->builder->where('dislike_count', '<', $dislikes);
	}

	public function moreCommentsThan($comments) {
		return $this->builder->where('comment_count', '>', $comments);
	}

	public function fewerCommentsThan($comments) {
		return $this->builder->where('comment_count', '<', $comments);
	}

	public function orderBy($orderBy) {
		$orderQuery = explode("|", $orderBy);
		$order = empty($orderQuery[1]) ? "desc" : $orderQuery[1];
		$orderBy = empty($orderQuery[0]) ? "upload_date" : $orderQuery[0];

		return $this->builder->orderBy($orderBy, $order);
	}
}
