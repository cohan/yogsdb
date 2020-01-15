<?php

namespace App\Filters;

use App\Filters\QueryFilters;

class VideoFilters extends QueryFilters {

	public function youtube_id($youtube_id) {
		return $this->builder->where("videos.youtube_id", "=", $youtube_id);
	}

	public function title($title) {
        if ($title == "ttt") {
            return $this->builder->where("videos.title", "LIKE", "%GMOD TTT%")->inRandomOrder();
        }

		return $this->builder->where("videos.title", "LIKE", "%".$title."%");
	}

	public function description($description) {
		return $this->builder->where("videos.description", "LIKE", "%".$description."%");
	}

	public function uploadedAfter($date) {
		return $this->builder->where("videos.upload_date", ">", $date);
	}

	public function uploadedBefore($date) {
		return $this->builder->where("videos.upload_date", "<", $date);
	}

	public function channel($slug) {
		return $this->builder->addSelect("videos.*")
			->join('channels', 'channel_id', '=', 'channels.id')
			->where('channels.slug', '=', $slug);
	}

	public function slug($slug) {
		return $this->builder->where('videos.slug', '=', $slug);
	}
	
	public function longerThan($duration) {
		return $this->builder->where('videos.duration', '>', $duration);
	}

	public function shorterThan($duration) {
		return $this->builder->where('videos.duration', '<', $duration);
	}

	public function moreViewsThan($views) {
		return $this->builder->where('videos.view_count', '>', $views);
	}

	public function fewerViewsThan($views) {
		return $this->builder->where('videos.view_count', '<', $views);
	}

	public function moreLikesThan($likes) {
		return $this->builder->where('videos.like_count', '>', $likes);
	}

	public function fewerLikesThan($likes) {
		return $this->builder->where('videos.like_count', '<', $likes);
	}

	public function moreDislikesThan($dislikes) {
		return $this->builder->where('videos.dislike_count', '>', $dislikes);
	}

	public function fewerDislikesThan($dislikes) {
		return $this->builder->where('videos.dislike_count', '<', $dislikes);
	}

	public function moreCommentsThan($comments) {
		return $this->builder->where('videos.comment_count', '>', $comments);
	}

	public function fewerCommentsThan($comments) {
		return $this->builder->where('videos.comment_count', '<', $comments);
	}

	public function orderBy($orderBy) {
		$orderQuery = explode("|", $orderBy);
		$order = empty($orderQuery[1]) ? "desc" : $orderQuery[1];
		$orderBy = empty($orderQuery[0]) ? "videos.upload_date" : $orderQuery[0];

		return $this->builder->orderBy($orderBy, $order);
	}

	public function inRandomOrder($inRandomOrder) {
		if (!empty($inRandomOrder)) {
			return $this->builder->inRandomOrder();
		}
		else {
			return $this->builder;
		}
	}
}
