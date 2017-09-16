<?php

namespace App\Service;

use App\Video;
use App\Star;
use App\Series;
use App\AutoSeries;
use App\AutoStars;

class AutoTagger {
	
	public static function tagStars($video) {
		$stars = Star::all();

		foreach ($stars as $star) {
			$patterns = $star->patterns;

			$score = 0;

			foreach ($patterns as $pattern) {
				$titleMatchScore = self::check($pattern, $video->title, $pattern->title_modifier > 0 ?: 1);
				$descriptionMatchScore = self::check($pattern, $video->description);

				$score += ( $titleMatchScore + $descriptionMatchScore );
			}

			if ($score >= 100) {
				echo $star->title." (".$star->id.") is definitely in this video (Score: ".$score.")\n";
				$video->stars()->syncWithoutDetaching($star);
			}
			elseif ($score >= 70) {
				echo $star->title." (".$star->id.") is in this video (Score: ".$score.")\n";
				$video->stars()->syncWithoutDetaching($star);
			}
		}
	}

	public static function tagSeries($video) {

	}


	public static function check($check, $against, $multiplier = 1) {
		preg_match_all($check->pattern, $against, $matches);

		$score = 0;

		if (!empty($matches[0][0])) {
			foreach ($matches[0] as $match) {
				$score += ($check->weight * $multiplier);
			}
		}

		return $score;

	}
}